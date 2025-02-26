<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RentalPeriodResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'duration' => $this->duration,
            'label'    => $this->label,
        ];
    }
}
