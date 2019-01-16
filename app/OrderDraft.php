<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDraft extends Model
{
    public function orderDraftItems()
    {
        $this->hasMany('App\OrderDraftItems');
    }
}
