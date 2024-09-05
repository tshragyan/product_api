<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductOptionService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, ProductService $productService)
    {
        $products = $productService->getProducts($request->all(), $request->getQueryString());
        return ProductResource::collection($products);
    }

    public function create(CreateProductRequest $request, ProductService $productService, ProductOptionService $productOptionService)
    {
        if ($productService->findByTitle($request->validated()['title'])) {
            return response()->json([
                'message' => 'The product title already exists.',
            ], 400);
        }

        $product = $productService->create($request->validated());
        $options = $request->validated()['options'] ?? [];

        if (!empty($options)) {
            foreach ($options as $option) {
                $productOptionService->create(array_merge($option, ['product_id' => $product->id]));
            }
        }

        $product = $productService->findById($product->id, ['productOptions']);

        return new ProductResource($product);

    }
}
