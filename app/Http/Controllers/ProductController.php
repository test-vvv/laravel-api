<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json($product, Response::HTTP_CREATED);
    }
}
