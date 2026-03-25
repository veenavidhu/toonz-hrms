<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation_code',
        'designation_name',
        'about_designation',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
