<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Sms as Sms_model;
use JsonSchema;

class Sms extends Controller
{
    private $sms_model;
    private $count_list=['tp','tc','bhp','bhc','fp','fc','f(h)','f(1)','f(2)','ucp','ucc','uc(h)','ulp','ulc','ul(h)','uop','uoc','uo(h)','uo(1)','uz',
        'ornj','lmnj','m','m(h)','m(1)','mkp','mkt','mk(h)','lyp','lyc','a(h)','a(1.5)'];
    function __construct()
    {
        $this->sms_model = new Sms_model();
    }

    //prepare data
    private function prepareData(array $input){
        $result_array=[];
        foreach ($input as $val){
            $val=strtolower($val);
            if(strpos($val,'-')){
                $dt= explode("-",$val);
                $result_array[$dt[0]] =count($dt)-1 >1 ? implode('-',array_slice($dt,1)) : $dt[1] ;
            }
            else{
                echo "Invalid SMS Format at String Contains (".$val.")";
                die;
            }
        }
        return $result_array;
    }
    //parse Data
    private function parseData($input_data){
        list($identifier,$input)=explode('/',$input_data, 2);
        $input_array=(explode("/", $input));
        if(strtolower($identifier) === 'order'){
            $result_array=self::prepareData($input_array);
            //validation
            $data = json_decode(json_encode($result_array));
            $validator = new JsonSchema\Validator;
            $validator->validate($data, (object)['$ref' => 'file://' . realpath('resources/schemas/'.$identifier.'.json')]);
            if (!$validator->isValid()) {
                foreach ($validator->getErrors() as $error) {
                    echo sprintf("[%s] %s\n", $error['property'], $error['message']);
                }
            }
            else{
                echo "Validate data";
            }
        }
    }

    //get total
    private function getTotal($input_data){
        $total=0;
        foreach ($this->count_list as $key => $value) {
            if(array_key_exists($value, $input_data)){
                $total=$total + $input_data[$value];
            }
        }
        return $total;
    }

    //
    public function parseSms(){
        $data=$this->sms_model->getSms(2);
        if(!empty($data) && !empty($data->sms_content)){
           $this->parseData($data->sms_content);
        }

    }
}
