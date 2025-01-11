<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = ['name','latitude','longitude','phone','slug','brand_id','address','name_ar'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function vouchers()
    {
        return $this->belongsToMany(Voucher::class, 'voucher_branch');
    }

    public function customervoucher()
    {
        return $this->hasMany(CustomerVoucher::class);
    }

}
