<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    const DISCONNECTED = 'discounted';
    const CONNECTED = 'connected';

    public function index()
    {
        $response = [
            'product-service' => $this->productServiceHealthCheck(),
        ];

        return response()->json($response, 200);
    }

    private function productServiceHealthCheck(): string
    {
        $productServiceUrl = env('PRODUCT_SERVICE_URL');
        $response = Http::post("$productServiceUrl/api/health-check");
        if ($response->failed()) {
            return self::DISCONNECTED;
        }
        return self::CONNECTED;
    }
}
