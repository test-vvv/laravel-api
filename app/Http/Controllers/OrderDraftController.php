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
            $result[$id] = $items;
        }

        return ['data' => $result];
    }

    public function show($id)
    {
        return OrderDraft::getItemsByOrderDraftId($id);
    }


    public function store(Request $request)
    {
        return OrderDraft::create($request->all());
    }
}
