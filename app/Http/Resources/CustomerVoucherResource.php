<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerVoucherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'branch_id'              => $this->branch_id,
            'voucher_id'            => $this->voucher_id,
            'payment_id'        => $this->payment_id,
            'status_id'         => $this->status_id,
            'paid_price'         => $this->paid_price,
            'rating'         => $this->rating,
        ];
    }
}
