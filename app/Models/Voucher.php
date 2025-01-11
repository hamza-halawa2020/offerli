<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['code', 'discount', 'limit', 'title', 'start_at', 'description', 'expire_at', 'price', 'brand_id', 'slug', 'active', 'subcategory_id', 'payment_id'];
    protected $casts = [
        'expire_at' => 'datetime', 'start_at' => 'datetime'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'coupon_branch');
    }
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_coupon');
    }
}
