<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
    use HasFactory;
    protected $table = 'services_reviews';

    protected $fillable = [
        'review',
        'comment',
        'service_id',
        'customer_id',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
