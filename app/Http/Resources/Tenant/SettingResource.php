<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
            'description' => $this->resource->description,
            'icon' => $this->resource->icon,
            'status' => $this->resource->status,

            $this->mergeWhen($this->resource->relationLoaded('attributeCategories'), function () {
                return [
                    'categories' => AttributeCategoryResource::collection($this->resource->attributeCategories)
                ];
            }),
        ];
    }
}
