<?php

if(!function_exists('count_sku')){
    function count_sku(array $skues){
        $count=0;
        foreach ($skues as $sku_val){
            if(!is_null($sku_val)){
                $count+=(int)$sku_val;
            }
        }
        return $count;
    }
}

if(!function_exists('achievement')){
    function achievement($target,$sale){
        return $target > 0 ? number_format(((int)$sale/ $target) * 100,2,'.','')  : 0;
    }
}





if(!function_exists('visited_outlet_per')){
    function visited_outlet_per($visited_outlet,$total_outlet){
        return ($visited_outlet/$total_outlet)*100;
    }
}

if(!function_exists('call_productivity')){
    function call_productivity($successful_memo,$visited_outlet){
        return ($successful_memo/$visited_outlet) * 100;
    }
}

if(!function_exists('productivity')){
    function productivity($indi_sku_memo,$successfull_memo){
        return number_format(($indi_sku_memo/$successfull_memo)*100,2,'.','');
    }
}

if(!function_exists('avg_per_memo')){
    function avg_per_memo($total_indi_memo,$successfull_memo){
        return number_format(($total_indi_memo/$successfull_memo)*100,2,'.','');
    }
}
if(!function_exists('volume_per_memo')){
    function volume_per_memo($sku_quantity,$sku_memo_quantity){
        if($sku_memo_quantity > 0){
            return number_format($sku_quantity/$sku_memo_quantity,2,'.','');
        }
        else{
            return 0;
        }
    }
}

if(!function_exists('protfolio_volume')){
    function protfolio_volume($order_quantity,$total_no_succ_memo){
        return number_format( $order_quantity/$total_no_succ_memo,2,'.','');
    }
}

if(!function_exists('bounce_call')){
    function bounce_call($total_order_qty,$total_sal_qty){
        if($total_sal_qty > 0){
            return number_format( (($total_order_qty-$total_sal_qty)/$total_order_qty)*100,2,'.','');
        }else{
            return 0;
        }
    }
}


if(!function_exists('monthly_sale_recon_by_house')){
    function monthly_sale_recon_by_house($ids,$selected_memo,$month){


    }
}

function get_order_sale($route_id,$date_range){
    $data = DB::table('order_details')
        ->select('orders.order_date as order_date','skues.sku_name','order_details.short_name','orders.total_outlet','order_details.quantity as order_quantity','sale_details.quantity as  sale_quantity')
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
        ->where('orders.aso_id',$route_id)
        ->whereBetween('orders.order_date',array_map('trim', explode(" - ",$date_range[0])))
        ->orderBy('orders.id', 'DESC');
    return $data->get()->toArray();
}
if(!function_exists('dailySaleSummaryByMonth')){
    function dailySaleSummaryByMonth($ids,$selected_memo,$month,$selected_date_range){
        $route_wise_sale_summary=[];
        foreach ($ids as $route_key=>$route_value){
            $get_target = \App\Models\Target::where('target_type','market')->where('type_id',$route_value['id'])->where('target_month',isset($month[0]) ? $month[0]: '')->first();
            $order_sale_data=get_order_sale($route_value['id'],$selected_date_range);
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

            $route_wise_sale_summary[$route_value['name']]=$sku_target;
        }
        return $route_wise_sale_summary;
    }
}

if(!function_exists('orderVsSaleSecondary')){
    function orderVsSaleSecondary($asos,$selected_memo,$selected_date_range){
            $response=[];
            $selected_aso=array_column($asos,'id');
            $data= \App\Models\Reports::getSecondaryOrderSaleByIds($selected_aso,$selected_date_range);
//            debug($data,1);
            if(!$data->isEmpty()){
                   foreach ($data as $value){
                       $response[$value->point_name][$value->short_name]['requested'] = $value->order_quantity;
                       $response[$value->point_name][$value->short_name]['delivered'] = $value->sale_quantity;
                       $response[$value->point_name]['house_id'] = $value->id;
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
                         'house_id'=> $response[$h_key]['house_id']
                     ];


                   $response_data[$h_key]['data'] = $sku_gen_value;
             }
           return $response_data;


    }
}

if(!function_exists('orderVsSaleSecondaryAso')){
    function orderVsSaleSecondaryAso($asos,$selected_memo,$selected_date_range){
        $response=[];
        $selected_aso=array_column($asos,'id');
//        $data= getSecondaryOrderSaleByIds($selected_aso,$selected_date_range);
        $data= \App\Models\Reports::getSecondaryOrderAsoSaleByIds($selected_aso,$selected_date_range);
//            debug($data,1);
        if(!$data->isEmpty()){
            foreach ($data as $value){
                $response[$value->requester_name][$value->short_name]['requested'] = $value->order_quantity;
                $response[$value->requester_name][$value->short_name]['delivered'] = $value->sale_quantity;
                $response[$value->requester_name]['aso_id'] = $value->aso_id;
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
                'aso_id'=> $h_value['aso_id']
            ];


            $response_data[$h_key]['data'] = $sku_gen_value;
        }

        return $response_data;


    }
}



if(!function_exists('orderVsSaleSecondaryRoute')){
    function orderVsSaleSecondaryRoute($asos,$selected_memo,$selected_date_range){
        $response=[];
        $selected_aso=array_column($asos,'id');
//        $data= getSecondaryOrderSaleByIds($selected_aso,$selected_date_range);
//        $data= getSecondaryOrderAsoSaleByIds($selected_aso,$selected_date_range);
        $data= \App\Models\Reports::getSecondaryOrderRouteSaleByIds($selected_aso,$selected_date_range);
//            debug($data,1);
        if(!$data->isEmpty()){
            foreach ($data as $value){
//                dd();
                $response[$value->routes_name][$value->short_name]['requested'] = $value->order_quantity;
                $response[$value->routes_name][$value->short_name]['delivered'] = $value->sale_quantity;
                $response[$value->routes_name]['route_id'] = $value->route_id;
                $response[$value->routes_name]['aso_id'] = $value->aso_id;
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
                'route_id'=> $h_value['route_id'],
                'aso_id'=> $h_value['aso_id']
            ];


            $response_data[$h_key]['data'] = $sku_gen_value;
        }

        return $response_data;


    }
}


