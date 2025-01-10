<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource
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
            'brand_id' => $this->brand_id,
            'price' => $this->price,
            'discount' =>  $this->discount,
            'expire_at' => $this->expire_at,
            'active' => $this->active,
            'payment_id' => $this->payment_id,
            'limit' => $this->limit,
            'subcategory_id' => $this->subcategory_id,
            'category_id' => $this->subcategory->category->id,
        ];
    }
}
