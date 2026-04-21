<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductIndexRequest;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    ) {
    }

    public function index(ProductIndexRequest $request)
    {
        $products = $this->productService->getFilteredProducts($request->validated());
        return ProductResource::collection($products);
    }
}
