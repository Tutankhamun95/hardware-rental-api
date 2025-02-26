<?php
// app/Http/Resources/AttributeResource.php 

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'pivot_value' => $this->pivot->value ?? null,
        ];
    }
}
