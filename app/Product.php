<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_type', 'color', 'size', 'price'];

    public function orderDraftItems()
    {
        $this->hasMany('App\OrderDraftItems');
    }
}
