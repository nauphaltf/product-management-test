<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function getProducts()
    {
        $products = Product::all();

        return $products;
    }
}