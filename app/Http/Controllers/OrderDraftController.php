<?php

namespace App\Http\Controllers;

use App\OrderDraft;
use Illuminate\Http\Request;

class OrderDraftController extends Controller
{
    public function index()
    {
        $drafts =  OrderDraft::all();
        $result = [];

        foreach ($drafts as $draft) {
            $id = $draft->getKey();
            $items = OrderDraft::getItemsByOrderDraftId($id);
            $result[] = [
                'draft_order_id' => $id,
                'country_code'   => $draft->getAttribute('country_code'),
                 $id             => $items
                ];

        }

        return ['data' => $result];
    }

    public function show($productType)
    {
        return OrderDraft::getItemsByOrderDraftId(1);
    }


    public function store(Request $request)
    {
        return OrderDraft::create($request->all());
    }
}
