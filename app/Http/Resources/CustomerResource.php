<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name_ar' => $this->name_ar,
            'email' => $this->email,
            'picture' => $this->picture,
            'phone' => $this->phone,
            'wallet' => $this->wallet,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            // 'wishlist'            => VoucherResource::collection($this->customerwishlist) ,
        ];
    }
}
