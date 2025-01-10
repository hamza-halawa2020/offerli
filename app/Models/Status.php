<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory ,SoftDeletes;
    public function customervoucher()
    {
        return $this->hasMany(CustomerVoucher::class,'payment_id');
    }
}
