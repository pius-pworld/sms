<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
        'brands_id',
        'skues_id',
        'price',
        'quantity',
        'description',
        'created_by',
        'updated_by',
        'is_active'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the brand for this model.
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brands_id');
    }

    /**
     * Get the skue for this model.
     */
    public function skue()
    {
        return $this->belongsTo('App\Models\Skue', 'skues_id');
    }


}
