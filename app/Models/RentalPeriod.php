<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalPeriod extends Model
{
    use HasFactory;

    protected $fillable = ['duration', 'label']; 

    public function pricing()
    {
        return $this->hasMany(ProductPricing::class);
    }
}
