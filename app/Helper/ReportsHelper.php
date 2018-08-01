<?php

namespace App\Helper;
use App\Models\Routes;
use DB;
use Auth;

class ReportsHelper
{
    public function __construct()
    {
        DB::enableQueryLog();
    }

    public static function order_list_query($type=null,$post,$routes=[])
    {
        $houses = Routes::whereIn('id',$routes)->groupBy('distribution_houses_id')->get(['distribution_houses_id'])->toArray();
        $selected_house = array_column($houses,'distribution_houses_id');
//        dd($selected_house);
        if($post)
        {
            $searchValue = getSearchDataAll($post);
            $dateselect = explode(' - ', $post['created_at']);
        }
        $query = DB::table('orders');
        $query->select('orders.*','distribution_houses.current_balance as dhcb','distribution_houses.opening_balance','distribution_houses.point_name');
        $query->leftJoin('distribution_houses','distribution_houses.id','=','orders.dbid');
        if($type)
        {
            $query->where('order_type',ucfirst($type))->whereIn('orders.dbid',$selected_house);
        }

        if($post)
        {
            $query->whereIn('orders.dbid',$searchValue['house_id']);
//            $query->whereIn('orders_details.short_name',$searchValue);
            if($post['created_at'])
            {
                $query->where('orders.order_date','>=',date('Y-m-d',strtotime(str_replace('/','-',$dateselect[0]))));
                $query->where('orders.order_date','<=',date('Y-m-d',strtotime(str_replace('/','-',$dateselect[1]))));
            }
        }

        $result = $query->whereNotIn('order_status',['Rejected'])->get();
//        dd(DB::getQueryLog());
        return $result;
    }


    public static function sales_list_query($type=null,$post)
    {
        if($post)
        {
            $searchValue = getSearchDataAll($post);
            $dateselect = explode(' - ', $post['created_at']);
        }
        $query = DB::table('sales');
        $query->select('sales.*');
        $query->addSelect('distribution_houses.point_name','distribution_houses.current_balance');
        if($type != 'promotional')
        {
            $query->addSelect('orders.total_outlet','orders.visited_outlet','orders.total_no_of_memo','orders.order_total_sku','orders.order_amount');
            $query->leftJoin('orders','orders.id','=','sales.order_id');
        }
        $query->leftJoin('distribution_houses','distribution_houses.id','=','sales.dbid');

        if(($type == 'primary') || ($type == 'secondary'))
        {
            $query->where('order_type',ucfirst($type));
        }
        else if($type == 'promotional')
        {
            $query->where('sale_type',ucfirst($type));
        }

        if($post)
        {
            $query->whereIn('sales.dbid',$searchValue['house_id']);
//            $query->whereIn('orders_details.short_name',$searchValue);
            if($post['created_at'])
            {
                $query->where('sales.order_date','>=',date('Y-m-d',strtotime(str_replace('/','-',$dateselect[0]))));
                $query->where('sales.order_date','<=',date('Y-m-d',strtotime(str_replace('/','-',$dateselect[1]))));
            }
        }

        $result = $query->whereNotIn('sale_status',['Rejected'])->get();
//        debug($result,1);
        return $result;
    }

    public static function getDistributorCurrentBalance($post)
    {
        $result = DB::table('order_details')->select('short_name','price')->whereIn('short_name',$post['short_name'])->where('orders_id',$post['order_id'])->get();
        $total = 0;
        foreach($result as $k=>$value)
        {
            $total = $total+($post['quantity'][$value->short_name]*$value->price);
        }
        return $total;
    }
}
