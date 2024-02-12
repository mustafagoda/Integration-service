<?php

namespace App\Http\Resources\Landlord;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->resource->slug,
            'status' => $this->resource->active,
            'name' => $this->resource->name,
        ];
    }
}
