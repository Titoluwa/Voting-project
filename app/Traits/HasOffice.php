<?php

namespace App\Traits;

use App\Office;

trait HasOffice 
{
    public function offices()
    {
        return $this->belongsToMany(Office::class,'users_offices');
    }
    
}