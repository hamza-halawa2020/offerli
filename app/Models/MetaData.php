<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    use HasFactory;
    protected $fillable =['name' ,'name_ar' ,'address' ,'email' ,'bank_commission' ,'vat_no' ,'Com_Reg_No' ,'IOS_Link' ,'Android_Link' ] ;

}
