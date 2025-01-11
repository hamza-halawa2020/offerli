<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'subcategories';
    protected $fillable = ['category_id', 'name', 'slug', 'name_ar', 'logo'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'sub_category_id');
    }

}
