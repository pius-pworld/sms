<?php

namespace App\Http\Controllers;

//use App\Models\Ordering;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\URL;
use reportsHelper;
use Symfony\Component\Console\Helper\Helper;

//use Carbon\Carbon;

//use URL;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        DB::enableQueryLog();
    }

    public function order_list($type=null)
    {
        $data['type'] = $type;
        if($type == 'primary')
        {
            $data['pageTitle'] = 'Primary Order List';
        }
        else if($type == 'secondary')
        {
            $data['pageTitle'] = 'Secondary Order List';
        }
        $data['breadcrumb'] = breadcrumb(array('active'=>ucfirst($type).' Order List'));
        $data['ajaxUrl'] = URL::to('orderListAjax/'.$type);
//        $data['searching_options'] = 'reports.order_list_search';
        $data['searching_options'] = 'grid.search_elements_all_single';


        $data['orders'] = reportsHelper::order_list_query($type,array());
        $data['aso_name'] = DB::table('orders')
            ->select('requester_name')
            ->groupBy('requester_name')->get();

        $data['houses'] = DB::table('orders')
            ->select('dh_name')
            ->groupBy('dh_name')->get();

        $data['routes'] = DB::table('orders')
            ->select('route_name')
            ->groupBy('route_name')->get();

        return view('reports.order_list',$data);
    }

    public function check_distribution_balack(Request $request)
    {
        $post = $request->all();
//        debug($post,1);
        $price = reportsHelper::getDistributorCurrentBalance($post);
        echo $price;
    }

    public function order_list_ajax(Request $request,$type=null)
    {
        $post = $request->all();
//        $searchValue = getSearchDataAll($post);
//        debug($searchValue,1);

        $data['type'] = $type;
        $data['orders'] = reportsHelper::order_list_query($type,$post);

        return view('reports.order_list_ajax',$data);
    }

    public function test_url()
    {
        return view('test_view');
    }
    public function salesList()
    {
        $data['ajaxUrl'] = URL::to('salesListAjax');
        $data['searching_options'] = 'reports.sales_list_search';

        $data['sales'] = DB::table('sales')->get();
        return view('reports.sales_list',$data);
    }

    public function primary_order_details($type,$id)
    {
        $data['type'] = $type;
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'order-list/'.$type,'active'=>ucfirst($type).' Order List'));
        $data['orders_info'] = DB::table('orders')
                        ->select('orders.*','distribution_houses.current_balance','distribution_houses.market_name','distribution_houses.point_name','distribution_houses.current_balance')
                        ->leftJoin('distribution_houses','distribution_houses.id','=','orders.dbid')
                        ->where('orders.id',$id)->first();

        $data['orders'] = DB::table('order_details')
                        ->select('skues.id as sid','order_details.*','skues.sku_name','brands.brand_name')
                        ->leftJoin('orders', 'orders.id', '=', 'order_details.orders_id')
                        ->leftJoin('skues', 'skues.short_name', '=', 'order_details.short_name')
                        ->leftJoin('brands','brands.id','=','skues.brands_id')
                        ->where('order_details.orders_id',$id)->get();
//        debug($data['orders'],1);

        //debug($data['orders'],1);

        $data['memo'] = memoStructure();
        //debug($memo,1);
        $object_info = collect($data['orders'])->toArray();

//        foreach ($memo as $k=>$mem){
//             foreach ($mem['sku_name'] as $kk=>$m){
//                 $key = array_search($kk, array_column($object_info, 'sid'));
//                 $memo[$k]['quantity'][$kk] =$object_info[$key]->quantity;
//                 $memo[$k]['short_name'][$kk] =$object_info[$key]->short_name;
//             }
//        }
//
//        $data['memo'] = $memo;


        if($type == 'primary')
        {
            return view('reports.order_details',$data);
        }
        else if($type == 'secondary')
        {
            return view('reports.order_details_secondary',$data);
        }
    }

    public function primary_sales_create(Request $request)
    {
        $post = $request->all();
//        debug($post,1);
        $salesdata = array(
            'asm_rsm_id'=>$post['asm_rsm_id'],
            'order_date'=>$post['order_date'],
            'sale_date'=>date('Y-m-d'),
            'sender_name'=>$post['sender_name'],
            'sender_phone'=>$post['sender_phone'],
            'dh_name'=>$post['dh_name'],
            'dh_phone'=>$post['dh_phone'],
            'sale_type'=>'Primary',
            'sale_total'=>array_sum($post['quantity']),
            'created_by'=>Auth::id()
        );
        $sale_id = DB::table('sales')->insertGetId($salesdata);

        $sales_details_data = array();
        $total_order = 0;
        foreach($post['quantity'] as $k=>$q)
        {
            $total_order = $total_order+($q*$post['price'][$k]);
            $sales_details_data['sales_id'] = $sale_id;
            $sales_details_data['short_name'] = $k;
            $sales_details_data['quantity'] = $q;
            $sales_details_data['price'] = $post['price'][$k];
            $sales_details_data['created_by'] = Auth::id();
            DB::table('sale_details')->insert($sales_details_data);
        }
        DB::table('orders')->where('id', $post['order_id'])->update(['order_status' => 'Processed']);

        stock_update($post['dh_id'],$post['quantity'],array(),$total_order,true);

        return redirect('order-list/primary')->with('success', 'Information has been added.');
    }


    public function updateSecondaryOrder(Request $request)
    {
        $post = $request->all();
        foreach($post['quantity'] as $k=>$q)
        {
            DB::table('order_details')->where('orders_id', $post['order_id'])->where('short_name',$k)->update(['quantity' => $q]);
        }
        DB::table('orders')->where('id', $post['order_id'])->update(['order_status' => 'Edited']);

        return redirect('order-list/secondary')->with('success', 'Information has been added.');
    }

    public function order_vs_sale_primary()
    {
        $data['ajaxUrl'] = URL::to('salesListAjax');
        $data['searching_options'] = 'reports.sales_list_search';

        $data['ordervssale'] = DB::table('order_details')
                            ->select('orders.id as oid','orders.requester_name','orders.order_date','orders.dh_name','orders.order_date','brands.brand_name','skues.sku_name','order_details.short_name','order_details.quantity','sales.sale_date','sale_details.quantity as salequantity')
                            ->leftJoin('orders','orders.id','=','order_details.orders_id')
                            ->leftJoin('sales',function($join){
                                $join->on('sales.asm_rsm_id','=','orders.asm_rsm_id')
                                    ->on('sales.order_date','=','orders.order_date');
                                })
                            ->leftJoin('sale_details',function ($join){
                                $join->on('sale_details.sales_id','=','sales.id')
                                    ->on('sale_details.short_name','=','order_details.short_name');
                            })
                            ->leftJoin('skues','skues.short_name','=','order_details.short_name')
                            ->leftJoin('brands','brands.id','=','skues.brands_id')
                            ->where('orders.order_type','Primary')
                            ->orderBy('orders.id', 'DESC')->get();
        //dd(DB::getQueryLog());
//        debug($data['ordervssale'],1);
        return view('reports.order_vs_sale_primary',$data);
    }

    public function  currentStock(){
        $data['ajaxUrl'] = URL::to('current-stock-search');
        $data['searching_options'] = 'reports.sales_list_search';

        $data['current_stocks'] = DB::table('stocks')
            ->select('stocks.quantity','distribution_houses.market_name','skues.sku_name','brands.brand_name')
            ->leftJoin('distribution_houses','distribution_houses.id','=','stocks.distributions_house_id')
            ->leftJoin('skues','skues.id','=','stocks.sku_id')
            ->leftJoin('brands','brands.id','=','skues.brands_id')->get();
        return view('reports.current_stock',$data);
    }

    public function currentStockSearch(Request $request){
        $data['current_stocks'] = DB::table('stocks')
            ->select('stocks.quantity','distribution_houses.market_name','skues.sku_name','brands.brand_name')
            ->leftJoin('distribution_houses','distribution_houses.id','=','stocks.distributions_house_id')
            ->leftJoin('skues','skues.id','=','stocks.sku_id')
            ->leftJoin('brands','brands.id','=','skues.brands_id')->get();
        return view('reports.current_stock_ajax',$data);
    }


}
