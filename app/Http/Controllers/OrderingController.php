<?php

namespace App\Http\Controllers;

//use App\Models\Ordering;
use Illuminate\Http\Request;
use DB;

class OrderingController extends Controller
{
    public function ordering_brand_skue()
    {
        $data['brands'] = DB::table('brands')->where('is_active',1)->orderBy('ordering')->get();
        //$data['skues'] = DB::table('skues')->where('is_active',1)->get();
        return view('ordering.brandskue',$data);
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
        //$data['brands'] = DB::table('brands')->where('brands_id',1)->orderBy('ordering')->get();
        $data['skues'] = DB::table('skues')->where('is_active',1)->where('brands_id',$id)->orderBy('ordering')->get();
        return view('ordering.showskue',$data);
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
}
