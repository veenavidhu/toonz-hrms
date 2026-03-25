<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBusinessUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_business_unit_name',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
