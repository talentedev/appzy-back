<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        if ($request->has('tag')) {
            $products = Product::whereHas('tags', function ($q) use ($request) {
                $q->whereIn('name', $request->tags);
            })->paginate();
        } else {
            $products = Product::paginate();
        }

        return ProductResource::collection($products);
    }
}
