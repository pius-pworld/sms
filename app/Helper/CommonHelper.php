<?php
    function debug($dt=null,$true=false)
    {
        if(defined('DEBUG_REMOTE_ADDR') && $_SERVER['REMOTE_ADDR'] != DEBUG_REMOTE_ADDR) return;
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        $file_line = "<strong>" . $caller['file'] . "(line " . $caller['line'] . ")</strong>\n";
        echo "<br/>";
        print_r ( $file_line );
        echo "<br/>";
        echo "<pre>";
        print_r($dt);
        echo "</pre>";
        if($true)
        {
            die("<b>die();</b>");
        }
    }



    function generateDataTables($sql = [], $columns=[], $search=[], $data_id_field = '')
    {
        $obj = new TargetHelper();
        if(!empty($_REQUEST)){

            $requestData = $_REQUEST;
            $final_sql='';

            $main_sql = $sql['sql'];
            $group_by='';
            $order_by='';
            // set where condition
            if(isset($sql['sql']) && $sql['sql']!=''){
                $where =" WHERE {$sql['where']}";
            }else{
                $where =" WHERE 1=1";
            }
            if(isset($sql['group_by']) && $sql['group_by']!=''){
                $group_by =" GROUP BY {$sql['group_by']}";
            }
            if(isset($sql['order_by']) && $sql['order_by']!=''){
                $order_by =" ORDER BY {$sql['order_by']}";
            }
            $final_sql = $main_sql.$where.$group_by.$order_by;

            $query = DB::select($final_sql);

            $data = $query;
            $totalData = count($query);
            $totalFiltered = $totalData;

            if( !empty($requestData['search']['value']) ) {
                $first =0;
                foreach($search as $col){
                    if($first==0){
                        $where .= " AND {$col} LIKE '".$requestData['search']['value']."%' ";
                    }else{
                        $where .="OR {$col} LIKE '".$requestData['search']['value']."%' ";
                    }
                    $first++;
                }
                $final_sql = $main_sql.$where.$group_by;

                $query = DB::select($final_sql);
                $totalFiltered = count($query);

                $final_sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

                $query = DB::select($final_sql);

            } else {
                $order_by =" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

                $final_sql = $main_sql.$where.$group_by.$order_by;
                $query = DB::select($final_sql);
            }
            $data = $query;


            $finalData =[];
            foreach($data as $val){
                $temp =[];
                foreach ($columns as $col){
                    $temp[] = $val->$col;
                }
                $temp['DT_RowId'] = 'row_'.$val->$data_id_field;
                $temp['DT_RowClass'] = 'rows';
                $finalData[] = $temp;
            }
            $json_data = array(
                "draw"            => intval( $requestData['draw'] ),
                "recordsTotal"    => intval( $totalData ),
                "recordsFiltered" => intval( $totalFiltered ),
                "data"            => $finalData
            );
            return $json_data;
        }
    }

    function getSearchDataAll($post)
    {
        $geography = array(
            'zones_id'=>$post['zones_id'],
            'regions_id'=>$post['regions_id'],
            'territories_id'=>$post['territories_id'],
            'id'=>$post['id']
        );

        $geography_value = array_filter($geography);

        $dquery = DB::table('distribution_houses')->select('id');
        if($geography)
        {
            $dquery->where($geography_value);
        }
        $d_value = $dquery->get();

        $house_id = array();
        foreach($d_value as $dv)
        {
            array_push($house_id,$dv->id);
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
        $searchValue = array('house_id'=>$house_id);
        return $searchValue;
    }

    function breadcrumb($data)
    {
        $html = '<ol class="breadcrumb">';
        $html .= '<li class="bredlink"><a href="'.URL::to('home').'"><i class="fa fa-dashboard"></i> Home</a></li>';
        foreach($data as $val=>$url)
        {
            if($val != 'active')
            {
                $html .= '<li class="bredlink"><a href="'.URL::to($url).'">'.$val.'</a></li>';
            }
        }
        $html .= '<li class="active">'.$data['active'].'</li>';
        $html .= '</ol>';
        return $html;
    }

    if(!function_exists('memoStructure')){
        function memoStructure($brands=[],$skues=[]){
            $result =[];
            $selected_brands=\App\Models\Brand::orderBy('ordering', 'ASC');
                if(count($brands) > 0){
                  $selected_brands->whereIn('id',$brands);
                }
            $selected_brands = $selected_brands->get()->toArray();
            foreach ($selected_brands as $brand){
                $selected_skues = \App\Models\Skue::orderBy('ordering','ASC')->where('brands_id',$brand['id']);
                if(count($skues) > 0){
                    $selected_skues->whereIn('id',$skues);
                }
                $selected_skues= $selected_skues->get()->toArray();
                foreach ($selected_skues as $key=>$value){
                    $result[$brand['brand_name']][$value['short_name']] = $value['sku_name'];
                }
            }
            return $result;
        }
    }

    if(!function_exists('stock_update')){
        function stock_update($house_id,$present_value=[],$previous_value=[],$total_amount=0,$stock=false){
//            //stock release
            if(count($previous_value)>0){
                foreach ($previous_value as $key => $value){
                    $present_quantity = \App\Models\Stocks::where('distributions_house_id',$house_id)->where('short_name',$key)->first(['quantity']);
                    if(!empty($present_quantity)){
                        $present_quantity = $present_quantity->toArray();
                        if(!$stock){
                            $update_quantity = (int)$present_quantity['quantity'] + $value;
                        }
                        else{
                            $update_quantity = (int)$present_quantity['quantity'] - $value;
                        }
                        \App\Models\Stocks::where('distributions_house_id',$house_id)->where('short_name',$key)->update(['quantity'=>$update_quantity]);
                    }

                }
                $present_current_balance = \App\Models\DistributionHouse::where('id',$house_id)->first(['current_balance']);
                if(!$stock){
                    $update_current_balance = $present_current_balance['current_balance'] + $total_amount;
                    \App\Models\DistributionHouse::where('id',$house_id)->update(['current_balance'=>$update_current_balance]);
                }
                else{
                    $update_current_balance = $present_current_balance['current_balance'] + $total_amount;
                    \App\Models\DistributionHouse::where('id',$house_id)->update(['current_balance'=>$update_current_balance]);
                }

            }
            //update quantity
            foreach ($present_value as $key=>$value){
                $present_quantity = \App\Models\Stocks::where('distributions_house_id',$house_id)->where('short_name',$key)->first(['quantity']);
                if(!empty($present_quantity)){
                    $present_quantity = $present_quantity->toArray();
                    if(!$stock){
                        $update_quantity = (int)$present_quantity['quantity'] - $value;
                    }
                    else{
                        $update_quantity = (int)$present_quantity['quantity'] + $value;
                    }
                    \App\Models\Stocks::where('distributions_house_id',$house_id)->where('short_name',$key)->update(['quantity'=>$update_quantity]);
                }

            }
            $present_current_balance = \App\Models\DistributionHouse::where('id',$house_id)->first(['current_balance']);
            if(!$stock){
                $update__current_balance = $present_current_balance['current_balance'] - $total_amount;
                \App\Models\DistributionHouse::where('id',$house_id)->update(['current_balance'=>$update__current_balance]);
            }
            else{
                $update__current_balance = $present_current_balance['current_balance'] + $total_amount;
                \App\Models\DistributionHouse::where('id',$house_id)->update(['current_balance'=>$update__current_balance]);
            }
            return true;
        }
    }

    if(!function_exists('get_module_name'))
    {
        function get_module_name($module_id=null)
        {
            $user_info = \App\Models\Module::where('id',$module_id)->first();
//            debug($user_info->name,1);
            if($user_info)
            {
                return $user_info->name;
            }
            else
            {
                return '';
            }
        }
    }
   if(!function_exists('filter_array')){
       function filter_array($array){
           $result=array_filter($array,function ($dt){
               return array_filter($dt);
           });
           return $result;
       }
   }


if(!function_exists('repoStructure')){
    function repoStructure($categories=[],$brands=[],$skues=[]){
        $result =[];
        $selected_categories = \App\Models\Category::orderBy('ordering', 'ASC');
        if(count($categories) > 0){
            $selected_categories->whereIn('id',$categories);
        }
        $selected_categories = $selected_categories->get()->toArray();

        foreach ($selected_categories as $category){
            $selected_brands=\App\Models\Brand::orderBy('ordering', 'ASC')->where('categories_id',$category['id']);
            if(count($brands) > 0){
                $selected_brands->whereIn('id',$brands);
            }
            $selected_brands = $selected_brands->get()->toArray();
            foreach ($selected_brands as $brand){
                $selected_skues = \App\Models\Skue::orderBy('ordering','ASC')->where('brands_id',$brand['id']);
                if(count($skues) > 0){
                    $selected_skues->whereIn('id',$skues);
                }
                $selected_skues= $selected_skues->get()->toArray();
                foreach ($selected_skues as $key=>$value){
                    $result[$category['category_name']][$brand['brand_name']][ $value['sku_name']] = $value['short_name'];
                }
            }
        }

        return $result;

    }
}


if(!function_exists('searchAreaOption')){
    function searchAreaOption($data = array()){
        $options = array('zone'=>1,'region'=>1,'territory'=>1,'house'=>1,'route'=>1,'category'=>1,'brand'=>1,'sku'=>1,'month'=>1,'daterange'=>1);
        foreach($data as $val)
        {
            unset($options[$val]);
        }
        $options['show'] = (in_array('show',$data)?1:0);
        return $options;
    }
}


if(!function_exists('get_info_by_aso')){
    function get_info_by_aso($id,$type="market"){
        $data=DB::table('users')
             ->select('users.name','users.mobile','users.distribution_house_id','distribution_houses.incharge_name as dhname','distribution_houses.incharge_phone as dhphone','territories.incharge_name as tsoname','territories.incharge_phone as tsophone')
             ->join('territories','territories.id','=','users.territories_id')
             ->join('distribution_houses','distribution_houses.id','users.distribution_house_id')
             ->where('users.user_type',$type)
             ->where('users.id',$id)
             ->first();
        return $data;
    }
}

if(!function_exists('get_info_by_asm')){
    function get_info_by_asm($id,$type="territory"){
        $data=DB::table('users')
            ->select('users.name','users.mobile','users.distribution_house_id','distribution_houses.incharge_name as dhname','distribution_houses.incharge_phone as dhphone','territories.incharge_name as tsoname','territories.incharge_phone as tsophone')
            ->join('territories','territories.id','=','users.territories_id')
            ->join('distribution_houses','distribution_houses.id','users.distribution_house_id')
            ->where('users.user_type',$type)
            ->where('users.id',$id)
            ->first();
        return $data;
    }
}

if(!function_exists('get_regular_price_by_sku')){
    function get_regular_price_by_sku($sku){
        $data = \App\Models\Skue::where('short_name',$sku)->first();
        if(!is_null($data)){
            $result = $data->toArray();
            return $result['price'];
        }
        return 0;
    }
}

if(!function_exists('get_house_price_by_sku')){
    function get_house_price_by_sku($sku){
        $data = \App\Models\Skue::where('short_name',$sku)->first();
        if(!is_null($data)){
            $result = $data->toArray();
            return $result['house_price'];
        }
        return 0;
    }
}

if(!function_exists('get_order_id_by_sale')){
    function get_order_id_by_sale($aso_id,$order_date){
        $data=\App\Models\Order::where('aso_id',$aso_id)->where('order_date',$order_date)->where('order_type','Secondary')->where('order_status','Processed')->orderBy('id', 'DESC')->first();
        if(!is_null($data)){
            $result=$data->toArray();
            return $result['id'];
        }
       return 0;

    }
}
if(!function_exists('promotion_package_merge')){
    function promotion_package_merge($a1,$a2,$package_qty=0){
        $sums = array();
        foreach (array_keys($a1 + $a2) as $key) {
            $sums[$key] = (isset($a1[$key]) ? $a1[$key] : 0) + (isset($a2[$key]) ? $a2[$key] : 0);
        }
        if($package_qty > 0){
            $sums=array_map(function($el) use (&$package_qty) { return $el * $package_qty; }, $sums);
        }
        return $sums;


    }
}

if(!function_exists('get_package_by_name')){
    function get_package_by_name($package_name){
        $package_details = DB::table('promotional_package')
            ->select('promotional_package.package_details','promotional_package.package_free_item')
            ->where('promotional_package.package_name',$package_name)
            ->first();
        $skues=[];
        if(!is_null($package_details)){
            $skues['purchase']=json_decode($package_details->package_details,true);
            $skues['free']=json_decode($package_details->package_free_item,true);
        }
        return $skues;
    }
}

?>