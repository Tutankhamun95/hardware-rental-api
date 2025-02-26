<?php
// app/Http/Resources/ProductResource.php 

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'description'  => $this->description,
            'sku'          => $this->sku,
            'category'     => new CategoryResource($this->whenLoaded('category')),
            'attributes'   => AttributeResource::collection($this->whenLoaded('attributes')),
            'pricing'      => ProductPricingResource::collection($this->whenLoaded('pricing')),
            'inventory'    => InventoryResource::collection($this->whenLoaded('inventory')),
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
