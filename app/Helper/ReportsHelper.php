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
            $dateselect = explode(' - ', $post['created_at']);
        }
//        debug($dateselect,1);
        $query = DB::table('orders');
        $query->select('orders.*','distribution_houses.opening_balance');
        $query->leftJoin('distribution_houses','distribution_houses.id','=','orders.dbid');
        if($type)
        {
            $query->where('order_type',ucfirst($type));
        }

        if($post)
        {
            if($post['requester_name'])
            {
                $query->where('requester_name',$post['requester_name']);
            }
            if($post['dh_name'])
            {
                $query->where('dh_name',$post['requester_name']);
            }
            if($post['route_name'])
            {
                $query->where('route_name',$post['route_name']);
            }
            if($post['created_at'])
            {
                $query->where('created_at','>=',date('Y-m-d',strtotime(str_replace('/','-',$dateselect[0]))));
                $query->where('created_at','<=',date('Y-m-d',strtotime(str_replace('/','-',$dateselect[1]))));
            }
        }

        $result = $query->get();
//        debug($result,1);
        return $result;
    }
}
