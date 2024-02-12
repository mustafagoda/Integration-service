<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeOptionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'key' => $this->resource->attributable->slug,
            'value' => $this->resource->attributable->name,
            'status' => $this->resource->attributable->status,
            'icon' => $this->resource->attributable->icon,
        ];
    }
}
