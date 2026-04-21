<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => (float) $this->price,
            'category' => $this->category->name,
            'in_stock' => $this->in_stock,
            'rating' => $this->rating,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
