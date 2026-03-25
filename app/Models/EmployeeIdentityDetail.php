<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeIdentityDetail extends Model
{
    protected $fillable = [
        'user_id',
        'passport_no',
        'passport_place_of_issue',
        'passport_date_of_issue',
        'passport_expiry_date',
        'passport_address',
        'passport_attachment',
        'visa_no',
        'visa_expiry',
        'visa_attachment',
        'work_permit_no',
        'work_permit_expiry',
        'work_permit_attachment',
        'driving_licence_no',
        'driving_licence_place_of_issue',
        'driving_licence_date_of_issue',
        'driving_licence_validity',
        'driving_licence_address',
        'driving_licence_attachment',
        'aadhar_no',
        'aadhar_attachment',
        'pan_no',
        'pan_attachment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
