<?php
// app/Http/Resources/ProductPricingResource.php 

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductPricingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'price'         => $this->price,
            'rental_period' => new RentalPeriodResource($this->whenLoaded('rentalPeriod')),
            'region'        => new RegionResource($this->whenLoaded('region')),
        ];
    }
}
