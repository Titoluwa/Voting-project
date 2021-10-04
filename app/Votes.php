<?php

namespace App;

use App\Candidate;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidate_vote($can_id, $year)
    {
        $vote_count = SELF::where('candidate_id', $can_id)
        ->where('election_year_id', $year)
        ->count();
        return $vote_count;
    }
    public function winner($var, $year)
    {
        $candidata = Candidate::where('election_year_id', $year)->where("office_id",$var)->pluck('id')->all();
        $setyear = ElectionYear::where('status', 1)->pluck('id')->first();
        $counts = array();
        foreach($candidata as $c){
            array_push($counts,($this->candidate_vote($c, $setyear)));
        }
        $highest = max($counts);
        return $highest;
    }
    protected $guarded = ['id'];
    protected $timestamp = true;
}
