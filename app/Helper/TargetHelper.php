<?php

namespace App\Helper;
use DB;
use Auth;

class TargetHelper
{
    public function __construct()
    {
        DB::enableQueryLog();
    }
    public static function getTargetJsonValue($type,$type_id,$target_month,$array) {
        foreach ($array as $key => $val) {
            if (($val->target_type == $type) && ($val->type_id == $type_id) && ($val->target_month == $target_month)) {
                $data['base'] = json_decode($val->base_value,true);
                $data['target'] = json_decode($val->target_value,true);
                return $data;
            }
        }
        return false;
    }

    public static function totalJsonValue($type,$short_name,$target_month,$array)
    {
        $totalBase = 0;
        $totalTarget = 0;
        foreach ($array as $key => $val) {
            if (($val->target_type == $type) && ($val->target_month == $target_month)) {
                $base = json_decode($val->base_value,true);
                $target = json_decode($val->target_value,true);
                $totalBase = $totalBase+$base[$short_name];
                $totalTarget = $totalTarget+$target[$short_name];
            }
        }
        $result = array('base'=>$totalBase,'target'=>$totalTarget);
        return $result;
    }

    public static function totalExistingJsonValue($type,$short_name,$target_month)
    {
        if($type == 'zones')
        {
            $existingTarget = DB::table('targets')
                ->where('target_type','')
                ->where('target_month','')
                ->where('type_id','')->first();
        }
        else if($type == 'regions')
        {
            $existingTarget = DB::table('targets')
                ->where('target_type','zones')
                ->where('target_month',$target_month)
                ->where('type_id',Auth::user()->zones_id)->first();
        }
        else if($type == 'territories')
        {
            $existingTarget = DB::table('targets')
                ->where('target_type','regions')
                ->where('target_month',$target_month)
                ->where('type_id',Auth::user()->regions_id)->first();
//            debug(DB::getQueryLog(),1);
        }
        else if($type == 'area')
        {
            $existingTarget = DB::table('targets')
                ->where('target_type','territories')
                ->where('target_month',$target_month)
                ->where('type_id',Auth::user()->territories_id)->first();
//            debug(DB::getQueryLog(),1);
        }
        $target = json_decode(@$existingTarget->target_value,true);
        $result = array('target'=>(($target)?$target[$short_name]:0));
        return $result;
    }
}
