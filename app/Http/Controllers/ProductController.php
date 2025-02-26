<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(ProductFilterRequest $request)
    {
        Log::info("API Request: GET /api/products with filters", $request->all());
        try {
            $products = $this->productService->filterProducts($request->validated());
            return apiResponse([
                'products'   => ProductResource::collection($products),
                'pagination' => [
                    'total'        => $products->total(),
                    'per_page'     => $products->perPage(),
                    'current_page' => $products->currentPage(),
                    'last_page'    => $products->lastPage(),
                ],
            ], "Products retrieved successfully");
        } catch (\Exception $e) {
            Log::error("Error filtering products", ['error' => $e->getMessage()]);
            return apiResponse(null, "Error retrieving products", 500);
        }
    }

    public function show($id)
    {
        Log::info("API Request: GET /api/products/{$id}");
        try {
            $product = $this->productService->getProductById($id);
            Log::info("Product retrieved successfully", ['product_id' => $id]);
            return apiResponse(new ProductResource($product), "Product retrieved successfully");
        } catch (\Exception $e) {
            Log::error("Error retrieving product", ['error' => $e->getMessage()]);
            return apiResponse(null, "Product not found", 404);
        }
    }
}
