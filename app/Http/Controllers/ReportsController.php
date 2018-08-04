<?php

namespace App\Http\Controllers;

//use App\Models\Ordering;
use App\Models\DistributionHouse;
use App\Models\Reports;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use reportsHelper;
use Symfony\Component\Console\Helper\Helper;
use App\Models\Menu;
use App\Models\User;

//use Carbon\Carbon;

//use URL;

class ReportsController extends Controller
{
    private $routes;
    public function __construct()
    {
        $this->routes= json_decode(Session::get('routes_list'),true);
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


        $data['orders'] = reportsHelper::order_list_query($type,array(),$this->routes);
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
        $price = reportsHelper::getDistributorCurrentBalance($post);
        echo $price;
    }

    public function order_list_ajax(Request $request,$type=null)
    {
        $post = $request->all();
        $data['type'] = $type;
        $data['orders'] = reportsHelper::order_list_query($type,$post,$this->routes);

        return view('reports.order_list_ajax',$data);
    }

    public function salesList($type)
    {
        $data['pageTitle'] = ucfirst($type).' Sales List';
        $data['type'] = $type;
        $data['ajaxUrl'] = URL::to('salesListAjax/'.$type);
//        $data['searching_options'] = 'reports.sales_list_search';
        $data['searching_options'] = 'grid.search_elements_all_single';
        $data['breadcrumb'] = breadcrumb(array('active'=>ucfirst($type).' Sales List'));

        //$data['sales'] = DB::table('sales')->get();
        $data['sales'] = reportsHelper::sales_list_query($type,array());
        return view('reports.sales_list',$data);
    }

    public function sales_list_ajax(Request $request,$type=null)
    {
        $post = $request->all();
        $data['type'] = $type;
        $data['sales'] = reportsHelper::sales_list_query($type,$post);

        return view('reports.sales_list_ajax',$data);
    }

    public function salesDetails($type,$id)
    {
        $data['type'] = $type;
        $data['pageTitle'] = ucfirst($type).' Sales Details';
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'sales-list/'.$type,'active'=>ucfirst($type).' Sales Details'));

        $data['sales_info'] = DB::table('sales')
            ->select('sales.*','distribution_houses.current_balance','distribution_houses.market_name','distribution_houses.point_name','distribution_houses.current_balance')
            ->leftJoin('distribution_houses','distribution_houses.id','=','sales.dbid')
            ->where('sales.id',$id)->first();

//        debug($data['sales_info'],1);

//        $data['sales'] = DB::table('sale_details')
//            ->select('skues.id as sid','sale_details.*','skues.sku_name','brands.brand_name')
//            ->leftJoin('sales', 'sales.id', '=', 'sale_details.sales_id')
//            ->leftJoin('skues', 'skues.short_name', '=', 'sale_details.short_name')
//            ->leftJoin('brands','brands.id','=','skues.brands_id')
//            ->where('sale_details.sales_id',$id)->get();


        $data['sales'] = DB::table('skues')
            ->select('skues.id as sid','sale_details.*','order_details.quantity as order_quantity','skues.sku_name','brands.brand_name')
            ->leftJoin('sale_details',function ($join)use($id){
                $join->on('sale_details.short_name','=','skues.short_name')
                    ->where('sale_details.sales_id',$id);
            })
            ->leftJoin('sales',function ($join2){
                $join2->on('sales.id','=','sale_details.sales_id')
                    ->where('sales.sale_status','Processed');
            })
            ->leftJoin('orders',function($join){
                $join->on('orders.aso_id','=','sales.aso_id')
                    ->on('orders.order_date','=','sales.order_date');
            })
            ->leftJoin('order_details',function ($join){
                $join->on('order_details.orders_id','=','orders.id')
                    ->on('order_details.short_name','=','sale_details.short_name');
            })
            ->leftJoin('brands','brands.id','=','skues.brands_id')->groupBy('sale_details.short_name')->get();

//        debug($data['sales'],1);

        $data['memo'] = memoStructure();

        return view('reports.sales_details',$data);
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

        $data['memo'] = memoStructure();

        if($type == 'primary')
        {
            return view('reports.order_details',$data);
        }
        else if($type == 'secondary')
        {
            return view('reports.order_details_secondary',$data);
        }
    }

    public function getPackSizeQuanity(Request $request){
        $post=$request->all();
        return sku_pack_quantity($post['sku'],$post['quantity']);
    }

    private function getTotalAmount($post){
        $total_order_amount=0;
        foreach($post['quantity'] as $k=>$q)
        {
            $total_order_amount += (sku_pack_quantity($k,$q)*$post['price'][$k]);
        }
        return $total_order_amount;

    }

    public function primary_sales_create(Request $request)
    {
        $post = $request->all();
//        dd($post['current_balance'],$post['order_da'],$this->getTotalAmount($post),($post['current_balance']+$post['order_da']) - $this->getTotalAmount($post));


        $salesdata = array(
            'asm_rsm_id'=>$post['asm_rsm_id'],
            'dbid'=>$post['dh_id'],
            'order_id'=>$post['order_id'],
            'order_date'=>$post['order_date'],
            'sale_date'=>date('Y-m-d'),
            'sender_name'=>$post['sender_name'],
            'sender_phone'=>$post['sender_phone'],
            'dh_name'=>$post['dh_name'],
            'dh_phone'=>$post['dh_phone'],
            'sale_type'=>'Primary',
            'house_current_balance'=> ($post['current_balance']+$post['order_da']) - $this->getTotalAmount($post),
            'sale_total_sku'=>array_sum($post['quantity']),
            'created_by'=>Auth::id()
        );
        $pervious_data=getPreviousStockByAsoDate($post['asm_rsm_id'],$post['order_date'],0,'Primary');
        $previous_total=0;
        $previous_value=[];
        $da_update = true;
        if(!empty($pervious_data)){
            foreach($pervious_data as $key=>$value){
                $previous_value[$key]=$value;
                $previous_total +=(sku_pack_quantity($key,$value)*get_sku_price($key));
            }
           $da_update = false;
        }



        $sale_id = DB::table('sales')->insertGetId($salesdata);
        $sales_details_data =[];
        $present_value=[];
        $total_sale_amount = 0;
        foreach($post['quantity'] as $k=>$q)
        {
            if((float)$q>0){
                $present_value[$k]=$q;
                $total_sale_amount +=(sku_pack_quantity($k,$q)*$post['price'][$k]);
                $sales_details_data['sales_id'] = $sale_id;
                $sales_details_data['short_name'] = $k;
                $sales_details_data['quantity'] = $q;
                $sales_details_data['price'] = $post['price'][$k];
                $sales_details_data['created_by'] = Auth::id();
                DB::table('sale_details')->insert($sales_details_data);
            }

        }


        DB::table('orders')->where('id', $post['order_id'])->update(['order_status' => 'Processed']);
        DB::table('sales')->where('id', $sale_id)->update(['total_sale_amount' => $total_sale_amount]);
        if($da_update){
            DB::table('distribution_houses')->where('id', $post['dh_id'])->update(['current_balance' => DB::raw('current_balance + '.$post['order_da'])]);
        }

        stock_update($post['dh_id'],$present_value,$total_sale_amount,$previous_value,$previous_total,true);

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
                            ->select('distribution_houses.point_name','orders.id as oid','orders.requester_name','orders.order_date','orders.dh_name','orders.order_date','brands.brand_name','skues.sku_name','order_details.short_name','order_details.quantity','sales.sale_date','sale_details.quantity as salequantity')
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
                            ->leftJoin('distribution_houses','distribution_houses.id','=','orders.dbid')
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
            ->leftJoin('skues','skues.short_name','=','stocks.short_name')
            ->leftJoin('brands','brands.id','=','skues.brands_id')->get();
        return view('reports.current_stock',$data);
    }

    public function currentStockSearch(Request $request){
        $data['current_stocks'] = DB::table('stocks')
            ->select('stocks.quantity','distribution_houses.market_name','skues.sku_name','brands.brand_name')
            ->leftJoin('distribution_houses','distribution_houses.id','=','stocks.distributions_house_id')
            ->leftJoin('skues','skues.short_name','=','stocks.short_name')
            ->leftJoin('brands','brands.id','=','skues.brands_id')->get();
        return view('reports.current_stock_ajax',$data);
    }


    public function houseStock(Request $request){
//        debug(Auth::user(),1);
        $data['ajaxUrl'] = URL::to('house-stock-search');
        $data['view'] = 'house_stock_ajax';
        $data['header_level'] = 'House Wise Stock';
        $data['searching_options'] = 'grid.search_elements_all';
        $data['searchAreaOption'] = searchAreaOption(array('show','route','daterange','month'));
        $memo = repoStructure();
        $data['memo_structure']= $memo;
        $data['level'] = 1;
        $data['level_col_data'] =[];
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'','active'=>'House Wise Stock'));
        return view('reports.main',$data);
    }

    public function houseStockSearch(Request $request){

        $data['ajaxUrl'] = URL::to('house-stock-search');
        $data['searching_options'] = 'grid.search_elements_all';
        $post= $request->all();
        unset($post['_token']);
        $request_data = filter_array($post);

        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $memo = repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['memo_structure']= $memo;
        //$data['memo_structure1']= $memo;
        $data['level'] = 1;
        $data['level_col_data'] =[];

        //Requested Information
        $zone_ids=array_key_exists('zones_id',$request_data) ? $request_data['zones_id'] : [];
        $region_ids=array_key_exists('regions_id',$request_data) ? $request_data['regions_id'] : [];
        $territory_ids=array_key_exists('territories_id',$request_data) ? $request_data['territories_id'] : [];
        $house_ids=array_key_exists('id',$request_data) ? $request_data['id'] : [];
        $get_info= Reports::getInfo($zone_ids,$region_ids,$territory_ids,$house_ids);
        $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
        $selected_houses =array_filter($selected_houses);

        $data['house_stock_list'] = Reports::getHouseStockInfo($selected_houses,$memo);


        return view('reports.ajax.house_stock_ajax',$data);

    }

    public function houseLifting(Request $request){
        $data['ajaxUrl'] = URL::to('house-lifting-search');
        $data['view'] = 'house_lifting_ajax';
        $data['header_level'] = ' House Wise Lifting';
        $data['searching_options'] = 'grid.search_elements_all';
        $data['searchAreaOption'] = searchAreaOption(array('show','route','daterange','month'));
        $memo = repoStructure();
        $data['level'] = 2;
        $data['level_col_data'] =['Requested','Delivery'];
        $data['memo_structure']= $memo;
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'','active'=>'House Wise Lifting'));
        return view('reports.main',$data);
    }

    public function houseLiftingSearch(Request $request){
        $data['ajaxUrl'] = URL::to('house-lifting-search');
        $data['searching_options'] = 'grid.search_elements_all';

        //request data
        $post= $request->all();
        unset($post['_token']);
        $request_data = filter_array($post);

        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];


        //Requested Information
        $zone_ids=array_key_exists('zones_id',$request_data) ? $request_data['zones_id'] : [];
        $region_ids=array_key_exists('regions_id',$request_data) ? $request_data['regions_id'] : [];
        $territory_ids=array_key_exists('territories_id',$request_data) ? $request_data['territories_id'] : [];
        $house_ids=array_key_exists('id',$request_data) ? $request_data['id'] : [];
        $get_info= Reports::getInfo($zone_ids,$region_ids,$territory_ids,$house_ids);
        $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
        $selected_houses =array_filter($selected_houses);



        $data['house_lifting_list'] = Reports::getHouseLifting($selected_houses, $data['memo_structure']);


        return view('reports.ajax.house_lifting_ajax',$data);

    }

    public function houseWisePerformance(Request $request){
        $data['ajaxUrl'] = URL::to('db-wise-performance-search');
        $data['searching_options'] = 'grid.search_elements_all';
        $data['view'] = 'db_wise_performance_ajax';
        $data['header_level'] = ' DB House Wise Performance';
        $data['searchAreaOption'] = searchAreaOption(array('show','route','daterange'));
        $memo = repoStructure();
        $data['level'] = 3;
        $data['level_col_data'] =['Target','Sales','Ach%'];
        $data['memo_structure']= $memo;
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'','active'=>'DB House Wise Performance'));
        return view('reports.main',$data);
    }

    public function houseWisePerformanceSearch(Request $request){
        $data['ajaxUrl'] = URL::to('db-wise-performance-search');
        $data['searching_options'] = 'grid.search_elements_all';

        //request data
        $post= $request->all();
        unset($post['_token']);
        $request_data = filter_array($post);

        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 3;
        $data['level_col_data'] =['Target','Sales','Ach%'];

        //Requested Information
        $zone_ids=array_key_exists('zones_id',$request_data) ? $request_data['zones_id'] : [];
        $region_ids=array_key_exists('regions_id',$request_data) ? $request_data['regions_id'] : [];
        $territory_ids=array_key_exists('territories_id',$request_data) ? $request_data['territories_id'] : [];
        $house_ids=array_key_exists('id',$request_data) ? $request_data['id'] : [];
        $selected_months=array_key_exists('month',$request_data) ? $request_data['month'] : [];
        $get_info= Reports::getInfo($zone_ids,$region_ids,$territory_ids,$house_ids);
        $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
        $selected_houses =array_filter($selected_houses);
        $data['house_wise_performance'] = Reports::houseWisePerformance($selected_houses, $data['memo_structure'],$selected_months);


        return view('reports.ajax.db_wise_performance_ajax',$data);
    }

    public function routeWisePerformenceByCategory(){
        $data['ajaxUrl'] = URL::to('route-wise-performence-by-category-ajax');
        $data['searching_options'] = 'grid.search_elements_all';
        $data['view'] = 'route_wise_performence_by_category_ajax';
        $data['header_level'] = 'Route Wise Performence By Category';
        $data['searchAreaOption'] = searchAreaOption(array('show','daterange'));
        $memo = repoStructure();
        $data['memo_structure']= $memo;
        $data['level'] = 3;
        $data['level_col_data'] =['Target','Sale','Ach%'];
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'','active'=>'Route Wise Performence By Category'));
        return view('reports.main',$data);
    }

    public function routeWisePerformenceByCategoryAjax(Request $request)
    {
        $data['ajaxUrl'] = URL::to('route-wise-performence-by-category-ajax');
        $data['searching_options'] = 'grid.search_elements_all';

        //request data
        $post= $request->all();
        unset($post['_token']);
        $request_data = filter_array($post);

        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 3;
        $data['level_col_data'] =['Target','Sales','Ach%'];

        $zone_ids=array_key_exists('zones_id',$request_data) ? $request_data['zones_id'] : [];
        $region_ids=array_key_exists('regions_id',$request_data) ? $request_data['regions_id'] : [];
        $territory_ids=array_key_exists('territories_id',$request_data) ? $request_data['territories_id'] : [];
        $house_ids=array_key_exists('id',$request_data) ? $request_data['id'] : [];
        $route_ids=array_key_exists('aso_id',$request_data) ? $request_data['aso_id'] : [];
        $selected_months=array_key_exists('month',$request_data) ? $request_data['month'] : [];
        if(count($route_ids) == 0 ){
            $get_info= Reports::getInfo($zone_ids,$region_ids,$territory_ids,$house_ids);
            $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
            $selected_houses =array_filter($selected_houses);
            $selected_route=Reports::getRouteInfoByHouse($selected_houses);
        }else{
            $selected_route=Reports::getRouteInfoByAso($route_ids);
        }
        $data['route_wise_performance'] = Reports::routeWisePerformance($selected_route, $data['memo_structure'],$selected_months);

        return view('reports.ajax.route_wise_performence_by_category_ajax',$data);

    }
    public function strikeRateByCategory(Request $request){
        $data['ajaxUrl'] = URL::to('strike-rate-search');
        $data['searching_options'] = 'grid.search_elements_all';
        $data['view'] = 'strike_rate_ajax';
        $data['header_level'] = 'Strike Rate By Category';
        $data['searchAreaOption'] = searchAreaOption(array('show','month'));
        $memo = repoStructure();
        $data['memo_structure']= $memo;
        $data['level'] = 5;
        $data['level_col_data'] =['Prod','Avg/Mem','Vol/Mem','Prot','Bouc Call'];
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'','active'=>'Strike Rate By Category'));
        return view('reports.main',$data);
    }

    public function strikeRateByCategoryAjax(Request $request){

        $data['ajaxUrl'] = URL::to('strike-rate-search');
        $data['searching_options'] = 'grid.search_elements_all';

        //request data
        $post= $request->all();
        unset($post['_token']);
        $request_data = filter_array($post);

        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['searchAreaOption'] = searchAreaOption(array('show','month'));
        $memo =repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['memo_structure']= $memo;
        $data['level'] = 5;
        $data['level_col_data'] =['Prod','Avg/Mem','Vol/Mem','Port','Bouc Call'];

        //req

        $zone_ids=array_key_exists('zones_id',$request_data) ? $request_data['zones_id'] : [];
        $region_ids=array_key_exists('regions_id',$request_data) ? $request_data['regions_id'] : [];
        $territory_ids=array_key_exists('territories_id',$request_data) ? $request_data['territories_id'] : [];
        $house_ids=array_key_exists('id',$request_data) ? $request_data['id'] : [];
        $route_ids=array_key_exists('aso_id',$request_data) ? $request_data['aso_id'] : [];
        $selected_months=array_key_exists('created_at',$request_data) ? $request_data['created_at'] : [];
        if(count($route_ids) == 0){
            $get_info= Reports::getInfo($zone_ids,$region_ids,$territory_ids,$house_ids);
            $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
            $selected_houses =array_filter($selected_houses);
            $selected_route=Reports::getRouteInfoByHouse($selected_houses);
        }
        else{
            $selected_route=Reports::getRouteInfoByAso($route_ids);
        }

        $data['route_wise_strike_rate'] = Reports::routeWiseStrikeRate($selected_route, $data['memo_structure'],$selected_months);

        //dd($data['route_wise_strike_rate']);


        return view('reports.ajax.strike_rate_ajax',$data);


    }

    public function monthlySaleReconcilation(Request $request){
        $data['ajaxUrl'] = URL::to('monthly-sale-reconc-search');
        $data['searching_options'] = 'grid.search_elements_all';

        $data['searchAreaOption'] = searchAreaOption(array('show','route','daterange'));
        $memo = repoStructure();
        $data['memo_structure']= $memo;
        $data['level'] = 4;
        $data['level_col_data'] =['Opening','Lifting','Sales','Closing Stock'];
        return view('reports.monthly_sale_recon',$data);
    }

    public function monthlySaleReconcilationAjax(Request $request){
        $data['ajaxUrl'] = URL::to('strike-rate-search');
        $data['searching_options'] = 'grid.search_elements_all';

        //request data
        $post= $request->all();
        unset($post['_token']);
        $request_data = filter_array($post);

        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['searchAreaOption'] = searchAreaOption(array('show','month'));
        $memo =repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['memo_structure']= $memo;
        $data['level'] = 4;
        $data['level_col_data'] =['Opening','Lifting','Sales','Closing Stock'];

        //Requested Information
        $zone_ids=array_key_exists('zones_id',$request_data) ? $request_data['zones_id'] : [];
        $region_ids=array_key_exists('regions_id',$request_data) ? $request_data['regions_id'] : [];
        $territory_ids=array_key_exists('territories_id',$request_data) ? $request_data['territories_id'] : [];
        $house_ids=array_key_exists('id',$request_data) ? $request_data['id'] : [];
        $get_info= Reports::getInfo($zone_ids,$region_ids,$territory_ids,$house_ids);
        $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
        $selected_houses =array_filter($selected_houses);
        $selected_months=array_key_exists('month',$request_data) ? $request_data['month'] : [];

        $data['house_wise_monthly_recon'] = monthly_sale_recon_by_house($selected_houses, $data['memo_structure'],$selected_months);

        return view('reports.monthly_sale_recon_ajax',$data);
    }

    public function saleSummaryMonth(Request $request){
        $data['ajaxUrl'] = URL::to('sale-summary-month-search');
        $data['searching_options'] = 'grid.search_elements_all';
        //$data['searchAreaOption'] = array('show'=>1,'daterange'=>0);
        $data['searchAreaOption'] = searchAreaOption(array('show'));
        $memo = repoStructure();
        $data['memo_structure']= $memo;
        $data['level'] = 4;
        $data['level_col_data'] =['Target','RDT','Order','Sale','Cum Ach%'];
        return view('reports.sale_summary_by_month',$data);
    }

    public function saleSummaryMonthAjax(Request $request){
        $data['ajaxUrl'] = URL::to('sale-summary-month-search');
        $data['searching_options'] = 'grid.search_elements_all';

        //request data
        $post= $request->all();
        unset($post['_token']);
        $request_data = filter_array($post);

        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 4;
        $data['level_col_data'] =['RDT','Order','Sale','Cum Ach%'];

        //Request
        $zone_ids=array_key_exists('zones_id',$request_data) ? $request_data['zones_id'] : [];
        $region_ids=array_key_exists('regions_id',$request_data) ? $request_data['regions_id'] : [];
        $territory_ids=array_key_exists('territories_id',$request_data) ? $request_data['territories_id'] : [];
        $house_ids=array_key_exists('id',$request_data) ? $request_data['id'] : [];
        $route_ids=array_key_exists('aso_id',$request_data) ? $request_data['aso_id'] : [];
        $selected_months=array_key_exists('month',$request_data) ? $request_data['month'] : [];
        $selected_date_range = key_exists('created_at',$request_data) ? $request_data['created_at'] : [];

        if(count($route_ids) == 0 ){
            $get_info= Reports::getInfo($zone_ids,$region_ids,$territory_ids,$house_ids);
            $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
            $selected_houses =array_filter($selected_houses);
            $selected_route=Reports::getRouteInfoByHouse($selected_houses);
        }else{
            $selected_route=Reports::getRouteInfoByAso($route_ids);
        }

        $data['sale_summary_by_month'] = dailySaleSummaryByMonth($selected_route, $data['memo_structure'],$selected_months,$selected_date_range);


        return view('reports.sale_summary_by_month_ajax',$data);
    }

    public function orderVsSaleSecondary(Request $request){
        $data['ajaxUrl'] = URL::to('order-vs-sale-secondary-search');
        $data['searching_options'] = 'grid.search_elements_all';
        $data['view'] = 'order_vs_sale_secondary_ajax';
        $data['header_level'] = 'Order VS Sale Secondary';
        $data['searchAreaOption'] = searchAreaOption(array('show','month'));
        $data['memo_structure']=repoStructure();
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'','active'=>'order vs sale secondary'));
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];
        return view('reports.main',$data);
    }

    public function orderVsSaleSecondaryAjax(Request $request){
        $data['ajaxUrl'] = URL::to('order-vs-sale-secondary-search');
        $data['searching_options'] = 'grid.search_elements_all';

        //request data
        $post= $request->all();
//        debug($post,1);
        unset($post['_token']);
        $request_data = filter_array($post);
        $data['post_data'] = $post;
        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];


        //Request

        $zone_ids=array_key_exists('zones_id',$request_data) ? $request_data['zones_id'] : [];
        $region_ids=array_key_exists('regions_id',$request_data) ? $request_data['regions_id'] : [];
        $territory_ids=array_key_exists('territories_id',$request_data) ? $request_data['territories_id'] : [];
        $house_ids=array_key_exists('id',$request_data) ? $request_data['id'] : [];
        $route_ids=array_key_exists('aso_id',$request_data) ? $request_data['aso_id'] : [];
        $selected_date_range = key_exists('created_at',$request_data) ? $request_data['created_at'] : [];

        if(count($route_ids) == 0 ){
            $get_info= Reports::getInfo($zone_ids,$region_ids,$territory_ids,$house_ids);
            $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
            $selected_houses =array_filter($selected_houses);
            $selected_route=Reports::getRouteInfoByHouse($selected_houses);
        }else{
            $selected_route=Reports::getRouteInfoByAso($route_ids);
        }


        $data['order_vs_sale_secondary'] = orderVsSaleSecondary($selected_route, $data['memo_structure'],$selected_date_range);


        return view('reports.ajax.order_vs_sale_secondary_ajax',$data);
    }


    public function orderVsSaleSecondaryAso($dbid,$postdata){
        $post= json_decode($postdata,true);
        $data['post_data'] = $post;
        $data['ajaxUrl'] = URL::to('order-vs-sale-secondary-aso-search/'.$dbid);
        $data['view'] = 'order_vs_sale_secondary_aso_ajax';
        $data['header_level'] = ' Order VS Sale Secondary By ASO';
        $data['searching_options'] = 'grid.search_elements_all';
        $data['searchAreaOption'] = searchAreaOption(array('show','month','zone','region','territory','house'));
        $data['memo_structure']=repoStructure();
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'','active'=>'order vs sale secondary by ASO'));
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];


//        --------
        $request_data = filter_array($post);
        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];
        //Request
        $house_ids=array_key_exists('id',$request_data) ? $request_data['id'] : array('id'=>$dbid);
        $route_ids=array_key_exists('aso_id',$request_data) ? $request_data['aso_id'] : [];
        $selected_date_range = key_exists('created_at',$request_data) ? $request_data['created_at'] : [];
        if(count($route_ids) == 0 ){
            $get_info= Reports::getInfo([],[],[],$house_ids);
            $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
            $selected_houses =array_filter($selected_houses);
            $selected_route=Reports::getRouteInfoByHouse($selected_houses);
        }else{
            $selected_route=Reports::getRouteInfoByAso($route_ids);
        }
        $data['order_vs_sale_secondary'] = orderVsSaleSecondaryAso($selected_route, $data['memo_structure'],$selected_date_range);
//        --------




        return view('reports.main',$data);
    }

    public function orderVsSaleSecondaryAsoSearch(Request $request, $dbid=null){
//        $data['ajaxUrl'] = URL::to('order-vs-sale-secondary-search');
//        $data['searching_options'] = 'grid.search_elements_all';

        //request data
        $post= $request->all();
//        debug($post,1);
        unset($post['_token']);
        $request_data = filter_array($post);
        $data['post_data'] = $post;
        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];


        //Request

        $house_ids=array_key_exists('id',$request_data) ? $request_data['id'] : array('id'=>$dbid);
        $route_ids=array_key_exists('aso_id',$request_data) ? $request_data['aso_id'] : [];

        $selected_date_range = key_exists('created_at',$request_data) ? $request_data['created_at'] : [];

        if(count($route_ids) == 0 ){
            $get_info= Reports::getInfo([],[],[],$house_ids);
            $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
            $selected_houses =array_filter($selected_houses);
            $selected_route=Reports::getRouteInfoByHouse($selected_houses);
        }else{
            $selected_route=Reports::getRouteInfoByAso($route_ids);
        }

        $data['order_vs_sale_secondary'] = orderVsSaleSecondaryAso($selected_route, $data['memo_structure'],$selected_date_range);

        return view('reports.ajax.order_vs_sale_secondary_aso_ajax',$data);
    }



    public function orderVsSaleSecondaryRoute($aso_id,$postdata){
        $post= json_decode($postdata,true);
        $data['post_data'] = $post;
        $data['ajaxUrl'] = URL::to('order-vs-sale-secondary-route-search/'.$aso_id);
        $data['view'] = 'order_vs_sale_secondary_route_ajax';
        $data['header_level'] = ' Order VS Sale Secondary By Route';
        $data['searching_options'] = 'grid.search_elements_all';
        $data['searchAreaOption'] = searchAreaOption(array('show','month','zone','region','territory','house'));
        $data['memo_structure']=repoStructure();
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'','active'=>'order vs sale secondary by Route'));
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];


//        --------
        $request_data = filter_array($post);
        $data['post_data'] = $post;

        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];


        //Request

        $route_ids=array_key_exists('aso_id',$request_data) ? $request_data['aso_id'] : array('id'=>$aso_id);

        $selected_date_range = key_exists('created_at',$request_data) ? $request_data['created_at'] : [];

        if(count($route_ids) == 0 ){
            $get_info= Reports::getInfo([],[],[],[]);
            $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
            $selected_houses =array_filter($selected_houses);
            $selected_route=Reports::getRouteInfoByHouse($selected_houses);
        }else{
            $selected_route=Reports::getRouteInfoByAso($route_ids);
        }

        $data['order_vs_sale_secondary'] = orderVsSaleSecondaryRoute($selected_route, $data['memo_structure'],$selected_date_range);
//        --------




        return view('reports.main',$data);
    }


    public function orderVsSaleSecondaryRouteSearch(Request $request, $aso_id=null){
        $post= $request->all();

        unset($post['_token']);
        $request_data = filter_array($post);
        $data['post_data'] = $post;
//        debug($request_data,1);
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];


        //Request

        $route_ids=array_key_exists('aso_id',$request_data) ? $request_data['aso_id'] : array('id'=>$aso_id);
//debug($route_ids,1);
        $selected_date_range = key_exists('created_at',$request_data) ? $request_data['created_at'] : [];

        if(count($route_ids) == 0 ){
            $get_info= Reports::getInfo([],[],[],[]);
            $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
            $selected_houses =array_filter($selected_houses);
            $selected_route=Reports::getRouteInfoByHouse($selected_houses);
        }else{
            $selected_route=Reports::getRouteInfoByAso($route_ids);
        }
//        debug($selected_route,1);
        $data['order_vs_sale_secondary'] = orderVsSaleSecondaryRoute($selected_route, $data['memo_structure'],$selected_date_range);
//        debug($data['order_vs_sale_secondary'],1);

        return view('reports.ajax.order_vs_sale_secondary_route_ajax',$data);
    }


    public function orderVsSaleSecondaryDate($aso_id,$route_id,$postdata){
        $post= json_decode($postdata,true);
        $data['post_data'] = $post;
        $data['ajaxUrl'] = URL::to('order-vs-sale-secondary-date-search/'.$aso_id.'/'.$route_id);
        $data['view'] = 'order_vs_sale_secondary_date_ajax';
        $data['header_level'] = 'Order VS Sale Secondary By Date';
        $data['searching_options'] = 'grid.search_elements_all';
        $data['searchAreaOption'] = searchAreaOption(array('show','month','zone','region','territory','house'));
        $data['memo_structure']=repoStructure();
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'','active'=>'order vs sale secondary by Route'));
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];


//        --------
        $request_data = filter_array($post);
        $data['post_data'] = $post;
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];

        //Request

        $route_ids=array_key_exists('aso_id',$request_data) ? $request_data['aso_id'] : array('id'=>$aso_id);
        $selected_date_range = key_exists('created_at',$request_data) ? $request_data['created_at'] : [];

        if(count($route_ids) == 0 ){
            $get_info= Reports::getInfo([],[],[],[]);
            $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
            $selected_houses =array_filter($selected_houses);
            $selected_route=Reports::getRouteInfoByHouse($selected_houses);
        }else{
            $selected_route=Reports::getRouteInfoByAso($route_ids);
        }
        $data['order_vs_sale_secondary'] = Reports::orderVsSaleSecondaryDate($route_id,$selected_route, $data['memo_structure'],$selected_date_range);

//        --------




        return view('reports.main',$data);
    }



    public function orderVsSaleSecondaryDateSearch(Request $request, $aso_id=null,$route_id=null){
        $post= $request->all();
//        debug($route_id,1);
        unset($post['_token']);
        $request_data = filter_array($post);
        $data['post_data'] = $post;
//        debug($request_data,1);
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];


        //Request

        $route_ids=array_key_exists('aso_id',$request_data) ? $request_data['aso_id'] : array('id'=>$aso_id);
//        debug($route_ids,1);
        $selected_date_range = key_exists('created_at',$request_data) ? $request_data['created_at'] : [];

        if(count($route_ids) == 0 ){
            $get_info= Reports::getInfo([],[],[],[]);
            $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
            $selected_houses =array_filter($selected_houses);
            $selected_route=Reports::getRouteInfoByHouse($selected_houses);
        }else{
            $selected_route=Reports::getRouteInfoByAso($route_ids);
        }
//        debug($selected_route,1);
        //$data['order_vs_sale_secondary'] = orderVsSaleSecondaryRoute($selected_route, $data['memo_structure'],$selected_date_range);
        $data['order_vs_sale_secondary'] = Reports::orderVsSaleSecondaryDate($route_id,$selected_route, $data['memo_structure'],$selected_date_range);

        return view('reports.ajax.order_vs_sale_secondary_date_ajax',$data);
    }


    //primary order vs sale
    public function orderVsSalePrimary(Request $request){
        $data['ajaxUrl'] = URL::to('order-vs-sale-primary-search');
        $data['searching_options'] = 'grid.search_elements_all';
        $data['view'] = 'order_vs_sale_primary_ajax';
        $data['header_level'] = 'Order Vs Sale (Primary)';
        $data['searchAreaOption'] = searchAreaOption(array('show','month','route'));
        $data['memo_structure']=repoStructure();
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'','active'=>'order vs sale secondary'));
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];
        return view('reports.main',$data);
    }

    public function orderVsSalePrimarySearch(Request $request){
        $data['ajaxUrl'] = URL::to('order-vs-sale-primary-search');
        $data['searching_options'] = 'grid.search_elements_all';

        //request data
        $post= $request->all();
        unset($post['_token']);
        $request_data = filter_array($post);

        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];

        //Requested Information
        $zone_ids=array_key_exists('zones_id',$request_data) ? $request_data['zones_id'] : [];
        $region_ids=array_key_exists('regions_id',$request_data) ? $request_data['regions_id'] : [];
        $territory_ids=array_key_exists('territories_id',$request_data) ? $request_data['territories_id'] : [];
        $house_ids=array_key_exists('id',$request_data) ? $request_data['id'] : [];
        $get_info= Reports::getInfo($zone_ids,$region_ids,$territory_ids,$house_ids);
        $selected_houses=array_unique(array_column($get_info,'distribution_house_id'), SORT_REGULAR);
        $selected_date_range = key_exists('created_at',$request_data) ? $request_data['created_at'] : [];
        $selected_houses =array_filter($selected_houses);
        $data['post_data'] = $post;
        $data['order_vs_sale_primary'] = Reports::order_vs_sale_primary_by_house($selected_houses, $data['memo_structure'],$selected_date_range);

//        dd( $data['order_vs_sale_primary'] );
        return view('reports.ajax.order_vs_sale_primary_ajax',$data);
    }

    public function orderVsSalePrimaryDateWise(Request $request,$house_id,$post_data){
        $request_pass_data = json_decode($post_data,true);
        unset($request_pass_data['_token']);
        $request_data = filter_array($request_pass_data);
        $data['ajaxUrl'] = URL::to('order-vs-sale-primary-date-wise-search/'.$house_id);
        $data['view'] = 'order_vs_sale_primary_ajax';
        $data['header_level'] = 'Order Vs Sale (Primary)';

        $data['searching_options'] = 'grid.search_elements_all';
        //$data['searchAreaOption'] = array('show'=>1,'daterange'=>0);
        $data['searchAreaOption'] = searchAreaOption(array('show','month','route','zone','region','territory','house'));
        $data['breadcrumb'] = breadcrumb(array('Reports'=>'','active'=>'order vs sale secondary'));
        //memo
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];
        $selected_date_range = key_exists('created_at',$request_data) ? $request_data['created_at'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];
        $data['post_data'] = $post_data;
        $data['date_wise'] = true;
        $data['current_balance']= true;
        $data['order_vs_sale_primary'] = Reports::order_vs_sale_primary_by_date($house_id, $data['memo_structure'],$selected_date_range);
        return view('reports.main',$data);
    }

    public function orderVsSalePrimaryDateWiseSearch(Request $request,$house_id){
        $post= $request->all();
        unset($post['_token']);
        $request_data = filter_array($post);

        //memeo structure
        $categorie_ids =array_key_exists('category_id',$request_data) ? $request_data['category_id'] : [];
        $brand_ids =array_key_exists('brands_id',$request_data) ? $request_data['brands_id'] : [];
        $sku_ids =array_key_exists('skues_id',$request_data) ? $request_data['skues_id'] : [];

        $data['memo_structure']= repoStructure($categorie_ids,$brand_ids,$sku_ids);
        $data['level'] = 2;
        $data['level_col_data'] =['Req','Del'];

        //Requested Information
        $selected_date_range = key_exists('created_at',$request_data) ? $request_data['created_at'] : [];

        $data['post_data'] = $post;
        $data['current_balance']= true;
        $data['order_vs_sale_primary'] = Reports::order_vs_sale_primary_by_date($house_id, $data['memo_structure'],$selected_date_range);

        return view('reports.ajax.order_vs_sale_primary_ajax',$data);
    }



}
