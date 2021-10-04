<?php

namespace App;

use App\Candidate;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
    protected $guarded = ['id'];
    protected $timestamp = true;
}
