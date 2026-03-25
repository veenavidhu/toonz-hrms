<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $fillable = [
        'year_type',
        'start_date',
        'year_name',
        'ou_based_selection',
        'company_id',
        'pay_calc_status',
        'status',
        'created_by',
    ];

    protected $casts = [
        'start_date'      => 'date',
        'pay_calc_status' => 'boolean',
        'status'          => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
