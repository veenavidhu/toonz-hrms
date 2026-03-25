<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function businessUnit()
    {
        return $this->belongsTo(BusinessUnit::class);
    }

    public function subBusinessUnit()
    {
        return $this->belongsTo(SubBusinessUnit::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function jobFunction()
    {
        return $this->belongsTo(JobFunction::class, 'job_function_id');
    }

    public function subFunction()
    {
        return $this->belongsTo(SubFunction::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_master_id');
    }

    public function employeeType()
    {
        return $this->belongsTo(EmployeeType::class);
    }

    public function reportingTo()
    {
        return $this->belongsTo(User::class, 'reporting_to_id');
    }
}
