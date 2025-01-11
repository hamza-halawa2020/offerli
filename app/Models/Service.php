<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'mainImage',
        'description',
        'priceBeforeDiscount',
        'discount',
        'priceAfterDiscount',
        'mainAddress',
        'highlight',
        'reserve',
        'sub_category_id',
        'brand_id',


    ];
    public function customerFavourites()
    {
        return $this->hasMany(CustomerFavourite::class);
    }
    public function locations()
    {
        return $this->hasMany(ServiceLocation::class);
    }
    public function reviews()
    {
        return $this->hasMany(ServiceReview::class);
    }
    // Calculate the average review rating
    public function averageRating()
    {
        return $this->reviews()->avg('review') ?: 0;
    }

    // Calculate the number of reviews
    public function reviewCount()
    {
        return $this->reviews()->count();
    }

    // Get a breakdown of reviews by star rating
    public function reviewBreakdown()
    {
        return $this->reviews()
            ->selectRaw('review, COUNT(*) as count')
            ->groupBy('review')
            ->pluck('count', 'review');
    }
    public function aboutDeals()
    {
        return $this->hasMany(ServiceAboutDeal::class);
    }
    public function images()
    {
        return $this->hasMany(ServiceImage::class);
    }
    public function offersServices()
    {
        return $this->hasMany(OffersService::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


}
