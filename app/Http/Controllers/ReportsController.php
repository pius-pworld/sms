<?php

namespace App\Http\Controllers;

//use App\Models\Ordering;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\URL;
//use Carbon\Carbon;

//use URL;

class ReportsController extends Controller
{
    public function __construct()
    {
        DB::enableQueryLog();
    }

    public function order_list()
    {
        $data['ajaxUrl'] = URL::to('orderListAjax');

        $data['orders'] = DB::table('orders')->get();

        $data['aso_name'] = DB::table('orders')
            ->select('requester_name')
            ->groupBy('requester_name')->get();

        $data['houses'] = DB::table('orders')
            ->select('dh_name')
            ->groupBy('dh_name')->get();

        $data['routes'] = DB::table('orders')
            ->select('route_name')
            ->groupBy('route_name')->get();
        //debug($data['ajaxUrl'],1);

        return view('reports.order_list',$data);
    }

    public function order_list_ajax(Request $request)
    {
        $post = $request->all();
        //debug($post,1);
        $dateselect = explode(' - ', $post['created_at']);
        //$date = Carbon::parse('25/06/2018');
        //debug($date->format('d-m-Y'),1);
        //debug(date('Y-m-d',mktime(strtotime($dateselect[0]))),1);
        $query = DB::table('orders');
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
            $query->where('created_at','>=',date('Y-m-d',mktime(strtotime($dateselect[0]))));
            $query->where('created_at','<=',date('Y-m-d',mktime(strtotime($dateselect[1]))));
        }
        //debug($query,1);
        $data['orders'] = $query->get();
        //debug(DB::getQueryLog(),1);
        return view('reports.order_list_ajax',$data);
    }
}
