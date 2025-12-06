<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'department',
        'position',
        'qualification',
        'salary',
        'date_of_joining',
        'status'
    ];

    protected $table = 'staff'; // Explicitly define table name

    public function leaves()
    {
        return $this->morphMany(Leave::class, 'applicant');
    }
}