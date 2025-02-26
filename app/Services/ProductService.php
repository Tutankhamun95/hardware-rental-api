<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;

class ProductService
{
    public function getProductById($id)
    {
        Log::info("Fetching product with ID: $id");
        $product = Product::with([
            'attributes',
            'pricing.rentalPeriod',
            'pricing.region',
            'inventory'
        ])->findOrFail($id);
        Log::info("Product fetched successfully", ['product_id' => $id]);
        return $product;
    }


    public function filterProducts(array $filters)
    {
        Log::info("Filtering products", $filters);
        $query = Product::query();

        if (isset($filters['region']) || isset($filters['rental_period'])) {
            $query->whereHas('pricing', function ($q) use ($filters) {
                if (isset($filters['region'])) {
                    $q->where('region_id', $filters['region']);
                }
                if (isset($filters['rental_period'])) {
                    $q->where('rental_period_id', $filters['rental_period']);
                }
            });
        }

        if (isset($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        if (isset($filters['availability'])) {
            $query->whereHas('inventory', function ($q) use ($filters) {
                $q->where('status', $filters['availability']);
            });
        }

        if (isset($filters['query'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['query']}%")
                    ->orWhere('sku', 'like', "%{$filters['query']}%")
                    ->orWhere('description', 'like', "%{$filters['query']}%");
            });
        }

        return $query->select('id', 'name', 'description', 'sku', 'category_id', 'created_at', 'updated_at')
            ->with([
                'attributes:id,name', // only load id and name from attributes
                'pricing' => function ($q) {
                    $q->select('id', 'product_id', 'price', 'rental_period_id', 'region_id');
                },
                'pricing.rentalPeriod:id,duration,label',
                'pricing.region:id,name',
                'inventory' => function ($q) {
                    $q->select('id', 'product_id', 'quantity', 'status', 'region_id');
                },
        ])->paginate(10);
    }
}
