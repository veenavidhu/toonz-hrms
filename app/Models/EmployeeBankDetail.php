<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeBankDetail extends Model
{
    protected $fillable = [
        'user_id',
        'name_as_per_bank',
        'salary_bank_id',
        'salary_bank_ifsc',
        'salary_account_number',
        'reimbursement_bank_id',
        'reimbursement_bank_ifsc',
        'reimbursement_account_number',
        'payment_mode',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function salaryBank()
    {
        return $this->belongsTo(Bank::class, 'salary_bank_id');
    }

    public function reimbursementBank()
    {
        return $this->belongsTo(Bank::class, 'reimbursement_bank_id');
    }
}
