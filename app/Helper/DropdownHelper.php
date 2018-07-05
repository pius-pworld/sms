<?php
    function dropdownList($id)
    {
        $dd_info = DB::table('dropdown_list')->where('dd_id',$id)->first();
        $data_info = DB::select($dd_info->query);
        $res=[];
        foreach ($data_info as $value){
            $res[] = collect($value)->toArray();
        }
        $html = '<select class="form-control '.$dd_info->selector_class.'" name="'.$dd_info->field_name.'[]">';
        $html .= '<option value="">Select One</option>';
        foreach($res as $k=>$v)
        {
            $html .= '<option value="'.$v[$dd_info->option_id].'">'.$v[$dd_info->option_value].'</option>';
        }
        $html .= '</select>';
        return $html;
function dropdownList($id)
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