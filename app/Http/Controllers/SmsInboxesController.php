<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\OrderDetail;
use App\Models\SmsInbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sms;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\DB;

const ORDER ='order';
const SALE   ='sale';
class SmsInboxesController extends Controller
{
    private $sms;

    function __construct()
    {
        $this->sms = new Sms();
    }

    /**
     * Display a listing of the sms inboxes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $smsInboxes = SmsInbox::paginate(25);

        return view('sms_inboxes.index', compact('smsInboxes'));
    }

    /**
     * Show the form for creating a new sms inbox.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('sms_inboxes.create');
    }

    /**
     * Store a new sms inbox in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);
            $data['created_by'] = Auth::Id();
            SmsInbox::create($data);

            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('success_message', 'Sms Inbox was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified sms inbox.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $smsInbox = SmsInbox::findOrFail($id);

        return view('sms_inboxes.show', compact('smsInbox'));
    }

    /**
     * Show the form for editing the specified sms inbox.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $smsInbox = SmsInbox::findOrFail($id);


        return view('sms_inboxes.edit', compact('smsInbox'));
    }

    /**
     * Update the specified sms inbox in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);
            $data['updated_by'] = Auth::Id();
            $smsInbox = SmsInbox::findOrFail($id);
            $smsInbox->update($data);

            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('success_message', 'Sms Inbox was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Remove the specified sms inbox from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $smsInbox = SmsInbox::findOrFail($id);
            $smsInbox->delete();

            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('success_message', 'Sms Inbox was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'sender' => 'required|string|min:1|max:15',
            'sms_content' => 'required',
            'sms_status' => 'nullable',
            'is_active' => 'nullable|boolean',

        ];

        $data = $request->validate($rules);

        $data['is_active'] = $request->has('is_active');

        return $data;
    }

    private function totalCheck($input_data, $type = "sale",&$total_memo = 0)
    {
        $total = 0;
        foreach ($input_data as $key => $value) {
            if ($type === SALE) {
                $total = $total + (int)$value;
            }
            if ($type === 'order') {
                $val = explode(',', $value);
                $total = $total + (int)$val[0];
                $total_memo = $total_memo + (int)$val[1];
            }
        }
        return $total;
    }

    private function prepareOrderData(&$data)
    {
        $aso_id = $data['asoid'];
        $order_date = $data['orderdate'];
        $route_name = $data['rt'];
        $total_outlet= $data['ou'];
        $visited_outlet = $data['vo'];
        $order_total = str_replace('c', '', $data['total']);
        unset($data['asoid']);
        unset($data['orderdate']);
        unset($data['total']);
        unset($data['rt']);
        unset($data['ou']);
        unset($data['vo']);
        $total = $this->totalCheck($data, 'order',$total_memo);
        if ($total === (int)$order_total) {
            $order_information['order'] = [
                'requester_name' => 'test',
                'requester_phone' => 'testss',
                'dh_phone' => 'asdsd',
                'dh_name' => 'adsadsad',
                'tso_name' => 'asdasd',
                'tso_phone' => 'asdsadsd',
                'route_name' => $route_name,
                'total_outlet' => $total_outlet,
                'visited_outlet'=>$visited_outlet,
                'order_type'=>'Secondary',
                'total_no_of_memo'=> $total_memo,
                'order_total' => $total,
                'created_by' => Auth::Id()
            ];
            return $order_information;
        } else {
            return false;
        }
    }

    private function prepareSaleData(&$data)
    {
        $aso_id = $data['asoid'];
        $order_date = $data['orderdate'];
        $order_total = str_replace('c', '', $data['total']);
        unset($data['asoid']);
        unset($data['orderdate']);
        unset($data['total']);
        $total = $this->totalCheck($data);
        if ($total === (int)$order_total) {
            $sale_information = [
                "order" => [
                    'requester_name' => 'test',
                    'requester_phone' => 'testss',
                    'dh_phone' => 'asdsd',
                    'dh_name' => 'adsadsad',
                    'tso_name' => 'asdasd',
                    'tso_phone' => 'asdsadsd',
                    'order_total' => $total,
                    'created_by' => Auth::Id()
                ],
                "order_details" => [
                    'route_name' => 'asdsad',
                    'total_outlet' => 10,
                    'visited_outlet' => 11,
                    'order_details' => json_encode($data),
                    'created_by' => 1
                ]
            ];
            return $sale_information;
        }
    }

    /**
     * process sms
     * @param $id sms ID
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process($id, Request $request)
    {
        $parseData = $this->sms->parseSms($id);
        if ($parseData['status'] === true) {
            //order parse
            if ($parseData['type'] === ORDER) {
                $order_information = $this->prepareOrderData($parseData['data']);
                if ($order_information != false) {
                    foreach ($parseData['data'] as $key => $value){
                        $order_information['order_details'][] =[
                            "order_id"   => 10,
                            "short_name" => $key,
                            "quantity"   => (int)explode(',',$value)[0],
                            "created_by" =>1
                        ];
                    }
                    if (Order::insertOrder($order_information['order'], $order_information['order_details'])) {
                        SmsInbox::find($id)->update(['sms_status' => 'Processed']);
                        return redirect()->route('sms_inboxes.sms_inbox.index')
                            ->with('success_message', 'Order successfully placed!');
                    }
                } else {
                    return redirect()->route('sms_inboxes.sms_inbox.index')
                        ->with('error_message', 'Invalid order total!!');
                }
            }

            //sale parse
            if ($parseData['type'] === SALE) {
                $sale_information = $this->prepareSaleData($parseData['data']);
                if ($sale_information != false) {
                    if (Order::insertOrder($sale_information['order'], $sale_information['order_details'])) {
                        SmsInbox::find($id)->update(['sms_status' => 'Processed']);
                        return redirect()->route('sms_inboxes.sms_inbox.index')
                            ->with('success_message', 'Order successfully placed!');
                    }
                } else {
                    return redirect()->route('sms_inboxes.sms_inbox.index')
                        ->with('error_message', 'Invalid order total!!');
                }

                dd($parseData['data']);


//            $total = $this->totalCheck($parseData['data']);
//            if ($total === (int)$order_total) {
//                $order = [
//                    'requester_name' => 'test',
//                    'requester_phone' => 'testss',
//                    'dh_phone' => 'asdsd',
//                    'dh_name' => 'adsadsad',
//                    'tso_name' => 'asdasd',
//                    'tso_phone' => 'asdsadsd',
//                    'order_total' => $total,
//                    'created_by'=> Auth::Id()
//                ];
//                $order_details = [
//                    'route_name' => 'asdsad',
//                    'total_outlet' => 10,
//                    'visited_outlet' => 11,
//                    'order_details'=>json_encode($parseData['data']),
//                    'created_by'=>1
//                ];
//                if(Order::insertOrder($order,$order_details)){
//                    SmsInbox::find($id)->update(['sms_status'=>'Processed']);
//                    return redirect()->route('sms_inboxes.sms_inbox.index')
//                        ->with('success_message', 'Order successfully placed!');
//                }

//
            }
//            else{
//                return redirect()->route('sms_inboxes.sms_inbox.index')
//                    ->with('error_message', 'Invalid order total!!');
//            }

        } else {
            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('error_message', $parseData['message']);
        }
    }

}
