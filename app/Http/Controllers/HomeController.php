<?php

namespace App\Http\Controllers;

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
        return 1200;
    }

    public function dashboardVisitedOutlet()
    {
        return 1000;
    }

    public function dashboardSuccessfullCall()
    {
        return 350;
    }

    public function dashboardNoLifter()
    {
        return 300;
    }

    public function dashboardNoOrders()
    {
        return 650;
    }

    public function dashboardNoSales()
    {
        return 532;
    }

    public function dashboardStrikeRate()
    {
        return '532%';
    }

    public function brandWiseProductivity(Request $request)
    {
        $post = $request->all();
        $html = '<span class="brand_name">'.$post['brand_name'].'</span>
                  <span class="brand_cal">80.04</span>
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
