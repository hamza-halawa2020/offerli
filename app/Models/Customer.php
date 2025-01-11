<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerVoucher;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $fillable = ['name', 'email', 'password', 'address', 'name_ar', 'latitude', 'longitude', 'blocked_until', 'phone', 'device_token', 'picture', 'slug', 'blocked'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'blocked_until' => 'datetime',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function customervoucherredeemed()
    {
        return $this->hasMany(CustomerVoucher::class)->where('status_id', 2)->get();
    }
    public function customerwishlist()
    {
        return $this->hasManyThrough(Voucher::class, CustomerWishlist::class, 'customer_id', 'id', 'id', 'voucher_id');
    }
    public function customervoucher()
    {
        return $this->hasMany(CustomerVoucher::class);
    }
    public function vouchers()
    {
        return $this->belongsToMany(Voucher::class, 'customer_voucher');
    }
    public function serviceReview()
    {
        return $this->hasMany(ServiceReview::class);
    }

    public function customerFavourites()
    {
        return $this->hasMany(CustomerFavourite::class);
    }

    public function userNotification()
    {
        return $this->hasMany(UserNotification::class);
    }

}
