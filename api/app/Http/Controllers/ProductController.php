<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return response()->json(ProductResource::collection(Product::all()));
    }

    public function show($id) {
        return response()->json(new ProductResource(Product::find($id)));
    }
}
