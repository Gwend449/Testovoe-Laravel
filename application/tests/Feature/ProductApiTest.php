<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_filter_products_by_price(): void
    {
        Product::factory()->create(['price' => 500]);
        Product::factory()->create(['price' => 100]);

        $response = $this->getJson('/api/products?price_from=100&price_to=100');
        $response->assertStatus(200)->assertJsonCount(1, 'data');
    }
}
