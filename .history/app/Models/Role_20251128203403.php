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

    // Relationship with Users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Check if role has a specific permission
    public function hasPermission($permission)
    {
        if (in_array('all', $this->permissions)) {
            return true;
        }
        
        return in_array($permission, $this->permissions);
    }

    // Add a permission to the role
    public function addPermission($permission)
    {
        $permissions = $this->permissions ?? [];
        if (!in_array($permission, $permissions)) {
            $permissions[] = $permission;
            $this->permissions = $permissions;
        }
        return $this;
    }

    // Remove a permission from the role
    public function removePermission($permission)
    {
        $permissions = $this->permissions ?? [];
        $key = array_search($permission, $permissions);
        if ($key !== false) {
            unset($permissions[$key]);
            $this->permissions = array_values($permissions);
        }
        return $this;
    }
}