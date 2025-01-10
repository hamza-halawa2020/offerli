<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'slug' => $this->slug,
            'email' => $this->email,
            'percentage' => $this->percentage,
            'other_fee' => $this->other_fee,
            'description' => $this->description,
            'address' => $this->address,
            'vat_no' => $this->vat_no,
            'Com_Reg_No' => $this->Com_Reg_No,
            'logo' => $this->logo,
            'featured' => $this->featured,
            'phone' => $this->phone,
            'workHours' => $this->workinghours,
            'images' => ImagesResource::collection($this->images),
            'branches' => BranchResource::collection($this->branches),
        ];
    }
}
