<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    const ROLE_HR = 'HR';
    const ROLE_ADMIN = 'Admin';
    const ROLE_SUPER_ADMIN = 'Super Admin';
    const ROLE_EMPLOYEE = 'Employee';
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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

    public function functionSupervisor()
    {
        return $this->belongsTo(User::class, 'function_supervisor_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function bankDetails()
    {
        return $this->hasOne(EmployeeBankDetail::class);
    }
}
