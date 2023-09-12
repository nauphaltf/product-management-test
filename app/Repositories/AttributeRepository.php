<?php

namespace App\Repositories;

use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeRepository extends BaseRepository
{
    public function getAttributes()
    {
        $attributes = Attribute::with('values')->get();
        
        return $attributes;
    }

    public function store($params)
    {
        $attribute = new Attribute();
        $attribute->title = $params['title'];
        $attributeSaved = $attribute->save();
        
        $values = array_map('trim', explode(',', $params['values']));
        $valueArr = [];

        foreach ($values as $value) {
            $valueArr[] = ['value' => $value];
        }

        $valueSaved = $attribute->values()->createMany($valueArr);

        return $attributeSaved && $valueSaved;
    }

    public function delete($id)
    {
        $attribute = Attribute::find($id);

        $attribute->values()->delete();
        $attribute->delete();
    }
}