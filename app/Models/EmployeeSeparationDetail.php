<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSeparationDetail extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'date_of_leaving',
        'leaving_reason',
        'date_of_settlement',
        'date_of_resignation',
        'contract_start_date',
        'contract_end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
