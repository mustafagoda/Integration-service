<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
            'description' => $this->resource->description,
            'icon' => $this->resource->icon,
            'status' => $this->resource->status,
            $this->mergeWhen($this->resource->relationLoaded('attributes'),function (){
                return [
                    'attributes' => AttributeResource::collection($this->resource->attributes)
                ];
            }),
        ];
    }
}
