<?php

namespace App;

use App\Office;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function office()
    {
        return $this->belongsTo(Office::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cand_office($office_id)
    {
        $candidates = Candidate::all();
        $offices = $candidates->pluck('office_id')->all();
        // $offices = Candidate::where('office_id', $office_id)->get();
        return $offices;
    }
    protected $guarded = ['id'];
    protected $timestamp = true;
}
