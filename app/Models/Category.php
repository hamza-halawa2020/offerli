<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = ['name','slug','name_ar','logo'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
