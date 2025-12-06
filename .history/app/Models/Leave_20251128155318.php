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

    public function applicant()
    {
        return $this->morphTo();
    }
}