<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoucherBranch extends Model
{
    use HasFactory ,SoftDeletes;
    protected $table = 'voucher_branch';
    protected $fillable = ['voucher_id', 'branch_id'];
}
