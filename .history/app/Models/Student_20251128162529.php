<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'class',
        'section',
        'parent_name',
        'parent_phone',
        'address',
        'date_of_birth',
        'status'
    ];

    protected $table = 'students'; // Explicitly define table name

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function leaves()
    {
        return $this->morphMany(Leave::class, 'applicant');
    }
}