<?php

namespace App\Http\Controllers;

//use App\Models\Ordering;
use Illuminate\Http\Request;
use Auth;
use DB;

class SettingsController extends Controller
{
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
        $data['skues'] = DB::table('skues')->where('is_active',1)->orderBy('ordering')->get();
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

        $ddetails = json_decode($details->package_details);
        //dd((array)$ddetails);
        $data['ddetails'] = (array)$ddetails;
        $items = json_decode($details->package_free_item);
        $data['items'] = (array)$items;
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
}
