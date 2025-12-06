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

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $attributes = [
        'status' => 'active'
    ];

    // Relationship with Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Check if user has a specific permission
    public function hasPermission($permission)
    {
        if (!$this->role) {
            return false;
        }
        
        return $this->role->hasPermission($permission);
    }

    // Check if user has any of the given permissions
    public function hasAnyPermission($permissions)
    {
        if (!$this->role) {
            return false;
        }

        foreach ($permissions as $permission) {
            if ($this->role->hasPermission($permission)) {
                return true;
            }
        }
        
        return false;
    }

    // Scope for users without role
    public function scopeWithoutRole($query)
    {
        return $query->whereNull('role_id');
    }

    // Scope for users with specific role
    public function scopeWithRole($query, $roleId)
    {
        return $query->where('role_id', $roleId);
    }
}