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
?>