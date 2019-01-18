<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDraft extends Model
{
    public function orderDraftItems()
    {
        return $this->hasMany('App\OrderDraftItem');
    }

    public static function getItemsByOrderDraftId($id)
    {
        return OrderDraftItem::with('product:id,product_type,color,size,price')
            ->where('order_draft_id', $id)->get();
    }
}
