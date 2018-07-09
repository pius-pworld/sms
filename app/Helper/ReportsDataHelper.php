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
        return $target* $sale;
    }
}

if(!function_exists('houseWisePerformance')){
    function houseWisePerformance($ids,$selected_memo){
        $db_house_wise_performance=[];
        foreach ($ids as $house_key=>$house_value){
           $house = \App\Models\DistributionHouse::where('id',$house_value)->first()->toArray();
            $get_target = \App\Models\Target::where('target_type','house')->where('type_id',$house_value);
            if($get_target->exists()){
                $get_target= $get_target->first()->toArray();
                $target_value=json_decode($get_target['base_value'],true);
                foreach ($selected_memo as $cat_key=>$cat_val){
                    $selected_skues=array_flatten($cat_val);
                    $sku_target= [];
                    foreach ($selected_skues as $key => $value){
                        $sku_target[]=isset($target_value[$value]) ? $target_value[$value] : 0;
                        $sku_target[]=2;
                        $sku_target[]=achievement($target_value[$value],2);
                    }

                }
            }else{
                $sku_target=[
                    0,0,0
                ];
            }
            $db_house_wise_performance[$house['market_name']]=$sku_target;
        }
        return $db_house_wise_performance;
    }
}



