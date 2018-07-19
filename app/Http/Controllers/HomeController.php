<?php

namespace App\Http\Controllers;

use App\Models\DistributionHouse;
use App\Models\Order;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['brands']=DB::table('brands')->where('is_active',1)->get();
        return view('home',$data);
    }

    public function dashboardTargetOutlet()
    {
        $query = Order::selectRaw('sum(total_outlet) as total')->where('order_status','Processed')->first();
        return $query->total;
    }

    public function dashboardVisitedOutlet()
    {
        $query = Order::selectRaw('sum(visited_outlet) as total')->where('order_status','Processed')->first();
        return $query->total;
    }

    public function dashboardSuccessfullCall()
    {
        $query = Order::selectRaw('sum(total_no_of_memo) as total')->where('order_status','Processed')->first();
        return $query->total;
    }

    public function dashboardNoLifter()
    {
        $query = DB::select('SELECT count(distribution_houses.id) as house, (SELECT
                Count(distribution_houses.id)
                FROM
                distribution_houses 
                WHERE distribution_houses.id IN(SELECT orders.dbid FROM orders GROUP BY orders.dbid)) as lifting
                FROM distribution_houses');
        return (($query[0]->house)-($query[0]->lifting));
    }

    public function dashboardNoOrders()
    {
        $query = DB::select('SELECT count(distribution_houses.id) as house, (SELECT
                Count(distribution_houses.id)
                FROM
                distribution_houses 
                WHERE distribution_houses.id IN(SELECT orders.dbid FROM orders GROUP BY orders.dbid)) as lifting
                FROM distribution_houses');
        return (($query[0]->house)-($query[0]->lifting));
    }

    public function dashboardNoSales()
    {
        $query = DB::select('SELECT count(distribution_houses.id) as house, (SELECT
                Count(distribution_houses.id)
                FROM
                distribution_houses 
                WHERE distribution_houses.id IN(SELECT orders.dbid FROM orders GROUP BY orders.dbid)) as lifting
                FROM distribution_houses');
        return (($query[0]->house)-($query[0]->lifting));
    }

    public function dashboardStrikeRate()
    {
        return '532%';
    }

    public function brandWiseProductivity(Request $request)
    {
        $post = $request->all();
        $totalMemo = DB::table('orders')
            ->select(DB::raw('Sum(total_no_of_memo) AS ttmemo'))
            ->where('orders.order_type','Secondary')
            ->where('orders.order_status','Processed')->first();


        $query = DB::table('brands')
            ->select('brands.brand_name',DB::raw('Sum(order_details.no_of_memo) AS individual_mamo'))
            ->leftJoin('skues','skues.brands_id','=','brands.id')
            ->leftJoin('order_details','skues.short_name','=','order_details.short_name')
            ->leftJoin('orders','order_details.orders_id','=','orders.id')
            ->where('brands.id',$post['brand_id'])
            ->where('orders.order_type','Secondary')
            ->where('orders.order_status','Processed')->first();
//        debug($query,1);

        $html = '<span class="brand_name">'.$post['brand_name'].'</span>
                  <span class="brand_cal">'.number_format(($totalMemo->ttmemo/$query->individual_mamo),2).'</span>
                  <span class="brand_prev">
                    <span class="arrow_sign">
                      <i class="fa fa-sort-down"></i>
                      &nbsp;-71.79
    </span>
                    <span class="sdlw">(SDLW)</span>
                  </span>';
        return $html;
    }
}
