<?php
if(!function_exists('getInfo')){
    function getInfo($zone_ids=[],$region_ids=[],$territory_ids=[],$house_ids=[],$category_ids=[],$brand_ids=[],$sku_ids=[]){
        $query=\App\Models\User::query();
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
}



if(!function_exists('getHouseStockInfo')){
    function getHouseStockInfo($ids,$selected_memo){
        $house_stock_list=[];
        foreach ($ids as $house_key=>$house_value){
            $house=\App\Models\DistributionHouse::where('id',$house_value)->first()->toArray();
            $sku_quantity=[];
            foreach ($selected_memo as $cat_key=>$cat_val){
               $selected_skue=array_values($cat_val);
               $selected_skues=array_flatten($selected_skue);
               foreach ($selected_skues as $key => $value){
                  $data=\App\Models\Stocks::where('distributions_house_id',$house_value)->where('short_name',$value)->first()->toArray();
                  if(!empty($data)){
                      $sku_quantity[] = $data['quantity'];
                  }

               }
            }

            $house_stock_list[$house['market_name']]=$sku_quantity;

        }
        return $house_stock_list;

    }
}

if(!function_exists('getRouteInfoByHouse')){
    function getRouteInfoByHouse($house_ids){
        $data = \App\Models\User::where('user_type','market')->whereIn('distribution_house_id',$house_ids)->get()->toArray();
        return $data;
    }
}

if(!function_exists('getRouteInfoByAso')){
    function getRouteInfoByAso($route_ids){
        $data = \App\Models\User::where('user_type','market')->whereIn('id',$route_ids)->get()->toArray();
        return $data;
    }
}

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

if(!function_exists('getHouseLifting')){
    function getHouseLifting($ids,$selected_memo){
        $house_lifting_list=[];
        foreach ($ids as $house_key=>$house_value){
            $house = \App\Models\DistributionHouse::where('id',$house_value)->first()->toArray();
            $sku_order_info=[];
            foreach ($selected_memo as $cat_key=>$cat_val){
                $selected_skues=array_flatten($cat_val);
                foreach ($selected_skues as $key => $value){
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
                            ->where('orders.asm_rsm_id',$house['territories_id'])
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
                        }else{
                            $sku_order_info[]=[
                                 'N/R','N/P'
                            ];
                        }

                }
            }

            $house_lifting_list[$house['market_name']]=$sku_order_info;
        }
        return $house_lifting_list;
    }
}

if(!function_exists('achievement')){
    function achievement($target,$sale){
        return $target > 0 ? number_format(((int)$sale/ $target) * 100,2,'.','')  : 0;
    }
}

if(!function_exists('get_sale_by_month_house')){
      function get_sale_by_month_house($db_id,$sku_name,$month){
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
}

if(!function_exists('get_sale_by_month_route')){
    function get_sale_by_month_route($aso_id,$sku_name,$month){
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
}

if(!function_exists('houseWisePerformance')){
    function houseWisePerformance($ids,$selected_memo,$month){
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
                            $cumulative_sale= get_sale_by_month_house($house_value,$value,isset($month[0]) ? $month[0]: '');
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

            $db_house_wise_performance[$house['market_name']]=$sku_target;
        }
        return $db_house_wise_performance;
    }
}

if(!function_exists('routeWisePerformance')){
    function routeWisePerformance($ids,$selected_memo,$month){
        $route_wise_performance=[];
        foreach ($ids as $route_key=>$route_value){
            $get_target = \App\Models\Target::where('target_type','market')->where('type_id',$route_value['id'])->where('target_month',isset($month[0]) ? $month[0]: '')->first();
            $sku_target = [];
            foreach ($selected_memo as $cat_key=>$cat_val) {
                $selected_skues = array_flatten($cat_val);
                $target_value = json_decode($get_target['base_value'], true);
                foreach ($selected_skues as $key => $value) {
                    if(!empty($get_target)){
                        $cumulative_sale= get_sale_by_month_route($route_value['id'],$value,isset($month[0]) ? $month[0]: '');
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
}

if(!function_exists('routeWiseStrikeRate')){
    function routeWiseStrikeRate($ids,$selected_memo,$date_range){
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
                        $cumulative_sale= get_sale_by_month_route($route_value['id'],$value,isset($month[0]) ? $month[0]: '');
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
if(!function_exists('getSecondaryOrderSaleByIds')){
    function getSecondaryOrderSaleByIds($ids){
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
            ->where('orders.order_status','Processed')
            ->whereIn('orders.aso_id',$ids)
            ->groupBy('skues.short_name')
            ->groupBy('distribution_houses.point_name')
            ->get();
        return $data;
    }
}
if(!function_exists('orderVsSaleSecondary')){
    function orderVsSaleSecondary($asos,$selected_memo,$selected_date_range){
            $response=[];
            $selected_aso=array_column($asos,'id');
            $data= getSecondaryOrderSaleByIds($selected_aso,$selected_date_range);
//            debug($data,1);
            if(!$data->isEmpty()){
                   foreach ($data as $value){
                       $response[$value->point_name][$value->short_name]['requested'] = $value->order_quantity;
                       $response[$value->point_name][$value->short_name]['delivered'] = $value->sale_quantity;
                   }
                $response[$value->point_name]['house_id'] = $value->id;
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
                         'house_id'=> $h_value['house_id']
                     ];


                   $response_data[$h_key]['data'] = $sku_gen_value;
             }

           return $response_data;


    }
}


if(!function_exists('getSecondaryOrderAsoSaleByIds')){
    function getSecondaryOrderAsoSaleByIds($ids){
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
            ->groupBy('skues.short_name')
            ->get();
        return $data;
    }
}

if(!function_exists('orderVsSaleSecondaryAso')){
    function orderVsSaleSecondaryAso($asos,$selected_memo,$selected_date_range){
        $response=[];
        $selected_aso=array_column($asos,'id');
//        $data= getSecondaryOrderSaleByIds($selected_aso,$selected_date_range);
        $data= getSecondaryOrderAsoSaleByIds($selected_aso,$selected_date_range);
//            debug($data,1);
        if(!$data->isEmpty()){
            foreach ($data as $value){
                $response[$value->requester_name][$value->short_name]['requested'] = $value->order_quantity;
                $response[$value->requester_name][$value->short_name]['delivered'] = $value->sale_quantity;
            }
            $response[$value->requester_name]['aso_id'] = $value->aso_id;
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
        $data= getSecondaryOrderRouteSaleByIds($selected_aso,$selected_date_range);
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



if(!function_exists('getSecondaryOrderRouteSaleByIds')){
    function getSecondaryOrderRouteSaleByIds($ids,$selected_date_range,$route_id=null){
//        debug($ids,1);
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
            ->join('routes',function ($join){
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
            ->groupBy('skues.short_name')
            ->groupBy('routes.routes_name');
            $result = $data->get();
//            debug($result,1);
        return $result;
    }


    if(!function_exists('orderVsSaleSecondaryDate')){
        function orderVsSaleSecondaryDate($route_id,$asos,$selected_memo,$selected_date_range){
            $response=[];
            $selected_aso=array_column($asos,'id');

            $data= getSecondaryOrderRouteSaleByIds($selected_aso,$selected_date_range,$route_id);
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
    }
}



