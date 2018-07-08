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

if(!function_exists('getHouseLifting')){
    function getHouseLifting($ids,$selected_memo){
        $house_lifting_list=[];
        foreach ($ids as $house_key=>$house_value){
            $house = \App\Models\DistributionHouse::where('id',$house_value)->first()->toArray();
            $sku_order_info=[];
            foreach ($selected_memo as $cat_key=>$cat_val){
                $selected_skue=array_values($cat_val);
                $selected_skues=array_flatten($selected_skue);
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
                            $dt= $data->first();
                            $sku_order_info[]=[
                                $dt->oquantity,
                                is_null($dt->salequantity) ? 'N/P': $dt->salequantity
                            ];
                        }

                }
            }

            $house_lifting_list[$house['market_name']]=$sku_order_info;
        }
        return $house_lifting_list;
    }
}



