<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['type', 'description', 'causer_id', 'causer_type', 'ip_address'];
    
    public function causer()
    {
        return $this->morphTo();
    }
    
    public function getIconAttribute()
    {
        $icons = [
            'login' => 'sign-in-alt',
            'create' => 'plus-circle',
            'update' => 'edit',
            'delete' => 'trash',
            'system' => 'cog'
        ];
        
        return $icons[$this->type] ?? 'info-circle';
    }
}