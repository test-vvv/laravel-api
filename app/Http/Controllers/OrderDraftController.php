<?php

namespace App\Http\Controllers;

use App\OrderDraft;
use App\OrderDraftItem;
use Illuminate\Http\Request;

class OrderDraftController extends Controller
{
    public function index()
    {
        $drafts =  OrderDraft::all();

        return $this->buildDraftsView($drafts);
    }

    public function show($productType)
    {
        $drafts =  OrderDraftItem::query()
            ->join('order_drafts', 'order_draft_items.order_draft_id', '=', 'order_drafts.id')
            ->join('products', 'order_draft_items.product_id', '=', 'products.id')
            ->where('product_type', $productType)
            ->select('order_drafts.*')->get();

        return $this->buildDraftsView($drafts);
    }


    public function store(Request $request)
    {
        return OrderDraft::create($request->all());
    }

    private function buildDraftsView($drafts)
    {
        $result = [];
        foreach ($drafts as $draft) {
            $id = $draft->getKey();
            $items = OrderDraft::getItemsByOrderDraftId($id);
            $result[] = [
                'draft_order_id' => $id,
                'country_code' => $draft->getAttribute('country_code'),
                $id => $items
            ];
        }

        return ['data' => $result];
    }
}
