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
        $data = \App\Models\User::where('user_type','area')->whereIn('distribution_house_id',$house_ids)->get()->toArray();
        return $data;
    }
}

if(!function_exists('getRouteInfoByAso')){
    function getRouteInfoByAso($route_ids){
        $data = \App\Models\User::where('user_type','area')->whereIn('id',$route_ids)->get()->toArray();
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
            $get_target = \App\Models\Target::where('target_type','area')->where('type_id',$route_value['id'])->where('target_month',isset($month[0]) ? $month[0]: '')->first();
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



