<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reports extends Model
{
    //constructor


    public static function getInfo($zone_ids=[],$region_ids=[],$territory_ids=[],$house_ids=[],$category_ids=[],$brand_ids=[],$sku_ids=[]){
        $query=User::query();
        if(count($zone_ids) > 0){
            $query=$query->whereIn('zones_id',$zone_ids);
        }
        if(count($region_ids) > 0){
            $query=$query->whereIn('regions_id',$region_ids);
        }
        if(count($territory_ids) > 0){
            $query=$query->whereIn('territories_id',$territory_ids);
        }
        if(count($house_ids) > 0){
            $query=$query->whereIn('distribution_house_id',$house_ids);
        }
        $result=$query->get()->toArray();
        return $result;
    }

    public static function getHouseStockInfo($ids,$selected_memo){
        $house_stock_list=[];
        foreach ($ids as $house_key=>$house_value){
            $house=DistributionHouse::where('id',$house_value)->first()->toArray();
            $sku_quantity=[];
            foreach ($selected_memo as $cat_key=>$cat_val){
                $selected_skue=array_values($cat_val);
                $selected_skues=array_flatten($selected_skue);
                foreach ($selected_skues as $key => $value){
                    $data=Stocks::where('distributions_house_id',$house_value)->where('short_name',$value)->first();
                    if(!empty($data)){
                        $sku_quantity[] = $data['quantity'];
                    }

                }
            }

            $house_stock_list[$house['point_name']]['data']=$sku_quantity;
            $house_stock_list[$house['point_name']]['current_balance']=$house['current_balance'];

        }
        return $house_stock_list;
    }

    public static function getRouteInfoByHouse($house_ids){
        $data = User::where('user_type','market')->whereIn('distribution_house_id',$house_ids)->get()->toArray();
        return $data;
    }

    public static function getRouteInfoHouse($house_ids){
        $data = Routes::select('routes.*','users.id as uid','users.name as uname','distribution_houses.point_name')
            ->leftJoin('users','users.id','=','routes.so_aso_user_id')
            ->leftJoin('distribution_houses','distribution_houses.id','=','routes.distribution_houses_id')
            ->where('users.user_type','market')->whereIn('routes.distribution_houses_id',$house_ids)->get()->toArray();
        return $data;
    }
    public static function getRouteInfoByAso($route_ids){
        $data = User::where('user_type','market')->whereIn('id',$route_ids)->get()->toArray();
        return $data;
    }
    public static function getRouteInfoAso($route_ids){
        $data = Routes::select('routes.*','users.id as uid','users.name as uname','distribution_houses.point_name')
            ->leftJoin('users','users.id','=','routes.so_aso_user_id')
            ->leftJoin('distribution_houses','distribution_houses.id','=','routes.distribution_houses_id')->where('users.user_type','market')->whereIn('routes.id',$route_ids)->get()->toArray();
        return $data;
    }

    public static  function getHouseLifting($ids,$selected_memo){
        $house_lifting_list=[];
        foreach ($ids as $house_key=>$house_value){
            $house = DistributionHouse::where('id',$house_value)->first()->toArray();
            $selected_asm_rsm = User::where('territories_id',$house['territories_id'])->where('user_type','territory')->first();
            $sku_order_info=[];
            foreach ($selected_memo as $cat_key=>$cat_val){
                $selected_skues=array_flatten($cat_val);
                foreach ($selected_skues as $key => $value){
                    if(isset($selected_asm_rsm->id)){
                        $data = DB::table('order_details')
                            ->select('brands.brand_name','skues.sku_name','order_details.short_name','order_details.quantity as oquantity','sale_details.quantity as salequantity')
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
                            ->where('orders.asm_rsm_id',$selected_asm_rsm->id)
                            ->where('orders.dbid',$house_value)
                            ->where('order_details.short_name',$value)
                            ->orderBy('orders.id', 'DESC');
                        if($data->exists()){
                            $dt= $data->get()->toArray();
                            $order_quantity = count_sku(array_column($dt,'oquantity'));
                            $saler_quantity = count_sku(array_column($dt,'salequantity'));
                            $sku_order_info[]=[
                                $order_quantity,
                                $saler_quantity
                            ];
                        }
                        else{
                            $sku_order_info[]=[
                                'N/R','N/P'
                            ];
                        }
                    }
                    else{
                        $sku_order_info[]=[
                            'N/R','N/P'
                        ];
                    }

                }
            }

            $house_lifting_list[$house['point_name']]=$sku_order_info;
        }
        return $house_lifting_list;
    }


    public static function individual_routes_info($route_id)
    {
        $result = DB::table('routes')
            ->select('routes.routes_code','routes.routes_name','distribution_houses.market_name','distribution_houses.point_name','distribution_houses.propietor_address')
            ->leftJoin('distribution_houses','distribution_houses.id','=','routes.distribution_houses_id')
            ->where('routes.id',$route_id)
            ->first();
        return $result;
    }


    public static  function get_sale_by_month_house($db_id,$sku_name,$month){
        $date = date_parse($month);
        $data =  DB::table('sales')
            ->select('sales.id','sale_details.quantity')
            ->join('sale_details','sales_id','=','sales.id')
            ->where('sale_details.short_name',$sku_name)
            ->where('sales.dbid',$db_id)
            ->where('sales.sale_type','Secondary')
            ->whereYear('sales.order_date',$date['year'])
            ->whereMonth('sales.order_date',$date['month'])
            ->get()->toArray();
        $count =0 ;
        if(count($data) > 0){
            foreach ($data as $val){
                $count += (int) $val->quantity;
            }
        }
        return $count;
    }

    public static function get_sale_by_month_route($aso_id,$sku_name,$month){
        $date = date_parse($month);

        $data =  DB::table('sales')
            ->select('sales.id','sale_details.quantity')
            ->join('sale_details','sales_id','=','sales.id')
            ->where('sale_details.short_name',$sku_name)
            ->where('sales.aso_id',$aso_id)
            ->where('sales.sale_type','Secondary')
            ->whereYear('sales.order_date',$date['year'])
            ->whereMonth('sales.order_date',$date['month'])
            ->get()->toArray();
        $count =0 ;
        if(count($data) > 0){
            foreach ($data as $val){
                $count += (int) $val->quantity;
            }
        }
        return $count;
    }

    public static function getSecondaryOrderSaleByIds($ids){
        $data =DB::table('skues')
            ->select('distribution_houses.id','distribution_houses.point_name','skues.short_name','orders.requester_name','skues.short_name',DB::raw('SUM(order_details.quantity) as order_quantity'),DB::raw('SUM(sale_details.quantity) as sale_quantity'))
            ->leftJoin('order_details','order_details.short_name','=','skues.short_name')
            ->leftJoin('orders','orders.id','=','order_details.orders_id')
            ->leftJoin('sales',function($join){
                $join->on('sales.aso_id','=','orders.aso_id')
                    ->on('sales.order_date','=','orders.order_date');
            })
            ->leftJoin('sale_details',function ($join){
                $join->on('sale_details.sales_id','=','sales.id')
                    ->on('sale_details.short_name','=','order_details.short_name');
            })
            ->leftJoin('distribution_houses','distribution_houses.id','=','orders.dbid')
            ->where('orders.order_type','Secondary')
            ->where('orders.order_status','Processed')
            ->whereIn('orders.aso_id',$ids)
            ->groupBy('skues.short_name')
            ->groupBy('distribution_houses.point_name')
            ->get();
        return $data;
    }

    public static  function getSecondaryOrderAsoSaleByIds($ids,$selected_date_range){
//        debug($ids,1);
        $data =DB::table('skues')
            ->select('distribution_houses.id','orders.aso_id','distribution_houses.point_name','skues.short_name','orders.requester_name','skues.short_name',DB::raw('SUM(order_details.quantity) as order_quantity'),DB::raw('SUM(sale_details.quantity) as sale_quantity'))
            ->leftJoin('order_details','order_details.short_name','=','skues.short_name')
            ->leftJoin('orders','orders.id','=','order_details.orders_id')
            ->leftJoin('sales',function($join){
                $join->on('sales.aso_id','=','orders.aso_id')
                    ->on('sales.order_date','=','orders.order_date');
            })
            ->leftJoin('sale_details',function ($join){
                $join->on('sale_details.sales_id','=','sales.id')
                    ->on('sale_details.short_name','=','order_details.short_name');
            })
            ->leftJoin('distribution_houses','distribution_houses.id','=','orders.dbid')
            ->where('orders.order_type','Secondary')
            ->where('orders.order_status','Processed')
            ->where('orders.order_status','Processed')
            ->whereIn('orders.aso_id',$ids)
            ->whereBetween('orders.order_date',array_map('trim', explode(" - ",$selected_date_range[0])))
            ->groupBy('orders.aso_id','skues.short_name')
            ->get();
        return $data;
    }
    public static function getSecondaryOrderDateSaleByIds($ids,$selected_date_range,$route_id=null)
    {
        $data =DB::table('skues')
            ->select('distribution_houses.id','orders.order_date','orders.aso_id','distribution_houses.point_name','routes.id as route_id','routes.routes_name','skues.short_name','orders.requester_name','skues.short_name',DB::raw('SUM(order_details.quantity) as order_quantity'),DB::raw('SUM(sale_details.quantity) as sale_quantity'))
            ->leftJoin('order_details','order_details.short_name','=','skues.short_name')
            ->leftJoin('orders','orders.id','=','order_details.orders_id')
            ->leftJoin('sales',function($join){
                $join->on('sales.aso_id','=','orders.aso_id')
                    ->on('sales.order_date','=','orders.order_date');
            })
            ->leftJoin('sale_details',function ($join){
                $join->on('sale_details.sales_id','=','sales.id')
                    ->on('sale_details.short_name','=','order_details.short_name');
            })
            ->leftJoin('distribution_houses','distribution_houses.id','=','orders.dbid')
//            ->leftJoin('routes','routes.so_aso_user_id','=','orders.aso_id')
            ->leftjoin('routes',function ($join){
                $join->on('routes.so_aso_user_id','=','orders.aso_id')
                    ->on('routes.id','=','orders.route_id')
                    ->on('routes.id','=','sales.sale_route_id');
            })
            ->where('orders.order_type','Secondary')
            ->where('orders.order_status','Processed');
        if($route_id)
        {
            $data->where('orders.route_id',$route_id);
        }
        $data->whereIn('orders.aso_id',$ids)
            ->whereBetween('orders.order_date',array_map('trim', explode(" - ",$selected_date_range[0])))
            ->groupBy('orders.order_date','orders.aso_id','skues.short_name');

        $result = $data->get();
//            debug($result,1);
        return $result;

    }
    public static function getSecondaryOrderRouteSaleByIds($ids,$selected_date_range,$route_id=null){
        $data =DB::table('skues')
            ->select('distribution_houses.id','orders.order_date','orders.aso_id','distribution_houses.point_name','routes.id as route_id','routes.routes_name','skues.short_name','orders.requester_name','skues.short_name',DB::raw('SUM(order_details.quantity) as order_quantity'),DB::raw('SUM(sale_details.quantity) as sale_quantity'))
            ->leftJoin('order_details','order_details.short_name','=','skues.short_name')
            ->leftJoin('orders','orders.id','=','order_details.orders_id')
            ->leftJoin('sales',function($join){
                $join->on('sales.aso_id','=','orders.aso_id')
                    ->on('sales.order_date','=','orders.order_date');
            })
            ->leftJoin('sale_details',function ($join){
                $join->on('sale_details.sales_id','=','sales.id')
                    ->on('sale_details.short_name','=','order_details.short_name');
            })
            ->leftJoin('distribution_houses','distribution_houses.id','=','orders.dbid')
//            ->leftJoin('routes','routes.so_aso_user_id','=','orders.aso_id')
            ->leftjoin('routes',function ($join){
                $join->on('routes.so_aso_user_id','=','orders.aso_id')
                    ->on('routes.id','=','orders.route_id')
                    ->on('routes.id','=','sales.sale_route_id');
            })
            ->where('orders.order_type','Secondary')
            ->where('orders.order_status','Processed');
        if($route_id)
        {
            $data->where('orders.route_id',$route_id);
        }
        $data->whereIn('orders.aso_id',$ids)
            ->whereBetween('orders.order_date',array_map('trim', explode(" - ",$selected_date_range[0])))
            ->groupBy('orders.route_id','orders.aso_id','skues.short_name');

        $result = $data->get();
//            debug($result,1);
        return $result;
    }

    public static function orderVsSaleSecondaryDate($route_id,$asos,$selected_memo,$selected_date_range){
        $response=[];
        $selected_aso=array_column($asos,'id');

        $data= \App\Models\Reports::getSecondaryOrderDateSaleByIds($selected_aso,$selected_date_range,$route_id);
//            debug($data,1);
        if(!$data->isEmpty()){
            foreach ($data as $value){
//                dd();
                $response[$value->order_date][$value->short_name]['requested'] = $value->order_quantity;
                $response[$value->order_date][$value->short_name]['delivered'] = $value->sale_quantity;
                $response[$value->order_date]['route_id'] = $value->route_id;
            }

        }
//        debug($response,1);
        $response_data=[];
        foreach ($response as $h_key=>$h_value){
            $sku_gen_value=[];
            foreach ($selected_memo as $cat_key=>$cat_val) {

                $selected_skues = array_flatten($cat_val);
                foreach($selected_skues as $key=>$value){
                    $sku_gen_value[]=[
                        $h_value[$value]['requested'],
                        $h_value[$value]['delivered']
                    ];

                }
            }
            $response_data[$h_key]['additional']=[
                'route_id'=> $h_value['route_id']
            ];


            $response_data[$h_key]['data'] = $sku_gen_value;
        }

        return $response_data;

    }

    public static  function gerOrderVsSaleByHouseIds($house_ids,$selected_date_range){

        $data =DB::table('skues')
            ->select('distribution_houses.id as house_id','distribution_houses.current_balance','distribution_houses.point_name','orders.order_date','orders.aso_id','sales.house_current_balance','distribution_houses.point_name','skues.short_name','orders.requester_name','skues.short_name',DB::raw('SUM(order_details.quantity) as order_quantity'),DB::raw('SUM(sale_details.quantity) as sale_quantity'))
            ->leftJoin('order_details','order_details.short_name','=','skues.short_name')
            ->leftJoin('orders','orders.id','=','order_details.orders_id')
            ->leftJoin('sales',function($join){
                $join->on('sales.aso_id','=','orders.aso_id')
                    ->on('sales.order_date','=','orders.order_date');
            })
            ->leftJoin('sale_details',function ($join){
                $join->on('sale_details.sales_id','=','sales.id')
                    ->on('sale_details.short_name','=','order_details.short_name');
            })
            ->join('distribution_houses','distribution_houses.id','=','orders.dbid')
            ->where('orders.order_type','Primary')
            ->where('orders.order_status','Processed');
        if(is_array($house_ids)){
            $data->whereIn('orders.dbid',$house_ids);
        }
        else{
            $data->where('orders.dbid',$house_ids);
        }

        $data->whereBetween('orders.order_date',array_map('trim', explode(" - ",$selected_date_range[0])))
            ->groupBy('skues.short_name');
        if(!is_array($house_ids)){
            $data->groupBy('orders.order_date');
        }
        $data=$data->get();

        return $data;
    }

    public static function order_vs_sale_primary_by_house($house_ids,$selected_memo,$selected_date_range){
        $data =\App\Models\Reports::gerOrderVsSaleByHouseIds($house_ids,$selected_date_range);

        $response =[];
        if(!$data->isEmpty()){
            foreach ($data as $value){
                $response[$value->point_name][$value->short_name]['requested'] = $value->order_quantity;
                $response[$value->point_name][$value->short_name]['delivered'] = $value->sale_quantity;
            }
            $response[$value->point_name]['current_balace'] = $value->current_balance;
            $response[$value->point_name]['house_id'] = $value->house_id;
        }
        $response_data=[];
        foreach ($response as $h_key=>$h_value){
            $sku_gen_value=[];
            foreach ($selected_memo as $cat_key=>$cat_val) {
                $selected_skues = array_flatten($cat_val);
                foreach($selected_skues as $key=>$value){
                    $sku_gen_value[]=[
                        $h_value[$value]['requested'],
                        $h_value[$value]['delivered']
                    ];

                }
            }
            $response_data[$h_key]['additional']=[
                'house_id'=> $h_value['house_id'],
                'current_balance'=>$h_value['current_balace']
            ];


            $response_data[$h_key]['data'] = $sku_gen_value;
        }

        return $response_data;

    }

    public static  function order_vs_sale_primary_by_date($house_ids,$selected_memo,$selected_date_range){
        $data =\App\Models\Reports::gerOrderVsSaleByHouseIds($house_ids,$selected_date_range);

        $response =[];
        if(!$data->isEmpty()){
            foreach ($data as $value){
                $response[$value->order_date][$value->short_name]['requested'] = $value->order_quantity;
                $response[$value->order_date][$value->short_name]['delivered'] = $value->sale_quantity;
                $response[$value->order_date]['house_current_balance'] = $value->house_current_balance;
            }
        }


        $response_data=[];
        foreach ($response as $h_key=>$h_value){
            $sku_gen_value=[];
            foreach ($selected_memo as $cat_key=>$cat_val) {

                $selected_skues = array_flatten($cat_val);
                foreach($selected_skues as $key=>$value){
                    $sku_gen_value[]=[
                        $h_value[$value]['requested'],
                        $h_value[$value]['delivered']
                    ];

                }
            }
            $response_data[$h_key]['additional']=[
                'current_balance'=>$h_value['house_current_balance']
            ];


            $response_data[$h_key]['data'] = $sku_gen_value;
        }

        return $response_data;

    }

    public static function houseWisePerformance($ids,$selected_memo,$month){
        $db_house_wise_performance=[];
        foreach ($ids as $house_key=>$house_value){
            $house = \App\Models\DistributionHouse::where('id',$house_value)->first()->toArray();
            $get_target = \App\Models\Target::where('target_type','house')->where('type_id',$house_value)->where('target_month',isset($month[0]) ? $month[0]: '')->first();
            $sku_target = [];
            foreach ($selected_memo as $cat_key=>$cat_val) {
                $selected_skues = array_flatten($cat_val);
                $target_value = json_decode($get_target['base_value'], true);
                foreach ($selected_skues as $key => $value) {
                    if(!empty($get_target)){
                        $cumulative_sale= \App\Models\Reports::get_sale_by_month_house($house_value,$value,isset($month[0]) ? $month[0]: '');
                        $sku_target[] = [
                            isset($target_value[$value]) ? $target_value[$value] : 0,
                            $cumulative_sale,
                            achievement($target_value[$value],$cumulative_sale)
                        ];
                    }
                    else{
                        $sku_target[] = [
                            0, 0, 0
                        ];
                    }

                }

            }

            $db_house_wise_performance[$house['point_name']]=$sku_target;
        }
        return $db_house_wise_performance;
    }

    public static function routeWisePerformance($ids,$selected_memo,$month){
//        debug($ids,1);
        $route_wise_performance=[];
        foreach ($ids as $route_key=>$route_value){
            $get_target = \App\Models\Target::where('target_type','market')->where('type_id',$route_value['id'])->where('target_month',isset($month[0]) ? $month[0]: '')->first();
            $sku_target = [];
            foreach ($selected_memo as $cat_key=>$cat_val) {
                $selected_skues = array_flatten($cat_val);
                $target_value = json_decode($get_target['base_value'], true);
                foreach ($selected_skues as $key => $value) {
                    if(!empty($get_target)){
                        $cumulative_sale= \App\Models\Reports::get_sale_by_month_route($route_value['id'],$value,isset($month[0]) ? $month[0]: '');
                        $sku_target[] = [
                            isset($target_value[$value]) ? $target_value[$value] : 0,
                            $cumulative_sale,
                            achievement($target_value[$value],$cumulative_sale)
                        ];
                    }
                    else{
                        $sku_target[] = [
                            0, 0, 0
                        ];
                    }

                }

            }

            $route_wise_performance[$route_value['name']]=$sku_target;
        }
        return $route_wise_performance;
    }


    public static function routeWisePerformance2($ids,$selected_memo,$month){
//        debug($ids,1);
        $route_wise_performance=[];
        foreach ($ids as $route_key=>$route_value){
            $route_wise_performance[$route_key]['routes_name'] = $route_value['routes_name'];
            $route_wise_performance[$route_key]['aso_name'] = $route_value['uname'];
            $route_wise_performance[$route_key]['db_house'] = $route_value['point_name'];
            $route_wise_performance[$route_key]['route_id'] = $route_value['id'];

            $get_target = \App\Models\Target::where('target_type','market')->where('type_id',$route_value['uid'])->where('target_month',isset($month[0]) ? $month[0]: '')->first();
//            debug($get_target,1);
            $sku_target = [];
            foreach ($selected_memo as $cat_key=>$cat_val) {
                $selected_skues = array_flatten($cat_val);
                $target_value = json_decode($get_target['base_value'], true);
                foreach ($selected_skues as $key => $value) {
                    if(!empty($get_target)){
                        $cumulative_sale= \App\Models\Reports::get_sale_by_month_route($route_value['uid'],$value,isset($month[0]) ? $month[0]: '');
                        $sku_target[] = [
                            isset($target_value[$value]) ? $target_value[$value] : 0,
                            $cumulative_sale,
                            achievement($target_value[$value],$cumulative_sale)
                        ];
                    }
                    else{
                        $sku_target[] = [
                            0, 0, 0
                        ];
                    }

                }
//                debug($sku_target,1);

            }

//            $route_wise_performance[$route_value['routes_name']]=$sku_target;
            $route_wise_performance[$route_key]['result'] = $sku_target;
        }
//        debug($route_wise_performance,1);
        return $route_wise_performance;
    }


    public static function routeWisePerformance3($ids,$selected_memo,$month){
//        debug($ids,1);
        $route_wise_performance=[];
        foreach ($ids as $route_key=>$route_value){
            $route_wise_performance[$route_key]['routes_name'] = $route_value['routes_name'];
            $route_wise_performance[$route_key]['aso_name'] = $route_value['uname'];
            $route_wise_performance[$route_key]['db_house'] = $route_value['point_name'];
            $route_wise_performance[$route_key]['route_id'] = $route_value['id'];

            $get_target = \App\Models\Target::where('target_type','market')->where('type_id',$route_value['uid'])->where('target_month',isset($month[0]) ? $month[0]: '')->first();
            $sku_target = [];
            foreach ($selected_memo as $cat_key=>$cat_val) {
                $selected_skues = $cat_val;
                $target_value = json_decode($get_target['base_value'], true);
//                debug($selected_skues,1);
                foreach ($selected_skues as $key => $value) {
                    if(!empty($get_target)){
                        $cumulative_sale= \App\Models\Reports::get_sale_by_month_route($route_value['uid'],$value,isset($month[0]) ? $month[0]: '');
                        $sku_target[$key] = [
                            isset($target_value[$key]) ? $target_value[$key] : 0,
                            $cumulative_sale,
                            achievement($target_value[$key],$cumulative_sale)
                        ];
                    }
                    else{
                        $sku_target[$key] = [
                            0, 0, 0
                        ];
                    }

                }
//                debug($sku_target,1);

            }

//            $route_wise_performance[$route_value['routes_name']]=$sku_target;
            $route_wise_performance[$route_key]['result'] = $sku_target;
        }
//        debug($route_wise_performance,1);
        return $route_wise_performance;
    }

    public static function routeWiseStrikeRate($ids,$selected_memo,$date_range){
        $route_wise_strike_rate=[];
        foreach ($ids as $route_key=>$route_value){
            $data = DB::table('order_details')
                ->select('skues.sku_name','order_details.short_name',DB::raw('SUM(orders.total_outlet) as total_outlet'),DB::raw('SUM(orders.visited_outlet) as visited_outlet'),'orders.total_no_of_memo',DB::raw('SUM(order_details.quantity) as order_quantity'),DB::raw('SUM(sale_details.quantity) as  sale_quantity'),DB::raw('SUM(order_details.no_of_memo) as  total_indi_no_of_memo'))
                ->leftJoin('orders','orders.id','=','order_details.orders_id')
                ->leftJoin('sales',function($join){
                    $join->on('sales.aso_id','=','orders.aso_id')
                        ->on('sales.order_date','=','orders.order_date');
                })
                ->leftJoin('sale_details',function ($join){
                    $join->on('sale_details.sales_id','=','sales.id')
                        ->on('sale_details.short_name','=','order_details.short_name');
                })
                ->leftJoin('skues','skues.short_name','=','order_details.short_name')
                ->where('orders.order_type','Secondary')
                ->where('orders.aso_id',$route_value['id'])
                ->whereBetween('orders.order_date',array_map('trim', explode(" - ",$date_range[0])))
                ->groupBy('order_details.short_name')
                ->orderBy('orders.id', 'DESC');
            $data=$data->get()->toArray();
            $sku_gen_value=[];
            $sku_gen_additional=[];
            foreach ($selected_memo as $cat_key=>$cat_val) {
                $selected_skues = array_flatten($cat_val);
                foreach ($selected_skues as $key => $value) {
                    $selected_value=array_search($value,array_column($data,'short_name'));
                    if($selected_value!=false){
                        $sku_gen_value[]=[
                            productivity($data[$selected_value]->total_indi_no_of_memo,$data[$selected_value]->total_no_of_memo),
                            avg_per_memo(array_sum (array_column($data,'total_indi_no_of_memo')),$data[$selected_value]->total_no_of_memo),
                            volume_per_memo($data[$selected_value]->order_quantity,$data[$selected_value]->total_indi_no_of_memo),
                            protfolio_volume($data[$selected_value]->order_quantity,$data[$selected_value]->total_no_of_memo),
                            bounce_call($data[$selected_value]->order_quantity,$data[$selected_value]->sale_quantity)
                        ];
                    }else{
                        $sku_gen_value[]=[0,0,0,0,0,0];
                    }

                }
            }
            $route_wise_strike_rate[$route_value['name']]['data']= $sku_gen_value;
            if(count($data) > 0){
                $route_wise_strike_rate[$route_value['name']]['additional']=[
                    $data[count($data)-1]->total_outlet,
                    $data[count($data)-1]->visited_outlet,
                    visited_outlet_per($data[count($data)-1]->visited_outlet,$data[$selected_value]->total_outlet),
                    $data[count($data)-1]->total_no_of_memo,
                    call_productivity($data[count($data)-1]->total_no_of_memo,$data[$selected_value]->visited_outlet)
                ];
            }
            else{
                $route_wise_strike_rate[$route_value['name']]['additionaladditional']=[
                    0,0,0,0,0
                ];
            }


        }

        return $route_wise_strike_rate;

    }
}
