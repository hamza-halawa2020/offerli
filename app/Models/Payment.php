<?php

namespace App\Models;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory ,SoftDeletes;
    public function customervoucher()
    {
        return $this->hasMany(CustomerVoucher::class,'payment_id');
    }
    public function vouchers()
    {
        return $this->hasMany(Voucher::class,'payment_id');
    }
}
