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
            'id'           => $this->id,
            'name'         => $this->name,
            'product_code' => $this->product_code,
            'category'     => $this->category,
            'description'  => $this->description,
            'price'        => $this->price,
            'quantity'     => $this->quantity,
            'status'       => $this->status,
            'images'       => ProductImageResource::collection($this->whenLoaded('images')),
            'created_at'   => $this->created_at->toDateTimeString(),
            'updated_at'   => $this->updated_at->toDateTimeString(),
        ];
    }
}
