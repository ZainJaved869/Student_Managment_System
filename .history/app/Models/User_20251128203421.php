<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship with Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Check if user has permission
    public function hasPermission($permission)
    {
        if (!$this->role) {
            return false;
        }
        
        return $this->role->hasPermission($permission);
    }

    // Check if user is administrator
    public function isAdministrator()
    {
        return $this->role && $this->role->name === 'Administrator';
    }
}