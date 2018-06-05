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
        'created_by'
    ];


    public static function insertOrder($order,$order_details){
        try{
            DB::beginTransaction();
            $order= Order::Create($order);
            $order_details['orders_id'] = $order->id;
            OrderDetail::Create($order_details);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return false;
        }

    }
}
