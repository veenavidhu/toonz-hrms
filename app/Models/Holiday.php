<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'holiday_name',
        'holiday_date',
        'is_mandatory',
        'status',
    ];

    protected $casts = [
        'holiday_date' => 'date',
        'is_mandatory' => 'boolean',
        'status'       => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
