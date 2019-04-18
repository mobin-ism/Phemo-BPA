<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // protected $fillable = [
    //     'user_id', 'gender', 'bday', 'nationality', 'nid', 'passport',	'ethnicity', 'religion', 'joined_date', 'probation_date', 'position', 
    //     'effective_date', 'line_manager', 'department', 'branch', 'job_type',	'job_status', 'salary',	'salary_effective_date', 'bank', 'bank_account',
    //     'payment', 'method', 'blog', 'facebook', 'linkedin', 'whatsapp', 'personal_phone', 'office_phone', 'house_phone', 'address', 'account_id'
    // ];
    protected $table = 'employees';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function jobStatus()
    {
        return $this->belongsTo(JobStatus::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function payStatus()
    {
        return $this->belongsTo(PayStatus::class);
    }

    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    public function employment_histories()
    {
        return $this->hasMany(EmploymentHistory::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
