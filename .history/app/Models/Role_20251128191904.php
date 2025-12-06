<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'permissions',
        'users_count',
        'is_system'
    ];

    protected $casts = [
        'permissions' => 'array',
        'is_system' => 'boolean'
    ];
}