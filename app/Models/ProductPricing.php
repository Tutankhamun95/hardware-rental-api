<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPricing extends Model
{
    protected $table = 'product_pricing';
    protected $fillable = ['product_id', 'rental_period_id', 'region_id', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function rentalPeriod()
    {
        return $this->belongsTo(RentalPeriod::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
