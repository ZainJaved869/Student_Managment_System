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

    protected $table = 'leaves'; // Explicitly define table name

    public function applicant()
    {
        return $this->morphTo();
    }
}