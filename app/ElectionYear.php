<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElectionYear extends Model
{
    
    
    protected $guarded = ['id'];
    protected $dates = ['start_date', 'end_date'];
    protected $timestamp = true;
}
