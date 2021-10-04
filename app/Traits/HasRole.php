<?php

namespace App\Traits;

use App\Role;

trait HasRole 
{
    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }
    
}