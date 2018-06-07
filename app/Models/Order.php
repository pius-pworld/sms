<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requester_name',
        'requester_phone',
        'dh_phone',
        'dh_name',
        'tso_name',
        'tso_phone',
        'order_total',
        'route_name',
        'total_outlet',
        'visited_outlet',
        'order_type',
        'total_no_of_memo',
        'order_total',
        'created_by'
    ];


    public static function insertOrder($order,$order_details){
        try{
            DB::beginTransaction();
            $order= Order::Create($order);
            OrderDetail::insert($order_details);
            DB::commit();
            return true;
        }catch(\Exception $e){
            dd($e);
            DB::rollBack();
            return false;
        }

    }
}
