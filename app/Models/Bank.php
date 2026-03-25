<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'bank_code',
        'bank_name',
        'branch',
        'ifsc_code',
        'micr_code',
        'bank_type',
        'company_ifsc_code',
        'company_micr_code',
        'company_account_number',
        'status',
    ];
}
