<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDraftItem extends Model
{
    protected $hidden = ['id', 'created_at', 'updated_at', 'order_draft_id', 'product_id'];

    public function orderDraft()
    {
        return $this->belongsTo('App\OrderDraft');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
