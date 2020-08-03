<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = 'order';

    
    public function product_order()
    {
        return $this->hasMany('App\models\product_order', 'order_id', 'id');
    }
    
}
