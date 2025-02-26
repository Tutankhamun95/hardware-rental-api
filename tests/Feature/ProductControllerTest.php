<?php
// tests/Feature/ProductControllerTest.php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $product;

    protected function setUp(): void
    {
        parent::setUp();

        // Insert basic data needed for the tests.
        DB::table('regions')->insert([
            ['name' => 'Singapore', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Malaysia',  'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('rental_periods')->insert([
            ['duration' => 3, 'label' => '3 months', 'created_at' => now(), 'updated_at' => now()],
            ['duration' => 6, 'label' => '6 months', 'created_at' => now(), 'updated_at' => now()],
            ['duration' => 12, 'label' => '12 months', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Create a product record.
        $this->product = Product::create([
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'sku' => 'TESTSKU' . rand(1000, 9999),
            'category_id' => 1,
        ]);

        // Create a pricing record for the product.
        DB::table('product_pricing')->insert([
            'product_id' => $this->product->id,
            'rental_period_id' => 1,
            'region_id' => 1,
            'price' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function testIndexReturnsProducts()
    {
        $response = $this->json('GET', '/products', [
            'region' => 1,
            'rental_period' => 1,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'products',
                    'pagination' => [
                        'total',
                        'per_page',
                        'current_page',
                        'last_page'
                    ],
                ],
            ]);
    }

    public function testShowReturnsProduct()
    {
        $response = $this->json('GET', '/products/' . $this->product->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'name',
                    'description',
                    'sku'
                ],
            ]);
    }
}
