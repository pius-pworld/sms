<?php

namespace App\Http\Controllers;

//use App\Models\Ordering;
use Illuminate\Http\Request;
use Auth;
use DB;
use commonHelper;

class SettingsController extends Controller
{
    public function __construct()
    {
        DB::enableQueryLog();
    }
    public function ordering_brand_skue()
    {
        $data['brands'] = DB::table('brands')->where('is_active',1)->orderBy('ordering')->get();
        //$data['skues'] = DB::table('skues')->where('is_active',1)->get();
        return view('settings.brandskue',$data);
    }

    public function ordering_brand_skue_action(Request $request)
    {
        $post = $request->only('order');
        foreach($post['order'] as $order)
        {
            $brandering = explode('_',$order);
            $brand_id = $brandering[0];
            $index = $brandering[1];
            DB::table('brands')->where('id', $brand_id)->update(['ordering' => $index]);
        }
    }


    public function show_skue($id)
    {
        //$data['brands'] = DB::table('brands')->where('brands_id',1)->orderBy('settings')->get();
        $data['skues'] = DB::table('skues')->where('is_active',1)->where('brands_id',$id)->orderBy('ordering')->get();
        return view('settings.showskue',$data);
    }

    public function orderingSkueAction(Request $request)
    {
        $post = $request->only('order');
        //dd($post);
        foreach($post['order'] as $order)
        {
            $skueordering = explode('_',$order);
            $brand_id = $skueordering[0];
            $index = $skueordering[1];
            $skue_id = $skueordering[2];
            DB::table('skues')->where('id', $skue_id)->update(['ordering' => $index]);
        }
    }

    public function setPromotions()
    {
//        return 'set promotion page';
        $data['skues'] = DB::table('skues')
            ->join('brands', 'brands.id', '=', 'skues.brands_id')
            ->select('skues.*','brands.brand_name')
            ->where('skues.is_active',1)->orderBy('skues.ordering')->get();
        return view('settings.setPromotions',$data);
    }

    public function promotion_submit(Request $request)
    {
        $post = $request->all();
        //dd($post['package_name']);
        $data['package_name'] = $post['package_name'];
        $data['package_start'] = $post['package_start'];
        $data['package_end'] = $post['package_end'];

        foreach($post['package_key'] as $k=>$v)
        {
            $details[$v] = $post['package_value'][$k];
        }
        $data['package_details'] = json_encode($details);


        foreach($post['free_items'] as $k=>$v)
        {
            $items[$v] = $post['free_items_value'][$k];
        }
        $data['package_free_item'] = json_encode($items);
        $data['created_by'] = Auth::id();
        if(isset($post['is_active']))
        {
            $data['is_active'] = $post['is_active'];
        }
        DB::table('promotional_package')->insert($data);
        return redirect('promotionsList')->with('success', 'Information has been added.');
    }


    public function promotions_list()
    {
        $data['promotions'] = DB::table('promotional_package')->orderBy('package_start')->get();
        return view('settings.promotions_list',$data);
    }

    public function delete_promotions($id)
    {
        DB::table('promotional_package')->where('id',$id)->delete();
        return redirect('promotionsList')->with('success', 'Information has been deleted.');
    }

    public function package_details($id)
    {
        $details = DB::table('promotional_package')->select('*')->where('id',$id)->first();

        $ddetails = json_decode($details->package_details,true);
        //dd((array)$ddetails);
        $data['ddetails'] = $ddetails;
        $items = json_decode($details->package_free_item,true);
        $data['items'] = $items;
        $psku_id = array();
        foreach($ddetails as $k=>$d)
        {
            $psku_id[] = $k;
        }

        $isku_id = array();
        foreach($items as $k=>$v)
        {
            $isku_id[] = $k;
        }
        //dd($isku_id);
        $data['package_details'] = DB::table('skues')->whereIn('id', $psku_id)->get();
        $data['items_details'] = DB::table('skues')->whereIn('id', $isku_id)->get();
        //dd($psku_id);
        return view('settings.promotions_details',$data);
    }

    public function active_inactive($id,$is_active)
    {
        DB::table('promotional_package')->where('id', $id)->update(['is_active' => ($is_active)?0:1]);
        return redirect('promotionsList')->with('success', 'Information has been changed.');
    }


    public function target_set($type,$target_month=null)
    {
        $data['type'] = $type;
        $data['target_month'] = $target_month;
        if($target_month)
        {
            $data['existingValue'] = DB::table('targets')
                ->select('*')
                ->where('target_type',$type)
                ->where('target_month',$target_month)->get();
            //commonHelper::debug($data['existingValue'],1);

            if($type == 'zones')
            {
                $data['geographies'] = DB::table('zones')->select('id','zone_name as gname')->where('is_active',1)->orderBy('ordering')->get();
                $data['baseData'] = $this->baseData($data['geographies']);
            }
            $data['skues'] = DB::table('skues')
                ->select('skues.*')
                ->leftJoin('brands', 'brands.id', '=', 'skues.brands_id')
                ->where('skues.is_active',1)
                ->orderBy('brands.ordering')->get();

            $data['brands'] = DB::table('skues')
                ->select('brands.brand_name',DB::raw('COUNT(skues.brands_id) as total'))
                ->leftJoin('brands', 'brands.id', '=', 'skues.brands_id')
                ->where('skues.is_active',1)
                ->groupBy('skues.brands_id')
                ->orderBy('brands.ordering')->get();
        }
        return view('settings.target_set',$data);
    }

    public function target_set_process(Request $request)
    {
        $post = $request->all();
        $data['type'] = $post['target_type'];
        $data['target_month'] = $post['target_month'];
        $data['existingValue'] = array();
        if($post['target_type'] == 'zones')
        {
            $data['geographies'] = DB::table('zones')->select('id','zone_name as gname')->where('is_active',1)->orderBy('ordering')->get();
            $data['baseData'] = $this->baseData($data['geographies']);
        }

        $data['skues'] = DB::table('skues')
            ->select('skues.*')
            ->leftJoin('brands', 'brands.id', '=', 'skues.brands_id')
            ->where('skues.is_active',1)
            ->orderBy('brands.ordering')->get();

        $data['brands'] = DB::table('skues')
            ->select('brands.brand_name',DB::raw('COUNT(skues.brands_id) as total'))
            ->leftJoin('brands', 'brands.id', '=', 'skues.brands_id')
            ->where('skues.is_active',1)
            ->groupBy('skues.brands_id')
            ->orderBy('brands.ordering')->get();


        $existing = DB::table('targets')
            ->where('target_type',$post['target_type'])
            ->where('target_month',$post['target_month'])->get();



        if($existing->isEmpty())
        {
            return view('settings.target_set_ajax_data_show',$data);
        }
        else
        {
            echo false;
        }
    }

    public function baseData($geography)
    {
        $data = array();
        foreach($geography as $k=>$v)
        {
            $skues = DB::table('skues')->where('is_active',1)->orderBy('ordering')->get();
            foreach($skues as $sk=>$sv)
            {
                $base = rand(10,100);
                $data[$v->id][$sv->brands_id][$sv->id] = $base;
            }
        }
        return $data;
    }

    public function target_submit(Request $request)
    {
        $post = $request->all();
//        dd($post);
        $insertData['target_type'] = $post['target_type'];
        $insertData['target_month'] = $post['target_month'];
        $insertData['base_date'] = $post['base_date'];

        if($post['edit'])
        {
            DB::table('targets')
                ->where('target_type', $post['target_type'])
                ->where('target_month',$post['target_month'])->delete();
        }

        foreach($post['geography_id'] as $geography)
        {
            $insertData['type_id'] = $geography;
            $baseValue = array();
            foreach($post['base_distribute'][$geography] as $k=>$v)
            {
                foreach($v as $vk=>$vv)
                {
                    $baseValue[$vk] = $vv;
                }
            }
            $insertData['base_value'] = json_encode($baseValue);

            $targetValue = array();
            foreach($post['target_distribute'][$geography] as $k=>$v)
            {
                foreach($v as $vk=>$vv)
                {
                    $targetValue[$vk] = $vv;
                }
            }
            $insertData['target_value'] = json_encode($targetValue);
            $insertData['created_by'] = Auth::id();
            DB::table('targets')->insert($insertData);
        }

        return redirect('targetSet/zones')->with('success', 'Information has been added.');
    }

    public function remove_target($type,$target_month)
    {
       // dd($type);
        DB::table('targets')
            ->where('target_type', $type)
            ->where('target_month',$target_month)->delete();
        return redirect('targetSet/'.$type)->with('success', 'Information has been removed.');
    }

}
