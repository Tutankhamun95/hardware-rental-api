<?php
// app/Http/Resources/InventoryResource.php 

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'quantity' => $this->quantity,
            'status'   => $this->status,
            'region'   => new RegionResource($this->whenLoaded('region')),
        ];
    }
}
