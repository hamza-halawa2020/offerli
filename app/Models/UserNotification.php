<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserNotification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'status',
        'read_at',
        'image',
        'title',
        'description',
        'customer_id',
        'brand_id',
        'voucher_id',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
