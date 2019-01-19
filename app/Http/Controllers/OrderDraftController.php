<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderDraftRequest;
use App\OrderDraft;
use App\OrderDraftItem;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function calculate(OrderDraftRequest $request)
    {
        $total = $this->getTotalPrice($request);

        if($total instanceof JsonResponse) {
            return $total;
        }

        if ($total < 10) {
            return response()->json([
                'error' => 'Total price is too low'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $countryCode = geoip($request->ip())->getAttribute('iso_code');
        $draftId = OrderDraft::create(['country_code' => $countryCode])->getKey();

        $this->saveOrderDraft($request->input('data.products'), $draftId);

        return response()->json([
            'data' => [
                "Total price" => $total
            ]
        ]);
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

    private function getTotalPrice($request)
    {
        $result = 0.00;

        foreach ($request->input('data.products') as $product) {
            if(Product::whereKey($product['product_id'])->count() < 1) {
                return response()->json([
                    'error' => "There is no product with such an id: {$product['product_id']}"
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $result += Product::whereKey($product['product_id'])->value('price') * $product['qty'];
        }
        return $result;
    }

    private function saveOrderDraft($products, $draftId)
    {
        foreach ($products as $product) {
            OrderDraftItem::create([
                'order_draft_id' => $draftId,
                'product_id' => $product['product_id'],
                'qty' => $product['qty']
            ]);
        }
    }

    public function test()
    {
        return [];
    }

}
