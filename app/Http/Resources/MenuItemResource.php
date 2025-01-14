<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            //'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price_per_person,
            'minSpend' => $this->min_spend,
            'thumbnail' => $this->thumbnail,
            'cuisines' => CuisineResource::collection($this->cuisines),
        ];
    }
}
