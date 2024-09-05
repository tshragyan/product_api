<?php


namespace App\Services;


use App\Models\ProductOption;

class ProductOptionService
{
    public function create(array $data)
    {
        $productOption = new ProductOption();
        $productOption->title = strtolower($data['title']);
        $productOption->value = strtolower($data['value']);
        $productOption->product_id = $data['product_id'];
        $productOption->save();
        return $productOption;
    }
}
