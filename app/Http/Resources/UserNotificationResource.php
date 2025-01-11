<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);


        // return [
        // 'id' => $this->id,
        //     'image' => $this->image,
        //     'title' => $this->title,
        //     'description' => $this->description,
        //     'customer_id' => $this->customer_id,
        //     'brand_id' => $this->brand_id,
        //     'created_at' => $this->created_at,
        // ];
    }
}
