<?php

namespace App\Http\Controllers;

use App\Models\DistributionHouse;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\OrderDetail;
use App\Models\Sale;
use App\Models\Skue;
use App\Models\SmsInbox;
use App\Models\SmsOutbox;
use App\Models\Stocks;
use Carbon\Carbon;
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
        $smsInboxes = SmsInbox::orderBy('id', 'desc')->paginate(25);

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
    private function prepareOrderData(&$data,$extra_data=[])
    {
        $aso_id = $data['asoid'];
        $order_date = $data['dt'];
        $route_id = isset($data['rt']) ? $data['rt'] : '';
        $get_information=get_route_info($route_id,$aso_id);
        if(is_null($get_information)){
            $order_information['status'] = false;
            $order_information['message'] = "Invalid Route Information!!";
            $order_information['additional'] = $extra_data['additional'];
            $order_information['identifier'] = $extra_data['identifier'];
            return $order_information;
        }
        $total_outlet= $data['ou'];
        $visited_outlet = $data['vo'];
        $total_memo_order= $data['me'];
        $order_total_sku =  $data['total'];
        $route_name= $get_information->routes_name;
        unset($data['asoid'],$data['rt'],$data['dt'],$data['ou'],$data['vo'],$data['me'],$data['total']);
        $get_information=get_info_by_aso($aso_id);
        if(is_null($get_information)){
            $order_information['status'] = false;
            $order_information['message'] = "Invalid ASO Information!!";
            $order_information['additional'] = $extra_data['additional'];
            $order_information['identifier'] = $extra_data['identifier'];
            return $order_information;
        }
        Order::where('aso_id',$aso_id)->where('order_date',$order_date)
            ->where('route_id',$route_id)
            ->where('order_type','Secondary')
            ->where('created_at','>',Carbon::now()->subHours(48)->toDateTimeString())
            ->update(['order_status'=>'Rejected']);
        $total_sku_count = $this->totalCheck($data, 'order',$order_total_amount);
        $order_information=[];
        if ($total_sku_count === (int)$order_total_sku) {
            $order_information['order'] = [
                'aso_id'=> $aso_id,
                'dbid'  => $get_information->distribution_house_id,
                'order_date'=>$order_date,
                'requester_name' => $get_information->name,
                'requester_phone' => $get_information->mobile,
//                'dh_phone' => $get_information->dhname,
//                'dh_name' => $get_information->dhphone,
//                'tso_name' => $get_information->tsoname,
//                'tso_phone' => $get_information->tsophone,
                'route_id'  => $route_id,
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
    private function prepareSaleData(&$data,$extra_data)
    {
        $aso_id = $data['asoid'];
        $order_date = $data['dt'];
        $sale_total_sku =  $data['total'];
        $order_details = get_order_id_by_sale($aso_id,$order_date,$data['rt']);
        unset($data['asoid'],$data['dt'],$data['rt'],$data['total']);
        $total = $this->totalCheck($data,SALE,$total_sale_amount);
        $order_id = $order_details['id'];
        $route_id = $order_details['route_id'];
        $route_name= $order_details['route_name'];
        if($order_id== 0){
            $sale_information['status'] = false;
            $sale_information['message'] = "Invalid Order Date or Route Information!!";
            $sale_information['additional'] = $extra_data['additional'];
            $sale_information['identifier'] = $extra_data['identifier'];
            return $sale_information;
        }
        $get_information=get_info_by_aso($aso_id);
        if(is_null($get_information)){
            $sale_information['status'] = false;
            $sale_information['message'] = "Invalid ASO Information!!";
            $sale_information['additional'] = $extra_data['additional'];
            $sale_information['identifier'] = $extra_data['identifier'];
            return $sale_information;
        }
        $sale_information=[];
        if(!getPreviousSale($aso_id,$order_date,$route_id)->isEmpty()){
            rejectPreviousSale($aso_id,$order_date,$sale_information,$route_id);
        }
        if ($total === (int)$sale_total_sku) {
            $sale_information['order'] = [
                'aso_id'=> $aso_id,
                'dbid' =>$get_information->distribution_house_id,
                'order_id'=>$order_id,
                'order_date'=>$order_date,
                'sale_date'=>date('Y-m-d'),
                'sender_name' => $get_information->name,
                'sender_phone' => $get_information->mobile,
//                'dh_phone' => $get_information->dhname,
//                'dh_name' => $get_information->dhphone,
//                'tso_name' => $get_information->tsoname,
//                'tso_phone' => $get_information->tsophone,
                'sale_type'=>'Secondary',
                'sale_total_sku' => $total,
                'total_sale_amount'=>$total_sale_amount,
                'sale_route_id'=>$route_id,
                'sale_route' => $route_name,
                'created_by' => Auth::Id()
            ];
            $sale_information['status'] = true;
            return $sale_information;
        }
        else {
            $sale_information['status'] = false;
            $sale_information['message'] = "Invalid Sale Total SKU !!";
            $sale_information['additional'] = $extra_data['additional'];
            $sale_information['identifier'] = $extra_data['identifier'];
            return $sale_information;
        }
    }

    /**
     * prepare primary data
     * @param $data
     * @return bool
     */
    private function preparePrimaryData(&$data,$extra_data){
        $asm_rms_id = $data['asm_rsm_id'];
        $dbid= $data['dbid'];
        $order_date = $data['dt'];
        $primary_order_total_sku =  $data['total'];
        $da=$data['da'];
        unset($data['asm_rsm_id'],$data['dbid'],$data['dt'],$data['total'],$data['da']);
        $total = $this->totalCheck($data,PRIMARY,$primary_order_total);
        $get_information=get_info_by_asm($asm_rms_id,$dbid);

        if(is_null($get_information)){
            $primary_order_information['status'] = false;
            $primary_order_information['message'] = "Invalid ASM/RSM Information!!";
            $primary_order_information['additional'] = $extra_data['additional'];
            $primary_order_information['identifier'] = $extra_data['identifier'];
            return $primary_order_information;
        }

        if($get_information->distribution_house_id != $dbid ){
            $primary_order_information['status'] = false;
            $primary_order_information['message'] = "Invalid Distribution House Information !!";
            $primary_order_information['additional'] = $extra_data['additional'];
            $primary_order_information['identifier'] = $extra_data['identifier'];
            return $primary_order_information;
        }

        Order::where('asm_rsm_id',$asm_rms_id)->where('order_date',$order_date)->where('order_type','Primary')->where('created_at','>',Carbon::now()->subHours(48)->toDateTimeString())->update(['order_status'=>'Rejected']);

        if ($total === (int)$primary_order_total_sku) {
            $primary_order_information['order'] = [
                'asm_rsm_id'=> $asm_rms_id,
                'dbid'=>$dbid,
                'order_date'=>$order_date,
                'requester_name' => $get_information->name,
                'requester_phone' => $get_information->mobile,
//                'dh_phone' => $get_information->dhname,
//                'dh_name' => $get_information->dhphone,
//                'tso_name' => $get_information->tsoname,
//                'tso_phone' => $get_information->tsophone,
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
            $primary_order_information['additional'] = $extra_data['additional'];
            $primary_order_information['identifier'] = $extra_data['identifier'];
            return $primary_order_information;
        }

    }

    private function preparePromotionData(&$data,$extra_data){
        $aso_id = $data['asoid'];
        $order_date = $data['dt'];
        $route_id= $data['rt'];
        $route_name=!is_null($route=get_route_info($route_id)) ? $route->routes_name : '';
        unset($data['asoid'],$data['dt'],$data['rt']);
        $get_information=get_info_by_aso($aso_id);
        if(is_null($get_information)){
            $promotional_sale['status'] = false;
            $promotional_sale['message'] = "Invalid ASO Information!!";
            $promotional_sale['additional'] = $extra_data['additional'];
            $promotional_sale['identifier'] = $extra_data['identifier'];
            return $promotional_sale;
        }

        $promotional_sale=[];
        if(!getPreviousSale($aso_id,$order_date,'Promotional')->isEmpty()){
            rejectPreviousSale($aso_id,$order_date,$promotional_sale,'Promotional');
        }
        if(!empty($aso_id) && !empty($order_date)){
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
                'sale_route_id'=>$route_id,
                'sale_route' => $route_name,
                'sale_type'=>'Promotional',
                'created_by' => Auth::Id()
            ];
            $promotional_sale['status'] = true;
            return $promotional_sale;
        }
       else{
           $promotional_sale['status'] = false;
           $promotional_sale['message'] = "Invalid Primary Order Total SKU !!";
           $promotional_sale['additional'] = $extra_data['additional'];
           $promotional_sale['identifier'] = $extra_data['identifier'];
           return $promotional_sale;
       }
    }

    /**
     * process order
     * @param $id
     * @param $parseData
     * @return \Illuminate\Http\RedirectResponse
     */

    private function processOrder($id,$parseData){
        $order_information = $this->prepareOrderData($parseData['data'],$parseData);

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
            //return error with additional information
            return $order_information;
        }
    }

    /**
     * process sell
     * @param $id
     * @param $parseData
     * @return \Illuminate\Http\RedirectResponse
     */
    private function processSell($id,$parseData){
        $sale_information = $this->prepareSaleData($parseData['data'],$parseData);
        if (isset($sale_information['status']) &&  $sale_information['status']!= false) {

            foreach ($parseData['data'] as $key => $value){
                $sale_information['order_details'][] =[
                    "short_name" => $key,
                    "quantity"   => (int)explode(',',$value)[0],
                    "price"      => get_regular_price_by_sku($key),
                    "created_by" =>1
                ];
            }
            //modify stock
            modify_stock($sale_information['order']['aso_id'],$sale_information['order_details'],isset($sale_information['update']) && $sale_information['update'] ? $sale_information['previous_data']: []);
            if (Sale::insertSale($sale_information['order'], $sale_information['order_details'])) {
                SmsInbox::find($id)->update(['sms_status' => 'Processed']);

                return redirect()->route('sms_inboxes.sms_inbox.index')
                    ->with('success_message', 'Sale successfully placed!');
            }
        } else {
            //return error with additional information
            return $sale_information;

        }
    }

    /**
     * process primary
     * @param $id
     * @param $parseData
     * @return \Illuminate\Http\RedirectResponse
     */
    private function processPrimary($id,$parseData){
        $primary_information = $this->preparePrimaryData($parseData['data'],$parseData);

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

            //return error with additional information
            return $primary_information;

        }
    }

    private function processPromotion($id,$parseData){
        $get_info=SmsInbox::where('id',$id)->first()->toArray();
        $promotion_information = $this->preparePromotionData($parseData['data'],$parseData);

        $promotion_information['order_details']=[];
        if (isset($promotion_information['status']) && $promotion_information['status'] != false) {
            foreach ($parseData['data']['pdn'] as $key => $value){
                $package_details = get_package_by_name($value['short_name']);
                if(count($package_details) < 1){
                    $error_message ='Invalid Package ( *'.$value['short_name'].' ) Information!!';
                    SmsInbox::where('id',$id)->update(['sms_status'=>'Rejected']);
                    SmsOutboxesController::writeOutbox($get_info['sender'],$error_message,['id'=>$id,'order_type'=>'promotional','priority'=>3]);
                    return redirect()->route('sms_inboxes.sms_inbox.index')
                        ->with('error_message', 'Invalid Package ( *'.$value['short_name'].' ) Information!!');
                }
                $package_merge = promotion_package_merge($package_details['purchase'],$package_details['free'],$value['quantity']);
                foreach ($package_merge as $sku_key=>$sku_value){
                    $promotion_information['order_details'][] =[
                        "short_name" =>$sku_key,
                        "quantity"   => (int)$sku_value,
                        "price"      => get_regular_price_by_sku($sku_key),
                        'no_of_memo' => (int)$value['no_of_memo'],
                        "created_by" =>Auth::id()
                    ];
                }
            }
            //modify stock
            modify_stock($promotion_information['order']['aso_id'],$promotion_information['order_details'],isset($promotion_information['update']) && $promotion_information['update'] ? $promotion_information['previous_data']: []);
            if (Sale::insertSale($promotion_information['order'], $promotion_information['order_details'])) {
                SmsInbox::find($id)->update(['sms_status' => 'Processed']);

                return redirect()->route('sms_inboxes.sms_inbox.index')
                    ->with('success_message', 'Sell successfully placed!');
            }

        }
        else{
            //return error with additional information
            return $promotion_information;
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

                    $result= $this->processOrder($id,$parseData);

                    if(!is_a($result,'Illuminate\Http\RedirectResponse')) {
                        $error_message = isset($result['message']) ? $result['message'] : 'Invalid Order !';
                        SmsOutboxesController::writeOutbox($parseData['additional']['sender'], $error_message, ['id' => $parseData['additional']['id'], 'order_type' => strtolower($parseData['identifier']), 'priority' => 3]);
                        SmsInbox::where('id', $id)->update(['sms_status' => 'Rejected', 'reason' => $error_message]);
                        return redirect()->route('sms_inboxes.sms_inbox.index')
                            ->with('error_message', $error_message);
                    }
                    return $result;
                    break;

                case SALE:

                    $result= $this->processSell($id,$parseData);
                    if(!is_a($result,'Illuminate\Http\RedirectResponse')) {
                        $error_message = isset($result['message']) ? $result['message'] : 'Invalid Sale !!';
                        SmsOutboxesController::writeOutbox($parseData['additional']['sender'], $error_message, ['id' => $parseData['additional']['id'], 'order_type' => strtolower($parseData['identifier']), 'priority' => 3]);
                        SmsInbox::where('id', $id)->update(['sms_status' => 'Rejected', 'reason' => $error_message]);
                        return redirect()->route('sms_inboxes.sms_inbox.index')
                            ->with('error_message', $error_message);
                    }
                    return $result;
                    break;

                case PRIMARY:

                    $result= $this->processPrimary($id,$parseData);
                    if(!is_a($result,'Illuminate\Http\RedirectResponse')){
                        $error_message = isset($result['message']) ? $result['message'] : 'Invalid Primary Order!!';
                        SmsOutboxesController::writeOutbox($parseData['additional']['sender'],$error_message,['id'=>$parseData['additional']['id'],'order_type'=>strtolower($parseData['identifier']),'priority'=>3]);
                        SmsInbox::where('id',$id)->update(['sms_status'=>'Rejected','reason'=>$error_message]);
                        return redirect()->route('sms_inboxes.sms_inbox.index')
                            ->with('error_message',$error_message);
                    }
                    return $result;
//                    dd(is_a($result,'RedirectResponse'));
                    break;

                case PROMOTION:

                    $result= $this->processPromotion($id,$parseData);
                    if(!is_a($result,'Illuminate\Http\RedirectResponse')) {
                        $error_message = isset($result['message']) ? $result['message'] : 'Invalid Promotinal Sale!!';
                        SmsOutboxesController::writeOutbox($parseData['additional']['sender'], $error_message, ['id' => $parseData['additional']['id'], 'order_type' => strtolower($parseData['identifier']), 'priority' => 3]);
                        SmsInbox::where('id', $id)->update(['sms_status' => 'Rejected', 'reason' => $error_message]);
                        return redirect()->route('sms_inboxes.sms_inbox.index')
                            ->with('error_message', $error_message);
                    }
                    return $result;
                    break;

                default:

                    $error_message='Invalid message format !';
                    SmsOutboxesController::writeOutbox($parseData['additional']['sender'],$error_message,['id'=>$parseData['additional']['id'],'order_type'=>strtolower($parseData['identifier']),'priority'=>3]);
                    SmsInbox::where('id',$id)->update(['sms_status'=>'Rejected','reason'=>$error_message]);
                    return redirect()->route('sms_inboxes.sms_inbox.index')
                        ->with('error_message',$error_message);
                    break;
            }
        } else {
            $error_message = $parseData['message'];
            SmsInbox::where('id',$id)->update(['sms_status'=>'Rejected','reason'=>$error_message]);
            SmsOutboxesController::writeOutbox($parseData['additional']['sender'],$error_message,['id'=>$parseData['additional']['id'],'order_type'=>strtolower($parseData['identifier']),'priority'=>3]);
            return redirect()->route('sms_inboxes.sms_inbox.index')
                ->with('error_message', $error_message);
        }
    }

    public function captureSms(Request $request){

        $post = $request->all();
//        dd(unserialize('a:3:{s:6:"number";s:14:"+8801719415744";s:4:"text";s:2:"hi";s:15:"timestampMillis";s:13:"1532498441665";}'));
//        file_put_contents('1.txt',serialize($post));
//        die;

        $sender =  $post['from'];
        $message_body = $post['message'];
        $send_at = $post['sent_timestamp'];
//        session_id($sender);
//        session_start();
//        session_destroy();
//        die;
//        if(!isset($_SESSION['message'])){
//            $_SESSION['message'] ="";
//        }
//        if(strpos($message_body,'Total') === false){
//
//            $_SESSION['message'].=$message_body;
//            return 0;
//        }
//        else{
//            $_SESSION['message'].=$message_body;
//        }











//        //dd(unserialize("a:4:{s:4:\"body\";s:153:\"Order/ASOID-11/Dt-2018-02-17/Rt-1/OU-10/VO-8/ME-17/Tp-000,001/Tc-001,01/BHp-000,0/BHc-000,1/Fp-000,1/Fc-000,1/F(h)-000,1/F(1)-000,1/F(2)-000,1/UCp-000,1/\";s:2:\"id\";s:2:\"19\";s:6:\"sender\";s:14:\"+8801719415744\";s:7:\"sent_at\";s:25:\"Tue, 24 Jul 2018 16:51:12\";}"));
//        session_start();
        $data=[
           "transactionId"=> 1,
           "sender"=>$sender,
           "sms_content" =>  $message_body,
           "sms_received"=> date('Y-m-d H:i:s', $send_at)
        ];

        try{
            $result = DB::table('sms_inboxes')->insertGetId(
                $data
            );
            if($result){
                $this->process($result,$request);
            }
        }
        catch (Exception $e){

        }
//        dd(empty($result));
//         dd($message_id,$message_body,$sender,$send_at);
//        //dd(unserialize('a:4:{s:4:"body";s:2:"hi";s:2:"id";s:1:"1";s:6:"sender";s:14:"+8801719415744";s:7:"sent_at";s:25:"Tue, 24 Jul 2018 13:36:03";}'));
//        file_put_contents('1.txt',serialize($post));
    }

    public function sendOutboxSend(Request $request){
        $outbox_pending=SmsOutbox::where('status','Draft')->get();
        foreach ($outbox_pending as $pending){
            $number = $pending['sms_receiver_number'];
            $content = $pending['sms_content'];
            $response=sendSms($number,$content);
            $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $response_array = json_decode($json,TRUE);
            if(isset($response_array['result']['status']) && $response_array['result']['status']== 0){
                SmsOutbox::where('id',$pending['id'])->update(['status'=>'Sent']);
            }
        }
    }

}
