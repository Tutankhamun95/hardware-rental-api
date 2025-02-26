<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'sku', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship through the pivot table "attribute_values" 
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_values')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function pricing()
    {
        return $this->hasMany(ProductPricing::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
