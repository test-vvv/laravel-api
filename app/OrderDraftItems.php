<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDraftItems extends Model
{
    public function orderDraft()
    {
        $this->belongsTo('App\OrderDraft');
    }

    public function product()
    {
        $this->belongsTo('App\Product');
    }
}
