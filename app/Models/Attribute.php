<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
