<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        $productServiceUrl = env('PRODUCT_SERVICE_URL');
        $response = Http::get("$productServiceUrl/api/v1/products");

        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Product service error'], 500);
        }
    }
}
