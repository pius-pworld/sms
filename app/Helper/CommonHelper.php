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
        function memoStructure($categories=[],$brands=[],$skues=[]){
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
                        $result[$category['category_name']][$brand['brand_name']][$value['short_name']] = $value['sku_name'];
                    }
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
                            $update_quantity = $present_quantity['quantity'] + $value;
                        }
                        else{
                            $update_quantity = $present_quantity['quantity'] - $value;
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
                        $update_quantity = $present_quantity['quantity'] - $value;
                    }
                    else{
                        $update_quantity = $present_quantity['quantity'] + $value;
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
        $selected_categories= \App\Models\Category::orderBy('ordering', 'ASC');
        if(count($categories) > 0){
            $selected_categories->whereIn('id',$categories);
        }
        $selected_categories = $selected_categories->get()->toArray();
        $selected_brands=\App\Models\Brand::orderBy('ordering', 'ASC');
        if(count($brands) > 0){
            $selected_brands->whereIn('id',$brands);
        }
        if(count($selected_categories) > 0){
            $selected_brands->whereIn('categories_id',$selected_categories);
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
?>