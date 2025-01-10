<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffersService extends Model
{
    use HasFactory;

    protected $table = 'offers_services';


    protected $fillable = [
        'name_ar',
        'name_en',
        'priceBeforeDiscount',
        'discount',
        'priceAfterDiscount',
        'service_id',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
