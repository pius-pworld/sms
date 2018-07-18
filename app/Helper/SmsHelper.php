<?php
define("REPLACE_TIME",48);
if(!function_exists('getPreviousSale')){
    function getPreviousSale($aso_id,$order_date,$order_type='Secondary'){
        $data=\App\Models\Sale::where('aso_id',$aso_id)
            ->where('order_date',$order_date)
            ->where('sale_type',$order_type)
            ->where('created_at','>',\Carbon\Carbon::now()->subHours(REPLACE_TIME)->toDateTimeString())
            ->where('sale_status','Processed')
            ->get();
        return $data;
    }
}

if(!function_exists('getPreviousOrder')){
    function getPreviousOrder($aso_id,$order_date){
        $data=\App\Models\Order::where('aso_id',$aso_id)
            ->where('order_date',$order_date)
            ->where('order_type','Secondary')
            ->where('created_at','>',Carbon::now()->subHours(REPLACE_TIME)->toDateTimeString())
            ->where('order_status','Processed')
            ->get();
        return $data;
    }
}

if(!function_exists('rejectPreviousOrder')){
    function rejectPreviousOrder($aso_id,$order_date){
        $order=\App\Models\Order::where('aso_id',$aso_id)
            ->where('order_date',$order_date)
            ->where('order_type','Secondary')
            ->where('created_at','>',Carbon::now()->subHours(REPLACE_TIME)->toDateTimeString())
            ->update(['order_status'=>'Rejected']);
        return $order;
    }
}

function getPreviousStockByAsoDate($aso_id,$order_date){
    $data =DB::table('sales')
         ->select('sale_details.short_name','sale_details.quantity')
        ->leftJoin('sale_details','sale_details.sales_id','=','sales.id')
        ->where('sales.aso_id',$aso_id)
        ->where('sales.order_date',$order_date)
        ->where('sales.sale_status','Processed')
        ->get();
    $response = [];
    foreach ($data as $value){
        $response[$value->short_name] = $value->quantity;
    }
    return  $response;
}

if(!function_exists('rejectPreviousSale')){
    function rejectPreviousSale($aso_id,$order_date,&$sale_information,$sale_type='Secondary'){
        $sale_information['previous_data'] = getPreviousStockByAsoDate($aso_id,$order_date);
        $sale=\App\Models\Sale::where('aso_id',$aso_id)
            ->where('order_date',$order_date)
            ->where('sale_type',$sale_type)
            ->where('created_at','>',\Carbon\Carbon::now()->subHours(REPLACE_TIME)->toDateTimeString())
            ->update(['sale_status'=>'Rejected']);
        $sale_information['update']=true;
        return $sale_information;
    }
}

if(!function_exists('modify_stock')){
    function modify_stock($aso_id,$sku_informations,$previous_value=[]){
        $distribution_house_info = DB::table('users')
            ->select('users.distribution_house_id')
            ->where('users.id',$aso_id)
            ->first();
        $updated_data=[];
        if(count($previous_value) > 0){
            $total = 0;
            foreach ($sku_informations as $val){
                $unit=\App\Models\Skue::where('short_name',$val['short_name'])->first(['price']);
                if(!empty($unit)){
                    $unit = $unit->toArray();
                    $total+= $unit['price'] * $val['quantity'];
                    $updated_data[$val['short_name']] = $val['quantity'];
                }
            }
            stock_update($distribution_house_info->distribution_house_id,$updated_data,$previous_value,$total);
        }
        else{
            $total = 0;
            foreach ($sku_informations as $val){
                $unit=\App\Models\Skue::where('short_name',$val['short_name'])->first(['price']);
                if(!empty($unit)){
                    $unit = $unit->toArray();
                    $total+= $unit['price'] * $val['quantity'];
                    $updated_data[$val['short_name']] = $val['quantity'];
                }
            }
            stock_update($distribution_house_info->distribution_house_id,$updated_data,[],$total);
        }
    }
}

if(!function_exists('get_route_info')){
    function get_route_info($id){
        $data=DB::table('routes')
            ->select('routes.routes_name')
            ->where('routes.id',$id)
            ->first();
       return $data;
    }
}