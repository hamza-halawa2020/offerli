<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAboutDeal extends Model
{

    use HasFactory;
    protected $table = 'services_about_deals';

    protected $fillable = [
        'answer',
        'question',
        'service_id',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
