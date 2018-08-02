<?php
function getUserWiseGeo($type)
{
    $routes = json_decode(session('routes_list'));
//    debug($routes,1);
    if($type != 'aso')
    {
        $sql = DB::table('routes')->select('distribution_houses.id');
        $sql->leftJoin('distribution_houses','distribution_houses.id','=','routes.distribution_houses_id');
        $sql->whereIn('routes.id',$routes);
        if($type == 'zone')
        {
            $sql->groupBy('distribution_houses.regions_id');
        }
        else if($type == 'region')
        {
            $sql->groupBy('distribution_houses.territories_id');
        }
        $result = $sql->get();
        return implode(',',array_column(collect($result)->toArray(),'id'));
    }
    else
    {
        return implode(',',$routes);
    }
}
function dropdownList($id)
{
    $dd_info = DB::table('dropdown_list')->where('dd_id',$id)->first();

    $query = $dd_info->query;
    $kword = explode('@', $query);

    if(isset($kword[1]))
    {
        $wherearray = explode('=',$kword[1]);
        $session = $wherearray[1];
//        debug($session,1);
        if($session)
        {

            $where = $wherearray[0].' IN('.getUserWiseGeo($session).')';
            $query = str_replace('@'.$kword[1].'@',$where,$query);
        }
        else
        {
            $query = str_replace('@'.$kword[1].'@',1,$query);
        }
    }
//    debug($query,1);
    $data_info = DB::select($query);
    $res=[];
    foreach ($data_info as $value){
        $res[] = collect($value)->toArray();
    }
    $html = '<select class="form-control '.$dd_info->selector_class.'" name="'.$dd_info->field_name.'[]" '.(($dd_info->multiselect)?'multiple':'').'>';
    $html .= '<option value="">Select One</option>';
    foreach($res as $k=>$v)
    {
        $html .= '<option value="'.$v[$dd_info->option_id].'">'.$v[$dd_info->option_value].'</option>';
    }
    $html .= '</select>';
    return $html;
}
function dropdownListSingle($id)
{
    $dd_info = DB::table('dropdown_list')->where('dd_id',$id)->first();
    $data_info = DB::select($dd_info->query);
    $res=[];
    foreach ($data_info as $value){
        $res[] = collect($value)->toArray();
    }
    $html = '<select class="form-control '.$dd_info->selector_class.'" name="'.$dd_info->field_name.'">';
    $html .= '<option value="">Select One</option>';
    foreach($res as $k=>$v)
    {
        $html .= '<option value="'.$v[$dd_info->option_id].'">'.$v[$dd_info->option_value].'</option>';
    }
    $html .= '</select>';
    return $html;
}
?>