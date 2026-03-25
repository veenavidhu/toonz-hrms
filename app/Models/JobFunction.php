<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobFunction extends Model
{
    protected $fillable = [
        'function_name',
        'function_code',
        'description',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
