<?php

namespace App\Helper;
use DB;
use Auth;

class ReportsHelper
{
    public function __construct()
    {
        DB::enableQueryLog();
    }

    public static function order_list_query($type=null,$post)
    {
        if($post)
        {
            $searchValue = getSearchDataAll($post);
//            $dateselect = explode(' - ', $post['created_at']);
        }
        $query = DB::table('orders');
        $query->select('orders.*','distribution_houses.opening_balance');
        $query->leftJoin('distribution_houses','distribution_houses.id','=','orders.dbid');
        if($type)
        {
            $query->where('order_type',ucfirst($type));
        }

        if($post)
        {
            $query->whereIn('orders.dbid',$searchValue['house_id']);
//            $query->whereIn('orders_details.short_name',$searchValue);
//            if($post['created_at'])
//            {
//                $query->where('orders.created_at','>=',date('Y-m-d',strtotime(str_replace('/','-',$dateselect[0]))));
//                $query->where('orders.created_at','<=',date('Y-m-d',strtotime(str_replace('/','-',$dateselect[1]))));
//            }
        }

        $result = $query->get();
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
