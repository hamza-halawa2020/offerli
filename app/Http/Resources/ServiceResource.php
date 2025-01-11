<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $user = auth('customer')->user();
        $isFavourite = false;

        if ($user) {
            $isFavourite = $this->customerFavourites()->where('customer_id', $user->id)->exists();
        }

        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
            'mainImage' => $this->mainImage,
            'description' => $this->description,
            'highlight' => $this->highlight,
            'priceBeforeDiscount' => $this->priceBeforeDiscount,
            'discount' => $this->discount,
            'priceAfterDiscount' => $this->priceAfterDiscount,
            'mainAddress' => $this->mainAddress,
            'reserve' => $this->reserve,
            'isFavourite' => $isFavourite,
            'customerFavourites' => $this->customerFavourites,
            'offersServices' => $this->offersServices,
            'subCategory' => new SubCategoryResource($this->whenLoaded('subCategory')),
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'locations' => ServiceLocationResource::collection($this->whenLoaded('locations')),
            'reviews' => ServiceReviewResource::collection($this->whenLoaded('reviews')),

            'average_rating' => $this->averageRating(),
            'review_count' => $this->reviewCount(),
            'ratings_breakdown' => $this->reviewBreakdown(),
            'about_deals' => ServiceAboutDealResource::collection($this->whenLoaded('aboutDeals')),
            'images' => ServiceImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
