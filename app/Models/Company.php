<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_logo',
        'company_address',
        'country_id',
        'state_id',
        'city_id',
        'postal_code',
        'phone_no',
        'fax_no',
        'pf_no',
        'esi_no',
        'pan_no',
        'tan_no',
        'tds_circle',
        'uen',
        'gst_no',
        'registration_no',
        'lst_no',
        'cst_no',
        'service_tax_no',
        'email_id',
        'website',
        'reg_address',
        'reg_city',
        'reg_pin_no',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function cityModel() // Using cityModel since city_id might clash with reg_city if methods named loosely
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
