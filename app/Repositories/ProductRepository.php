<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function getProducts()
    {
        $products = Product::with('attributes')->get();

        return $products;
    }

    public function store($params, $request, $attributes)
    {
        $product = new Product();
        $product->title = $params['title'];
        $product->description = $params['description'];
        $product->main_image = $params['image-path'];
        $productSaved = $product->save();
        
        $valueArr = [];
        foreach ($attributes as $attribute) {
            if (!empty($valueId = $request->get('attribute-' . $attribute->id))) {
                $valueArr[] = [
                    'attribute_id' => $attribute->id,
                    'value_id' => $valueId
                ];       
            }
        }

        $attributeSaved = $product->attributes()->createMany($valueArr);


        return $attributeSaved && $productSaved;
    }

    public function getProduct($id)
    {
        $product = Product::with('attributes')->find($id);

        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);

        $product->attributes()->delete();
        $product->delete();
    }

}