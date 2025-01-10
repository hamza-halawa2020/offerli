<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerVoucher extends Model
{
    use HasFactory ,SoftDeletes;
    protected $table = 'customer_voucher';
    protected $fillable = ['customer_id', 'voucher_id','payment_id','expire_at',
    'invoice_id','paid_price','rating','rating_comment','status_id','branch_id', 'code'];
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
