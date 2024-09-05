<?php


namespace App\Services;

use App\DTO\CreateProductDTO;
use App\Models\Product;

class ProductService
{
    public function create(array $data): Product
    {
        $product = new Product();
        $product->title = $data['title'];
        $product->price = $data['price'];
        $product->quantity = $data['quantity'];
        $product->save();
        return $product;
    }

    public function getProductsIdsWithoutOptions(): array
    {
        $response = [];

        Product::leftJoin('product_options', 'products.id', '=', 'product_options.product_id')
            ->whereNull('product_options.product_id')
            ->select('products.id')
            ->chunk(100, function ($items) use (&$response) {
                foreach ($items as $item) {
                    $response[] = $item['id'];
                }
            });

        return $response;
    }

    public function getProducts(array|null $data, string|null $queryString)
    {
        $properties = $data['properties'] ?? null;
        $query = Product::query();

        if (is_array($properties) && !empty($properties)) {
            foreach ($properties as $key => $property) {
                if (is_array($property)) {
                    $query->whereHas('productOptions', function($query) use ($key, $property) {
                        $query->where('title', $key)
                            ->where('value', $property[0]);
                    });
                }
            }
        }

        if (!empty($data['id'])) {
            $query->where('id', $data['id']);
        }

        if (!empty($data['price'])) {
            $query->where('price', $data['price']);
        }

        if (!empty($data['title'])) {
            $query->where('title', $data['title']);
        }

        if (!empty($data['quantity'])) {
            $query->where('quantity', $data['quantity']);
        }

        $query->with('productOptions');

        $page = $data['page'] ?? 1;

        return $query->paginate(Product::PAGINATION_DEFAULT_LIMIT, page: $page)->withPath(route('product.index') . '?' . urldecode($queryString));
    }

    public function findById(int $id, array $relations = []): Product|null
    {
        $query = Product::query()->where('id', $id);

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->first();
    }

    public function findByTitle(string $title): Product|null
    {
        return Product::query()->where('title', $title)->first();
    }
}
