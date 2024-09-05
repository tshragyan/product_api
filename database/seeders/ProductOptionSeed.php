<?php

namespace Database\Seeders;

use App\Models\ProductOption;
use App\Services\ProductService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOptionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(ProductService $productService): void
    {
        $productIds = $productService->getProductsIdsWithoutOptions();

        foreach ($productIds as $productId)
        {
            ProductOption::factory()->color()->create([
                'product_id' => $productId
            ]);

            ProductOption::factory()->size()->create([
                'product_id' => $productId
            ]);

            ProductOption::factory()->brand()->create([
                'product_id' => $productId
            ]);
        }
    }
}
