<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\OrderDetail;
use App\Models\Sale;
use App\Models\SmsInbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sms;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\DB;

const ORDER ='order';
const SALE   ='sale';
const PRIMARY   ='primary';
const PROMOTION ='promotion';
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

    /**
     * total check
     * @param $input_data
     * @param string $type
     * @param int $total_memo
     * @return int
     */
    private function totalCheck($input_data, $type = "sale",&$total_memo = 0)
    {
        $total = 0;
        foreach ($input_data as $key => $value) {

            if ($type === SALE) {
                $total = $total + (int)$value;
            }
            if($type===PRIMARY){
                $total = $total + (int)$value;
            }
            if ($type === ORDER) {
                $val = explode(',', $value);
                $total = $total + (int)$val[0];
                $total_memo = $total_memo + (int)$val[1];
            }
        }

        return $total;
    }

    /**
     * prepare order data
     * @param $data
     * @return bool
     */
    private function prepareOrderData(&$data)
    {
        $aso_id = $data['asoid'];
        $order_date = $data['dt'];
        $route_name = $data['rt'];
        $total_outlet= $data['ou'];
        $visited_outlet = $data['vo'];
        $order_total = str_replace('c', '', $data['total']);
        unset($data['asoid']);
        unset($data['dt']);
        unset($data['total']);
        unset($data['rt']);
        unset($data['ou']);
        unset($data['vo']);
        $total = $this->totalCheck($data, 'order',$total_memo);

        if ($total === (int)$order_total) {
            $order_information['order'] = [
                'aso_id'=> $aso_id,
                'order_date'=>$order_date,
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

    /**
     * prepare sale data
     * @param $data
     * @return bool
     */
    private function prepareSaleData(&$data)
    {
        $aso_id = $data['asoid'];
        $order_date = $data['dt'];
        $order_total = str_replace('c', '', $data['total']);
        unset($data['asoid']);
        unset($data['dt']);
        unset($data['total']);
        $total = $this->totalCheck($data,SALE);

        if ($total === (int)$order_total) {
            $sale_information['order'] = [
                'aso_id'=> $aso_id,
                'sale_date'=>$order_date,
                'sender_name' => 'test',
                'sender_phone' => 'testss',
                'dh_phone' => 'asdsd',
                'dh_name' => 'adsadsad',
                'tso_name' => 'asdasd',
                'tso_phone' => 'asdsadsd',
                'sale_type'=>'Secondary',
                'sale_total' => $total,
                'created_by' => Auth::Id()
            ];

            return $sale_information;
        }
        else {

            return false;
        }
    }

    /**
     * prepare primary data
     * @param $data
     * @return bool
     */
    private function preparePrimaryData(&$data){
        $asm_rms_id = $data['asm_rsm_id'];
        $dbid= $data['dbid'];
        $order_date = $data['dt'];
        $order_total =  $data['total'];
        $da=$data['da'];
        unset($data['asm_rsm_id']);
        unset($data['dbid']);
        unset($data['dt']);
        unset($data['total']);
        unset($data['da']);
        $total = $this->totalCheck($data,PRIMARY);

        if ($total === (int)$order_total) {
            $primary_order_information['order'] = [
                'asm_rsm_id'=> $asm_rms_id,
                'dbid'=>$dbid,
                'order_date'=>$order_date,
                'requester_name' => 'test',
                'requester_phone' => 'testss',
                'order_type'=>'Primary',
                'order_total' => $total,
                'order_da'    =>$da,
                'created_by' => Auth::Id()
            ];

            return $primary_order_information;
        }
        else{

            return false;
        }

    }

    private function preparePromotionData(&$data){
        $aso_id = $data['asoid'];
        $order_date = $data['dt'];
        $route_name = $data['rt'];
        unset($data['asoid']);
        unset($data['dt']);
        unset($data['rt']);
        if(!empty($aso_id) && !empty($order_date) && !empty($route_name)){
            $promotional_sale['order'] = [
                'aso_id'=> $aso_id,
                'sale_date'=>$order_date,
                'sender_name' => 'test',
                'sender_phone' => 'testss',
                'dh_phone' => 'asdsd',
                'dh_name' => 'adsadsad',
                'tso_name' => 'asdasd',
                'tso_phone' => 'asdsadsd',
                'sale_route' => $route_name,
                'sale_type'=>'Promotional',
                'created_by' => Auth::Id()
            ];

            return $promotional_sale;
        }
       else{
            return false;
       }
    }

    /**
     * process order
     * @param $id
     * @param $parseData
     * @return \Illuminate\Http\RedirectResponse
     */

    private function processOrder($id,$parseData){
        $order_information = $this->prepareOrderData($parseData['data']);

        if ($order_information != false) {
            foreach ($parseData['data'] as $key => $value){
                $order_information['order_details'][] =[
                    "short_name" => $key,
                    "quantity"   => (int)explode(',',$value)[0],
                    "created_by" => Auth::id()
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

    /**
     * process sell
     * @param $id
     * @param $parseData
     * @return \Illuminate\Http\RedirectResponse
     */
    private function processSell($id,$parseData){
        $sale_information = $this->prepareSaleData($parseData['data']);
        if ($sale_information != false) {

            foreach ($parseData['data'] as $key => $value){
                $sale_information['order_details'][] =[
                    "short_name" => $key,
                    "quantity"   => (int)explode(',',$value)[0],
                    "created_by" =>1
                ];
            }

            if (Sale::insertSale($sale_information['order'], $sale_information['order_details'])) {
                SmsInbox::find($id)->update(['sms_status' => 'Processed']);

                return redirect()->route('sms_inboxes.sms_inbox.index')
                    ->with('success_message', 'Order successfully placed!');
            }
        } else {

            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('error_message', 'Invalid order total!!');
        }
    }

    /**
     * process primary
     * @param $id
     * @param $parseData
     * @return \Illuminate\Http\RedirectResponse
     */
    private function processPrimary($id,$parseData){
        $primary_information = $this->preparePrimaryData($parseData['data']);

        if ($primary_information != false) {

            foreach ($parseData['data'] as $key => $value){
                $primary_information['order_details'][] =[
                    "short_name" => $key,
                    "quantity"   => (int)$value,
                    "created_by" => Auth::id()
                ];
            }

            if (Order::insertOrder($primary_information['order'], $primary_information['order_details'])) {
                SmsInbox::find($id)->update(['sms_status' => 'Processed']);

                return redirect()->route('sms_inboxes.sms_inbox.index')
                    ->with('success_message', 'Order successfully placed!');
            }
        }
        else{

            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('error_message', 'Invalid order total!!');
        }
    }

    private function processPromotion($id,$parseData){
        $promotion_information = $this->preparePromotionData($parseData['data']);

        if ($promotion_information != false) {

            foreach ($parseData['data']['pdn'] as $key => $value){
                $promotion_information['order_details'][] =[
                    "short_name" => $value['short_name'],
                    "quantity"   => (int)$value['quantity'],
                    'no_of_memo' => (int)$value['no_of_memo'],
                    "created_by" =>Auth::id()
                ];
            }

            if (Sale::insertSale($promotion_information['order'], $promotion_information['order_details'])) {
                SmsInbox::find($id)->update(['sms_status' => 'Processed']);

                return redirect()->route('sms_inboxes.sms_inbox.index')
                    ->with('success_message', 'Sell successfully placed!');
            }

        }
        else{

            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('error_message', 'Invalid sell SMS!!');
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

            switch ($parseData['type']){
                case ORDER:

                    return $this->processOrder($id,$parseData);
                    break;
                case SALE:

                    return $this->processSell($id,$parseData);
                    break;
                case PRIMARY:

                    return $this->processPrimary($id,$parseData);
                    break;
                case PROMOTION:

                    return $this->processPromotion($id,$parseData);
                    break;
                default:

                    return redirect()->route('sms_inboxes.sms_inbox.index')
                        ->with('error_message','Invalid message format !');
            }
        } else {

            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('error_message', $parseData['message']);
        }
    }

}
