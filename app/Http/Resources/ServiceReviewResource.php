<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceReviewResource extends JsonResource
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
            'review' => $this->review,
            'comment' => $this->comment,
            'customer' => [
                'id' => $this->customer->id,
                'name' => $this->customer->name,  // Only return specific customer details
                'email' => $this->customer->email, // Optional: Include only necessary fields
            ],
            'created_at' => $this->created_at,
        ];
    }
}
