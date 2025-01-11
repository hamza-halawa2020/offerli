<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'invoice_number', 'total_price', 'cash_total', 'credit_total', 'cash_orders', 'credit_orders', 'offerli_commission', 'bank_commission', 'paid'
    ];
    public function getRouteKeyName()
    {
        return 'invoice_number';
    }
    public function customervoucher()
    {
        return $this->hasMany(CustomerVoucher::class, 'payment_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
