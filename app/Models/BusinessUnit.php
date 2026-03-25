<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_unit_code',
        'business_unit_name',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
