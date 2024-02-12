<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'token' => $this->resource->token,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'phone' => $this->resource->mobile_no,
            'abilities' => $this->resource->abilities,
        ];
    }
}
