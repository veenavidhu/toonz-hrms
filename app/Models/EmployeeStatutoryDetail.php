<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeStatutoryDetail extends Model
{
    protected $fillable = [
        'user_id',
        'uan_no',
        'pf_no',
        'esi_no',
        'lwf_no',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
