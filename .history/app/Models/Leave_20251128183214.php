<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'applicant_type',
        'leave_type',
        'start_date',
        'end_date',
        'reason',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function applicant()
    {
        return $this->morphTo();
    }

    // Accessor for applicant name
    public function getApplicantNameAttribute()
    {
        return $this->applicant ? $this->applicant->first_name . ' ' . $this->applicant->last_name : 'N/A';
    }

    // Accessor for applicant type (human readable)
    public function getApplicantTypeNameAttribute()
    {
        return $this->applicant_type === 'App\\Models\\Student' ? 'Student' : 'Staff';
    }

    // Calculate total days
    public function getTotalDaysAttribute()
    {
        return $this->start_date->diffInDays($this->end_date) + 1;
    }

    // Check if leave is pending
    public function getIsPendingAttribute()
    {
        return $this->status === 'pending';
    }

    // Check if leave is approved
    public function getIsApprovedAttribute()
    {
        return $this->status === 'approved';
    }

    // Check if leave is rejected
    public function getIsRejectedAttribute()
    {
        return $this->status === 'rejected';
    }
}