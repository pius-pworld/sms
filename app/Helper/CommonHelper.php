<?php
function debug($dt = null, $true = false)
{
    if (defined('DEBUG_REMOTE_ADDR') && $_SERVER['REMOTE_ADDR'] != DEBUG_REMOTE_ADDR) return;
    $bt = debug_backtrace();
    $caller = array_shift($bt);
    $file_line = "<strong>" . $caller['file'] . "(line " . $caller['line'] . ")</strong>\n";
    echo "<br/>";
    print_r($file_line);
    echo "<br/>";
    echo "<pre>";
    print_r($dt);
    echo "</pre>";
    if ($true) {
        die("<b>die();</b>");
    }
}


function generateDataTables($sql = [], $columns = [], $search = [], $data_id_field = '')
{
    $obj = new TargetHelper();
    if (!empty($_REQUEST)) {

        $requestData = $_REQUEST;
        $final_sql = '';

        $main_sql = $sql['sql'];
        $group_by = '';
        $order_by = '';
        // set where condition
        if (isset($sql['sql']) && $sql['sql'] != '') {
            $where = " WHERE {$sql['where']}";
        } else {
            $where = " WHERE 1=1";
        }
        if (isset($sql['group_by']) && $sql['group_by'] != '') {
            $group_by = " GROUP BY {$sql['group_by']}";
        }
        if (isset($sql['order_by']) && $sql['order_by'] != '') {
            $order_by = " ORDER BY {$sql['order_by']}";
        }
        $final_sql = $main_sql . $where . $group_by . $order_by;

        $query = DB::select($final_sql);

        $data = $query;
        $totalData = count($query);
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            $first = 0;
            foreach ($search as $col) {
                if ($first == 0) {
                    $where .= " AND {$col} LIKE '" . $requestData['search']['value'] . "%' ";
                } else {
                    $where .= "OR {$col} LIKE '" . $requestData['search']['value'] . "%' ";
                }
                $first++;
            }
            $final_sql = $main_sql . $where . $group_by;

            $query = DB::select($final_sql);
            $totalFiltered = count($query);

            $final_sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";

            $query = DB::select($final_sql);

        } else {
            $order_by = " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";

            $final_sql = $main_sql . $where . $group_by . $order_by;
            $query = DB::select($final_sql);
        }
        $data = $query;


        $finalData = [];
        foreach ($data as $val) {
            $temp = [];
            foreach ($columns as $col) {
                $temp[] = $val->$col;
            }
            $temp['DT_RowId'] = 'row_' . $val->$data_id_field;
            $temp['DT_RowClass'] = 'rows';
            $finalData[] = $temp;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $finalData
        );
        return $json_data;
    }
}

function getSearchDataAll($post)
{
    $geography = array(
        'zones_id' => $post['zones_id'],
        'regions_id' => $post['regions_id'],
        'territories_id' => $post['territories_id'],
        'id' => $post['id']
    );

    $geography_value = array_filter($geography);

    $dquery = DB::table('distribution_houses')->select('id');
    if ($geography) {
        $dquery->where($geography_value);
    }
    $d_value = $dquery->get();

    $house_id = array();
    foreach ($d_value as $dv) {
        array_push($house_id, $dv->id);
    }


//        $squery = DB::table('skues')->select('skues.short_name');
//        $squery->leftJoin('brands','brands.id','=','skues.brands_id');
//        if($post['category_id'])
//        {
//            $squery->where('brands.categories_id',$post['category_id']);
//        }
//        if($post['brands_id'])
//        {
//            $squery->where('skues.brands_id',$post['brands_id']);
//        }
//        if($post['skues_id'])
//        {
//            $squery->where('skues.id',$post['skues_id']);
//        }
//        $s_value = $squery->get();
//
//        $short_name = array();
//        foreach ($s_value as $sv)
//        {
//            array_push($short_name,$sv->short_name);
//        }
//
//        $searchValue = array('house_id'=>$house_id,'short_name'=>$short_name);
    $searchValue = array('house_id' => $house_id);
    return $searchValue;
}

function breadcrumb($data)
{
    $html = '<ol class="breadcrumb">';
    $html .= '<li class="bredlink"><a href="' . URL::to('home') . '"><i class="fa fa-dashboard"></i> Home</a></li>';
    foreach ($data as $val => $url) {
        if ($val != 'active') {
            $html .= '<li class="bredlink"><a href="' . URL::to($url) . '">' . $val . '</a></li>';
        }
    }
    $html .= '<li class="active">' . $data['active'] . '</li>';
    $html .= '</ol>';
    return $html;
}

if (!function_exists('memoStructure')) {
    function memoStructure($brands = [], $skues = [])
    {
        $result = [];
        $selected_brands = \App\Models\Brand::orderBy('ordering', 'ASC');
        if (count($brands) > 0) {
            $selected_brands->whereIn('id', $brands);
        }
        $selected_brands = $selected_brands->get()->toArray();
        foreach ($selected_brands as $brand) {
            $selected_skues = \App\Models\Skue::orderBy('ordering', 'ASC')->where('brands_id', $brand['id']);
            if (count($skues) > 0) {
                $selected_skues->whereIn('id', $skues);
            }
            $selected_skues = $selected_skues->get()->toArray();
            foreach ($selected_skues as $key => $value) {
                $result[$brand['brand_name']][$value['short_name']] = $value['sku_name'];
            }
        }
        return $result;
    }
}

function previous_calculation($house_id, $previous_value, $total_amount, $stock,&$result_append)
{
    foreach ($previous_value as $key => $value) {

        $present_quantity = \App\Models\Stocks::where('distributions_house_id', $house_id)->where('short_name', $key)->first(['quantity']);
        if (!empty($present_quantity)) {
            $present_quantity = $present_quantity->toArray();
            if (!$stock) {
                //secondary
                $update_quantity = calculate_case($key, $present_quantity['quantity'], $value, 'plus');
                //stock_oc($house_id, $key, date('Y-m-d'), $present_quantity['quantity'],$value,false);
            } else {
                //primary
                $update_quantity = calculate_case($key, $present_quantity['quantity'], $value, 'minus');
                $result_append[$key]=$value;
            }
            \App\Models\Stocks::where('distributions_house_id', $house_id)->where('short_name', $key)->update(['quantity' => $update_quantity]);
        }

    }
    if ($stock) {
        $present_current_balance = \App\Models\DistributionHouse::where('id', $house_id)->first(['current_balance']);
        calculate_house_current_balance($house_id, $present_current_balance['current_balance'], $total_amount, 'plus');
        return true;
    }
    return true;
}

if (!function_exists('stock_update')) {
    function stock_update($house_id, $present_value = [], $total_amount = 0, $previous_value = [], $previous_total = 0, $stock = false)
    {

//            //stock release
        if (count($previous_value) > 0) {
            previous_calculation($house_id, $previous_value, $previous_total, $stock,$previous_value_back);
        }
        //update quantity
        foreach ($present_value as $key => $value) {
            $present_quantity = \App\Models\Stocks::where('distributions_house_id', $house_id)->where('short_name', $key)->first(['quantity']);
            if (!empty($present_quantity)) {
                $present_quantity = $present_quantity->toArray();
                //$present_sku_quantity = sku_pack_quantity($key,(float)$present_quantity['quantity']);
                if (!$stock) {
                    //secondary
                    if (sku_pack_quantity($key, $present_quantity['quantity']) >= sku_pack_quantity($key, $value)) {
                        $update_sku_quantity = calculate_case($key, $present_quantity['quantity'], $value, 'minus');
                        stock_oc($house_id, $key, date('Y-m-d'), $value, isset($previous_value_back[$key]) ? $previous_value_back[$key] : 0, false);
                    } else {
                        return false;
                    }
                } else {
                    //primary
                    $update_sku_quantity = calculate_case($key, $present_quantity['quantity'], $value, 'plus');
                    stock_oc($house_id, $key, date('Y-m-d'), $value, isset($previous_value_back[$key]) ? $previous_value_back[$key] : 0, true);
                }
                \App\Models\Stocks::where('distributions_house_id', $house_id)->where('short_name', $key)->update(['quantity' => $update_sku_quantity]);
            }

        }
        $present_current_balance = \App\Models\DistributionHouse::where('id', $house_id)->first(['current_balance']);
        if ($stock) {
            calculate_house_current_balance($house_id, $present_current_balance['current_balance'], $total_amount, 'minus');
            return true;
        }
        return false;

    }
}

if (!function_exists('stock_oc')) {
    function stock_oc($house_id, $sku, $date, $present_quantity, $previous_quantity = 0, $stock = true)
    {
        $get_previous_openning = \App\Models\Stock_oc::where('house_id', $house_id)->where('short_name', $sku)->where('date', $date)->first(['openning']);
        if (is_null($get_previous_openning)) {
            $get_previous_openning = \App\Models\Stocks::where('distributions_house_id', $house_id)->where('short_name', $sku)->first(['openning']);
        }
        $get_present = \App\Models\Stock_oc::where('house_id', $house_id)->where('short_name', $sku)->where('date', $date)->first();
        if (is_null($get_present)) {
            $data['house_id'] = $house_id;
            $data['short_name'] = $sku;
            $data['openning'] = $get_previous_openning->openning;
            if ($stock) {
                $data['lifting'] = $present_quantity;
                $data['closing'] = calculate_case($sku,$data['openning'] , $present_quantity,'plus');
            } else {
                $data['sale'] = $present_quantity;
                $data['closing'] =  calculate_case($sku,$data['openning'] , $present_quantity,'minus');
            }
            $data['date'] = $date;
            \App\Models\Stock_oc::insert($data);


        }
        else{
           $data=[];
           if($stock){
               if($previous_quantity > 0){
                   $calculate_quantity = calculate_case($sku, $present_quantity, $previous_quantity, 'minus');
               }
               else{
                   $calculate_quantity = $present_quantity;
               }
               $data['lifting'] = calculate_case($sku,$calculate_quantity,$get_present->lifting,'plus');
               $data['closing'] = calculate_case($sku,$get_previous_openning->openning , $data['lifting'],'plus');


               //dd($calculate_quantity,$data['lifting'],$get_previous_openning->openning,calculate_case('tp',$get_previous_openning->openning,$data['lifting']));
           }

           else {
               if ($previous_quantity > 0) {
                   $calculate_quantity = calculate_case($sku, $present_quantity, $previous_quantity, 'plus');
               }
               else{
                   $calculate_quantity = $present_quantity;
               }
               $data['sale'] = calculate_case($sku,$calculate_quantity,$get_present->sale,'plus');
               $data['closing'] = calculate_case($sku,$get_previous_openning->openning , $data['sale'],'plus');
           }

           \App\Models\Stock_oc::where('house_id',$house_id)->where('short_name',$sku)->update($data);
        }

    }
}

if (!function_exists('get_module_name')) {
    function get_module_name($module_id = null)
    {
        $user_info = \App\Models\Module::where('id', $module_id)->first();
//            debug($user_info->name,1);
        if ($user_info) {
            return $user_info->name;
        } else {
            return '';
        }
    }
}
if (!function_exists('filter_array')) {
    function filter_array($array)
    {
        $result = array_filter($array, function ($dt) {
            return array_filter($dt);
        });
        return $result;
    }
}


if (!function_exists('repoStructure')) {
    function repoStructure($categories = [], $brands = [], $skues = [])
    {
        $result = [];
        $selected_categories = \App\Models\Category::orderBy('ordering', 'ASC');
        if (count($categories) > 0) {
            $selected_categories->whereIn('id', $categories);
        }
        $selected_categories = $selected_categories->get()->toArray();

        foreach ($selected_categories as $category) {
            $selected_brands = \App\Models\Brand::orderBy('ordering', 'ASC')->where('categories_id', $category['id']);
            if (count($brands) > 0) {
                $selected_brands->whereIn('id', $brands);
            }
            $selected_brands = $selected_brands->get()->toArray();
            foreach ($selected_brands as $brand) {
                $selected_skues = \App\Models\Skue::orderBy('ordering', 'ASC')->where('brands_id', $brand['id']);
                if (count($skues) > 0) {
                    $selected_skues->whereIn('id', $skues);
                }
                $selected_skues = $selected_skues->get()->toArray();
                foreach ($selected_skues as $key => $value) {
                    $result[$category['category_name']][$brand['brand_name']][$value['sku_name']] = $value['short_name'];
                }
            }
        }

        return $result;

    }
}


if (!function_exists('searchAreaOption')) {
    function searchAreaOption($data = array())
    {
        $all_options = array('zone' => 1, 'region' => 1, 'territory' => 1, 'house' => 1, 'route' => 1, 'category' => 1, 'brand' => 1, 'sku' => 1, 'month' => 1, 'daterange' => 1);
        $options = userWiseOptionRemove($all_options);
        foreach ($data as $val) {
            unset($options[$val]);
        }
        $options['show'] = (in_array('show', $data) ? 1 : 0);
        return $options;
    }
}

if (!function_exists('userWiseOptionRemove')) {
    function userWiseOptionRemove($options)
    {
        $user_type = Auth::user()->user_type;
        if ($user_type == 'zone') {
            unset($options['zone']);
        } else if ($user_type == 'region') {
            unset($options['zone']);
            unset($options['region']);
        } else if ($user_type == 'territory') {
            unset($options['zone']);
            unset($options['region']);
            unset($options['territory']);
        }

        return $options;
    }
}


if (!function_exists('get_info_by_aso')) {
    function get_info_by_aso($id, $type = "market")
    {
        $data = DB::table('users')
            ->select('users.name', 'users.mobile', 'users.distribution_house_id', 'distribution_houses.incharge_name as dhname', 'distribution_houses.incharge_phone as dhphone', 'territories.incharge_name as tsoname', 'territories.incharge_phone as tsophone')
            ->join('territories', 'territories.id', '=', 'users.territories_id')
            ->join('distribution_houses', 'distribution_houses.id', 'users.distribution_house_id')
            ->where('users.user_type', $type)
            ->where('users.id', $id)
            ->first();
        return $data;
    }
}

if (!function_exists('get_info_by_asm')) {
    function get_info_by_asm($id, $house_id, $type = "territory")
    {
        $data = DB::table('users')
            ->select('users.name', 'users.mobile', 'distribution_houses.id as distribution_house_id')
            ->join('distribution_houses', 'distribution_houses.territories_id', 'users.territories_id')
            ->where('distribution_houses.id', $house_id)
            ->where('users.user_type', $type)
            ->where('users.id', $id)
            ->first();
        return $data;
    }
}

if (!function_exists('get_regular_price_by_sku')) {
    function get_regular_price_by_sku($sku)
    {
        $data = \App\Models\Skue::where('short_name', $sku)->first();
        if (!is_null($data)) {
            $result = $data->toArray();
            return $result['price'];
        }
        return 0;
    }
}

if (!function_exists('get_house_price_by_sku')) {
    function get_house_price_by_sku($sku)
    {
        $data = \App\Models\Skue::where('short_name', $sku)->first();
        if (!is_null($data)) {
            $result = $data->toArray();
            return $result['house_price'];
        }
        return 0;
    }
}

if (!function_exists('get_order_id_by_sale')) {
    function get_order_id_by_sale($aso_id, $order_date, $route_id)
    {
        $data = \App\Models\Order::where('aso_id', $aso_id)->where('order_date', $order_date)->where('route_id', $route_id)->where('order_type', 'Secondary')->where('order_status', 'Processed')->orderBy('id', 'DESC')->first();
        if (!is_null($data)) {
            $result = $data->toArray();
            return $result;
        }
        return 0;

    }
}
if (!function_exists('promotion_package_merge')) {
    function promotion_package_merge($a1, $a2, $package_qty = 0)
    {
        $sums = array();
        foreach (array_keys($a1 + $a2) as $key) {
            $sums[$key] = (isset($a1[$key]) ? $a1[$key] : 0) + (isset($a2[$key]) ? $a2[$key] : 0);
        }
        if ($package_qty > 0) {
            $sums = array_map(function ($el) use (&$package_qty) {
                return $el * $package_qty;
            }, $sums);
        }
        return $sums;


    }
}

if (!function_exists('get_package_by_name')) {
    function get_package_by_name($package_name)
    {
        $package_details = DB::table('promotional_package')
            ->select('promotional_package.package_details', 'promotional_package.package_free_item')
            ->where('promotional_package.package_name', $package_name)
            ->first();
        $skues = [];
        if (!is_null($package_details)) {
            $skues['purchase'] = json_decode($package_details->package_details, true);
            $skues['free'] = json_decode($package_details->package_free_item, true);
        }
        return $skues;
    }
}

if (!function_exists('sku_details_generate')) {
    function sku_details_generate()
    {
        $result = [];
        $data = \App\Models\Skue::all();
        foreach ($data as $value) {
            $result[$value->short_name] = [
                'db_price' => $value->house_price,
                'price' => $value->price,
                'size' => $value->pack_size,
                'db_unit_price' => number_format(($value->house_price / $value->pack_size), 2),
                'unit_price' => number_format(($value->price / $value->pack_size), 2)
            ];
        }

        file_put_contents('resources/schemas/sku.json', json_encode($result, JSON_PRETTY_PRINT));
    }
}

if (!function_exists('sku_pack_quantity')) {
    function sku_pack_quantity($sku, $quantity)
    {
        if (empty($sku) || empty($quantity) || $quantity < 0) {
            return 0;
        }
        $quantity = number_format((float)$quantity, 2);
        list($pack, $unit) = strstr($quantity, '.') ? explode('.', $quantity) : [$quantity, 0];
        $path = resource_path() . '/schemas/sku.json';
        $data = \Illuminate\Support\Facades\File::get($path);
        $skues = json_decode($data, true);
        $result = $pack * $skues[$sku]['size'];
        return $result + $unit;

    }
}

if (!function_exists('get_sku_price')) {
    function get_sku_price($sku, $house = true)
    {
        $path = resource_path() . '/schemas/sku.json';
        $data = \Illuminate\Support\Facades\File::get($path);
        $skues = json_decode($data, true);
        return $house ? $skues[$sku]['db_unit_price'] : $skues[$sku]['unit_price'];
    }
}

if (!function_exists('getUsersRoutes')) {
    function getUsersRoutes($asoSoId)
    {
        $data = DB::table('routes')
            ->where('routes.so_aso_user_id', $asoSoId)
            ->get();

        $routes_name = '';
        foreach ($data as $k => $v) {
            $routes_name .= $v->routes_name . ',';
        }
        return rtrim($routes_name, ',');
    }
}

if (!function_exists('calculate_case')) {
    function calculate_case($sku, $number1, $number2, $operation = 'plus')
    {
        $path = resource_path() . '/schemas/sku.json';
        $data = \Illuminate\Support\Facades\File::get($path);
        $skues = json_decode($data, true);
        switch ($operation) {
            case 'plus':
                $result = sku_pack_quantity($sku, $number1) + sku_pack_quantity($sku, $number2);
                break;
            case 'minus':
                $result = sku_pack_quantity($sku, $number1) - sku_pack_quantity($sku, $number2);
                break;

        }

        $remainder = fmod($result, $skues[$sku]['size']);
        $without_remainder = $result - $remainder;
        if($remainder > 0 ){
            return +($without_remainder / $skues[$sku]['size'] . '.' .sprintf("%02d", abs($remainder)));
        }
        else{
            return -($without_remainder / $skues[$sku]['size'] . '.' .sprintf("%02d", abs($remainder)));
        }


    }
}
if (!function_exists('calculate_house_current_balance')) {
    function calculate_house_current_balance($house_id, $current_balance, $total_amount, $operation = "plus")
    {
        switch ($operation) {
            case 'plus':
                $update__current_balance = $current_balance + $total_amount;
                \App\Models\DistributionHouse::where('id', $house_id)->update(['current_balance' => $update__current_balance]);
                break;
            case 'minus':
                $update__current_balance = $current_balance - $total_amount;
                \App\Models\DistributionHouse::where('id', $house_id)->update(['current_balance' => $update__current_balance]);
                break;

        }
    }
}

?>