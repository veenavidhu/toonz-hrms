<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicRole extends Model
{
    protected $fillable = [
        'name',
        'effective_date',
        'status',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
