<?php

namespace App\Http\Controllers;

use App\Models\Order;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['brands'] = DB::table('brands')->where('is_active', 1)->get();
        return view('home', $data);
    }

    public function dashboardTargetOutlet() {
        $query = Order::selectRaw('sum(total_outlet) as total')->where('order_status', 'Processed')->first();
        if (isset($query->total)) {
            return $query->total;
        } else {
            return 0;
        }
    }

    public function dashboardVisitedOutlet() {
        $query = Order::selectRaw('sum(visited_outlet) as total')->where('order_status', 'Processed')->first();
        if (isset($query->total)) {
            return $query->total;
        } else {
            return 0;
        }
    }

    public function dashboardSuccessfullCall() {
        $query = Order::selectRaw('sum(total_no_of_memo) as total')->where('order_status', 'Processed')->first();
        if (isset($query->total)) {
            return $query->total;
        } else {
            return 0;
        }
    }

    public function dashboardNoLifter() {
        $query = DB::select('SELECT count(distribution_houses.id) as house, (SELECT
                Count(distribution_houses.id)
                FROM
                distribution_houses
                WHERE distribution_houses.id IN(SELECT orders.dbid FROM orders GROUP BY orders.dbid)) as lifting
                FROM distribution_houses');
        if (isset($query[0]->house) && isset($query[0]->lifting)) {
            return (($query[0]->house) - ($query[0]->lifting));
        } else {
            return 0;
        }
    }

    public function dashboardNoOrders() {
        $query = DB::select('SELECT count(distribution_houses.id) as house, (SELECT
                Count(distribution_houses.id)
                FROM
                distribution_houses
                WHERE distribution_houses.id IN(SELECT orders.dbid FROM orders GROUP BY orders.dbid)) as lifting
                FROM distribution_houses');
        if (isset($query[0]->house) && isset($query[0]->lifting)) {
            return (($query[0]->house) - ($query[0]->lifting));
        } else {
            return 0;
        }
    }

    public function dashboardNoSales() {
        $query = DB::select('SELECT count(distribution_houses.id) as house, (SELECT
                Count(distribution_houses.id)
                FROM
                distribution_houses
                WHERE distribution_houses.id IN(SELECT orders.dbid FROM orders GROUP BY orders.dbid)) as lifting
                FROM distribution_houses');
        if (isset($query[0]->house) && isset($query[0]->lifting)) {
            return (($query[0]->house) - ($query[0]->lifting));
        } else {
            return 0;
        }
    }

    public function dashboardStrikeRate() {
        return '000%';
    }

    public function brandWiseProductivity(Request $request) {
        $post = $request->all();
        $totalMemo = DB::table('orders')
            ->select(DB::raw('Sum(total_no_of_memo) AS ttmemo'))
            ->where('orders.order_type', 'Secondary')
            ->where('orders.order_status', 'Processed')->first();

        $query = DB::table('brands')
            ->select('brands.brand_name', DB::raw('Sum(order_details.no_of_memo) AS individual_mamo'))
            ->leftJoin('skues', 'skues.brands_id', '=', 'brands.id')
            ->leftJoin('order_details', 'skues.short_name', '=', 'order_details.short_name')
            ->leftJoin('orders', 'order_details.orders_id', '=', 'orders.id')
            ->where('brands.id', $post['brand_id'])
            ->where('orders.order_type', 'Secondary')
            ->where('orders.order_status', 'Processed')->first();
//        debug($query,1);

        $html = '<span class="brand_name">' . $post['brand_name'] . '</span>
                  <span class="brand_cal">';
        if ((int) $query->individual_mamo === 0) {
            $html .= 0;
        } else {
            $html .= number_format(($totalMemo->ttmemo / $query->individual_mamo), 2);
        }

        $html .= '</span>
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
