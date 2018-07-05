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
    function getHouseStockInfo($id){
        $result= \App\Models\Stocks::where('distributions_house_id',$id)->get()->toArray();
        $res=[];
        foreach ($result as $val){
            $res[$val['short_name']]= $val['quantity'];
        }
        return $res;
    }
}