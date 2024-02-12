<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
            'status' => $this->resource->status,
            'placeholder' => $this->resource->placeholder,
            'validation' => json_decode($this->resource->validation),
            'icon' => $this->resource->icon,
            'field_type' => $this->resource->type,
            'value' => $this->resource->pivot->value,
            'tooltip' => $this->resource->tooltip,
            $this->mergeWhen($this->resource->relationLoaded('attributeOptions'),function (){
                return [
                    'options' => AttributeOptionResource::collection($this->resource->attributeOptions)
                ];
            })
        ];
    }
}
