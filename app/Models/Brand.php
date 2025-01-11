<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $fillable = ['name', 'email', 'password', 'phone', 'Com_Reg_No', 'description', 'percentage', 'name_ar', 'device_token', 'address', 'logo', 'active', 'vat_no', 'other_fee', 'featured', 'slug', 'featured_until'];
    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'featured_until' => 'datetime',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
    public function images()
    {
        return $this->hasMany(BrandImages::class);
    }
    public function workinghours()
    {
        return $this->hasOne(WorkingHours::class);
    }
    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
    public function userNotification()
    {
        return $this->hasMany(UserNotification::class);
    }
}
