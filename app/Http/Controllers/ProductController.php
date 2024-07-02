<?php

namespace App\Http\Controllers;

use App\Models\{Product, ProductType};
use Illuminate\Http\Request;
use App\Http\Resources\ProductTypeCollection;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $product = new Product;

        if ($request->hasAny($product->getAllProperties())) {
            $query = $request->only($product->getAllProperties());
            return ProductTypeCollection::collection($product->searchProduct($query));
        }
        if (!empty($q = $request->query())) {
            return 'Unknown product properties: ' . implode(',', array_keys($q));
        }
        return ProductTypeCollection::collection($product->getAllProductTypes());

    }
}
