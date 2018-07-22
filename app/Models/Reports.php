<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    //constructor

    public static function getHouseStockInfo($ids,$selected_memo){
        $house_stock_list=[];
        foreach ($ids as $house_key=>$house_value){
            $house=DistributionHouse::where('id',$house_value)->first()->toArray();
            $sku_quantity=[];
            foreach ($selected_memo as $cat_key=>$cat_val){
                $selected_skue=array_values($cat_val);
                $selected_skues=array_flatten($selected_skue);
                foreach ($selected_skues as $key => $value){
                    $data=Stocks::where('distributions_house_id',$house_value)->where('short_name',$value)->first()->toArray();
                    if(!empty($data)){
                        $sku_quantity[] = $data['quantity'];
                    }

                }
            }

            $house_stock_list[$house['market_name']]['data']=$sku_quantity;
            $house_stock_list[$house['market_name']]['current_balance']=$house['current_balance'];

        }
        return $house_stock_list;
    }

    public static function getRouteInfoByHouse($house_ids){
        $data = User::where('user_type','market')->whereIn('distribution_house_id',$house_ids)->get()->toArray();
        return $data;
    }
    public static function getRouteInfoByAso($route_ids){
        $data = User::where('user_type','market')->whereIn('id',$route_ids)->get()->toArray();
        return $data;
    }

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
}
