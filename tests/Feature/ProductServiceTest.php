<?php
// tests/Unit/ProductServiceTest.php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $service;
    protected $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ProductService();

        // Insert necessary data.
        DB::table('regions')->insert([
            ['name' => 'Singapore', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Malaysia', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('rental_periods')->insert([
            ['duration' => 3, 'label' => '3 months', 'created_at' => now(), 'updated_at' => now()],
            ['duration' => 6, 'label' => '6 months', 'created_at' => now(), 'updated_at' => now()],
            ['duration' => 12, 'label' => '12 months', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Create a product.
        $this->product = Product::create([
            'name' => 'Service Test Product',
            'description' => 'Test description for service',
            'sku' => 'SERVICETEST' . rand(1000, 9999),
            'category_id' => 1,
        ]);

        // Insert a pricing record.
        DB::table('product_pricing')->insert([
            'product_id' => $this->product->id,
            'rental_period_id' => 1,
            'region_id' => 1,
            'price' => 150,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function testGetProductById()
    {
        $product = $this->service->getProductById($this->product->id);

        $this->assertNotNull($product);
        $this->assertEquals('Service Test Product', $product->name);
        // Since we're eager loading pricing and attributes,
        // these relationships should be loaded.
        $this->assertTrue($product->relationLoaded('pricing'));
        $this->assertTrue($product->relationLoaded('attributes'));
    }

    public function testFilterProducts()
    {
        $filters = ['region' => 1, 'rental_period' => 1];
        $results = $this->service->filterProducts($filters);

        $this->assertNotEmpty($results);

        // For each product, check that at least one pricing record matches the filters.
        foreach ($results as $result) {
            $found = false;
            foreach ($result->pricing as $pricing) {
                if ($pricing->region_id == 1 && $pricing->rental_period_id == 1) {
                    $found = true;
                    break;
                }
            }
            $this->assertTrue($found, "Product {$result->id} does not have the required pricing.");
        }
    }
}
