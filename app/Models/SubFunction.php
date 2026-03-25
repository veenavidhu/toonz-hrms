<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFunction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_function_name',
        'sub_function_code',
        'head_id',
        'status',
    ];

    public function head()
    {
        return $this->belongsTo(User::class, 'head_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
