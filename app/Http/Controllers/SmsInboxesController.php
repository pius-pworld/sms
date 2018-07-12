<?php

namespace App\Http\Controllers;

use App\Models\DistributionHouse;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\OrderDetail;
use App\Models\Sale;
use App\Models\Skue;
use App\Models\SmsInbox;
use App\Models\Stocks;
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
    private function totalCheck($input_data, $type = "sale",&$calculate_total_amount=0)
    {
        $total = 0;
        foreach ($input_data as $key => $value) {

            if ($type === SALE) {
                $total = $total + (int)$value;
                if($value > 0){
                    $calculate_total_amount = $calculate_total_amount+($value*(int)get_regular_price_by_sku($key));
                }
            }
            if($type===PRIMARY){
                $total = $total + (int)$value;
                if($value > 0){
                    $calculate_total_amount = $calculate_total_amount+($value*(int)get_house_price_by_sku($key));
                }
            }
            if ($type === ORDER) {
                $val = explode(',', $value);
                $total = $total + (int)$val[0];
                if($val[0] > 0){
                    $calculate_total_amount = $calculate_total_amount+($val[0]*(int)get_regular_price_by_sku($key));
                }
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
        $route_name = isset($data['rt']) ? $data['rt'] : '';
        $total_outlet= $data['ou'];
        $visited_outlet = $data['vo'];
        $total_memo_order= $data['me'];
        $order_total_sku =  $data['total'];
        unset($data['asoid'],$data['rt'],$data['dt'],$data['ou'],$data['vo'],$data['me'],$data['total']);
        $get_information=get_info_by_aso($aso_id);
        if(is_null($get_information)){
            $order_information['status'] = false;
            $order_information['message'] = "Invalid ASO Information!!";
            return $order_information;
        }
        $total_sku_count = $this->totalCheck($data, 'order',$order_total_amount);
        $order_information=[];
        if ($total_sku_count === (int)$order_total_sku) {
            $order_information['order'] = [
                'aso_id'=> $aso_id,
                'dbid'  => $get_information->distribution_house_id,
                'order_date'=>$order_date,
                'requester_name' => $get_information->name,
                'requester_phone' => $get_information->mobile,
                'dh_phone' => $get_information->dhname,
                'dh_name' => $get_information->dhphone,
                'tso_name' => $get_information->tsoname,
                'tso_phone' => $get_information->tsophone,
                'route_name' => $route_name,
                'total_outlet' => $total_outlet,
                'visited_outlet'=>$visited_outlet,
                'order_type'=>'Secondary',
                'total_no_of_memo'=> $total_memo_order,
                'order_total_sku' => $order_total_sku,
                'order_amount'    => $order_total_amount,
                'order_status'    => 'Processed',
                'created_by' => Auth::Id()
            ];
            $order_information['status'] = true;
            return $order_information;
        } else {
            $order_information['status'] = false;
            $order_information['message'] = "Invalid Order Total SKU !!";
            return $order_information;
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
        $sale_total_sku =  $data['total'];
        unset($data['asoid'],$data['dt'],$data['total']);
        $total = $this->totalCheck($data,SALE,$total_sale_amount);
        $order_id = get_order_id_by_sale($aso_id,$order_date);
        if($order_id== 0){
            $sale_information['status'] = false;
            $sale_information['message'] = "Invalid Order Date!!";
            return $sale_information;
        }
        $get_information=get_info_by_aso($aso_id);
        if(is_null($get_information)){
            $sale_information['status'] = false;
            $sale_information['message'] = "Invalid ASO Information!!";
            return $sale_information;
        }
        $sale_information=[];
        if ($total === (int)$sale_total_sku) {
            $sale_information['order'] = [
                'aso_id'=> $aso_id,
                'dbid' =>$get_information->distribution_house_id,
                'order_id'=>$order_id,
                'order_date'=>$order_date,
                'sale_date'=>date('Y-m-d'),
                'sender_name' => $get_information->name,
                'sender_phone' => $get_information->mobile,
                'dh_phone' => $get_information->dhname,
                'dh_name' => $get_information->dhphone,
                'tso_name' => $get_information->tsoname,
                'tso_phone' => $get_information->tsophone,
                'sale_type'=>'Secondary',
                'sale_total_sku' => $total,
                'total_sale_amount'=>$total_sale_amount,
                'created_by' => Auth::Id()
            ];
            $sale_information['status'] = true;
            return $sale_information;
        }
        else {
            $sale_information['status'] = false;
            $sale_information['message'] = "Invalid Sale Total SKU !!";
            return $sale_information;
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
        $primary_order_total_sku =  $data['total'];
        $da=$data['da'];
        unset($data['asm_rsm_id'],$data['dbid'],$data['dt'],$data['total'],$data['da']);
        $total = $this->totalCheck($data,PRIMARY,$primary_order_total);
        $get_information=get_info_by_asm($asm_rms_id);

        if(is_null($get_information)){
            $primary_order_information['status'] = false;
            $primary_order_information['message'] = "Invalid ASM/RSM Information!!";
            return $primary_order_information;
        }

        if($get_information->distribution_house_id != $dbid ){
            $primary_order_information['status'] = false;
            $primary_order_information['message'] = "Invalid Distribution House Information !!";
            return $primary_order_information;
        }


        if ($total === (int)$primary_order_total_sku) {
            $primary_order_information['order'] = [
                'asm_rsm_id'=> $asm_rms_id,
                'dbid'=>$dbid,
                'order_date'=>$order_date,
                'requester_name' => $get_information->name,
                'requester_phone' => $get_information->mobile,
                'dh_phone' => $get_information->dhname,
                'dh_name' => $get_information->dhphone,
                'tso_name' => $get_information->tsoname,
                'tso_phone' => $get_information->tsophone,
                'order_type'=>'Primary',
                'order_total_sku' => $primary_order_total_sku,
                'order_amount'    => $primary_order_total,
                'order_da'    =>$da,
                'created_by' => Auth::Id()
            ];
            $primary_order_information['status'] = true;
            return $primary_order_information;
        }
        else{
            $primary_order_information['status'] = false;
            $primary_order_information['message'] = "Invalid Primary Order Total SKU !!";
            return $primary_order_information;
        }

    }

    private function preparePromotionData(&$data){
        $aso_id = $data['asoid'];
        $order_date = $data['dt'];
        $route_name = $data['rt'];
        unset($data['asoid'],$data['dt'],$data['rt']);
        $get_information=get_info_by_aso($aso_id);
        if(is_null($get_information)){
            $promotional_sale['status'] = false;
            $promotional_sale['message'] = "Invalid ASO Information!!";
            return $promotional_sale;
        }
        $promotional_sale=[];
        if(!empty($aso_id) && !empty($order_date) && !empty($route_name)){
            $promotional_sale['order'] = [
                'aso_id'=> $aso_id,
                'dbid' => $get_information->distribution_house_id,
                'order_date'=>$order_date,
                'sale_date'=>date('Y-m-d'),
                'sender_name' => $get_information->name,
                'sender_phone' => $get_information->mobile,
                'dh_phone' => $get_information->dhname,
                'dh_name' => $get_information->dhphone,
                'tso_name' => $get_information->tsoname,
                'tso_phone' => $get_information->tsophone,
                'sale_route' => $route_name,
                'sale_type'=>'Promotional',
                'created_by' => Auth::Id()
            ];
            $promotional_sale['status'] = true;
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

        if (isset($order_information['status']) && $order_information['status']!= false) {
            foreach ($parseData['data'] as $key => $value){
                $order_information['order_details'][] =[
                    "short_name" => $key,
                    "quantity"   => (int)explode(',',$value)[0],
                    "price"      => get_regular_price_by_sku($key),
                    "no_of_memo" =>(int)explode(',',$value)[1],
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
                ->with('error_message', isset($order_information['message']) ? $order_information['message'] : 'Invalid Order !!');
        }
    }

    private function modifyStock($sku_informations,$order_information,$update=false){
        $distribution_house_info = DB::table('users')
            ->select('users.distribution_house_id')
            ->where('users.id',$order_information['aso_id'])
            ->first();
        $present_data =[];
        $updated_data=[];

        if($order_information['order_status'] == 'Processed' && $update){
            $order_details = DB::table('orders')
                ->select('order_details.short_name','order_details.quantity')
                ->where('orders.aso_id',$order_information['aso_id'])
                ->join('order_details', 'order_details.orders_id', '=', 'orders.id')->get();
            $total = 0;
            foreach ($order_details as $val){
                $unit=Skue::where('short_name',$val['short_name'])->first(['price']);
                if(!empty($unit)){
                    $unit = $unit->toArray();
                    $total+= $unit['price'] * $val['quantity'];
                    $present_data[$val['short_name']] = $val['quantity'];
                }
            }
            stock_update($distribution_house_info->distribution_house_id,$updated_data,$present_data,$total);
        }
        else{
            $total = 0;
            foreach ($sku_informations as $val){
                $unit=Skue::where('short_name',$val['short_name'])->first(['price']);
                if(!empty($unit)){
                    $unit = $unit->toArray();
                    $total+= $unit['price'] * $val['quantity'];
                    $updated_data[$val['short_name']] = $val['quantity'];
                }
            }
            stock_update($distribution_house_info->distribution_house_id,$updated_data,$present_data,$total);
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
        if (isset($sale_information['status']) &&  $sale_information['status']!= false) {

            foreach ($parseData['data'] as $key => $value){
                $sale_information['order_details'][] =[
                    "short_name" => $key,
                    "quantity"   => (int)explode(',',$value)[0],
                    "price"      => get_regular_price_by_sku($key),
                    "created_by" =>1
                ];
            }
            $order_information = Order::all()->where('aso_id',$sale_information['order']['aso_id'])->where('order_date',$sale_information['order']['order_date'])->last()->toArray();
            $this->modifyStock($sale_information['order_details'],$order_information);

            if (Sale::insertSale($sale_information['order'], $sale_information['order_details'])) {
                SmsInbox::find($id)->update(['sms_status' => 'Processed']);

                return redirect()->route('sms_inboxes.sms_inbox.index')
                    ->with('success_message', 'Sale successfully placed!');
            }
        } else {

            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('error_message', isset($sale_information['message']) ? $sale_information['message'] : 'Invalid Sale !!');
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

        if (isset($primary_information['status']) && $primary_information['status']!= false) {

            foreach ($parseData['data'] as $key => $value){
                $primary_information['order_details'][] =[
                    "short_name" => $key,
                    "quantity"   => (int)$value,
                    "price"      => get_house_price_by_sku($key),
                    "created_by" => Auth::id()
                ];
            }

            if (Order::insertOrder($primary_information['order'], $primary_information['order_details'])) {
                SmsInbox::find($id)->update(['sms_status' => 'Processed']);

                return redirect()->route('sms_inboxes.sms_inbox.index')
                    ->with('success_message', 'Primary Order successfully placed!');
            }
        }
        else{

            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('error_message', isset($primary_information['message']) ? $primary_information['message'] : 'Invalid Primary Order!!');
        }
    }

    private function processPromotion($id,$parseData){
        $promotion_information = $this->preparePromotionData($parseData['data']);

        $promotion_information['order_details']=[];
        if (isset($promotion_information['status']) && $promotion_information['status'] != false) {
            foreach ($parseData['data']['pdn'] as $key => $value){
                $package_details = get_package_by_name($value['short_name']);
                if(count($package_details) < 1){
                    return redirect()->route('sms_inboxes.sms_inbox.index')
                        ->with('error_message', 'Invalid Package Information!!');
                }
                $package_merge = promotion_package_merge($package_details['purchase'],$package_details['free'],$value['quantity']);
                foreach ($package_merge as $sku_key=>$sku_value){
                    $promotion_information['order_details'][] =[
                        "short_name" =>$sku_key,
                        "quantity"   => (int)$sku_value,
                        "price"      => get_house_price_by_sku($sku_key),
                        'no_of_memo' => (int)$value['no_of_memo'],
                        "created_by" =>Auth::id()
                    ];
                }
            }

            if (Sale::insertSale($promotion_information['order'], $promotion_information['order_details'])) {
                SmsInbox::find($id)->update(['sms_status' => 'Processed']);

                return redirect()->route('sms_inboxes.sms_inbox.index')
                    ->with('success_message', 'Sell successfully placed!');
            }

        }
        else{

            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('error_message', isset($promotion_information['message']) ? $promotion_information['message'] : 'Invalid Promotinal Sale!!');
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
