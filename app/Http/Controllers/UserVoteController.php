<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\User;
use App\Office;
use App\ElectionYear;
use App\Votes;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserVoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }
    public function index()
    {
        $offices = Office::all();
        $candidates = Candidate::all();
        $election_year = ElectionYear::where('status', 1)->first();
        $year = ElectionYear::where('status', 1)->pluck('id')->first();
        $votes = Votes::all();
    
        if($election_year == null OR $year == null)
        {
            $offices = null;
            $startDate = NULL;
            $endDate = null;
            $currentdate = Carbon::now();
            $start_date_check = null;
            $end_date_check = null;
            
            $id = Auth::user()->id;
            $candi_voted =  null;
            $officers = array();
        } else
        {
            $offices = Candidate::where('election_year_id', $year)->select('office_id')->groupBy('office_id')->get();

            //To check the date for election voting. 
            $startDate = $election_year->start_date;
            $endDate = $election_year->end_date;
            // $currentdate = Carbon::createFromFormat('d-m-Y', '30-09-2021');
            $currentdate = Carbon::now();
            $start_date_check = $currentdate->lte($startDate);
            $end_date_check = $currentdate->gt($endDate);
            
            //  To get the array of offices the user has voted for.
            $id = Auth::user()->id;
            $candi_voted =  $votes->where('election_year_id', $year)->where('user_id', $id)->pluck('candidate_id')->all(); // array of office id the user has voted for.
            $officers = array();
            foreach($candi_voted as $cv){
                $off = $candidates->where('id', $cv)->pluck('office_id')->first();
                array_push($officers, $off);
            }
        }
       
        return view('user/vote', compact(
            'offices','officers','election_year','candidates',
            'votes','id','candi_voted',
            'currentdate','end_date_check','start_date_check'));
    }
    public function fetch(Request $request){
        $value = $request->get('value');
        $candidate = Candidate::where('office_id', $value)->get();
        $year = ElectionYear::where('status', 1)->first();
        $output = '<div class="card border-primary shadow"><div class="card-body"><div><h4 class="p-2 text-primary">';
        foreach($candidate as $c){
            $output .= 'Candidates for '.$c->office->position.'<div class="form-check"></div></h4>';
            break;
        }
        foreach($candidate as $c){
            $output .= '<div class="form-check">
            <input class="form-check-input" type="radio" name="candidate_id" value="'.$c->id.'" id="'.$c->id.'">
            <label class="form-check-label" for="'.$c->id.'">
            '.$c->user->last_name.' '. $c->user->first_name.'</label> <br></div>';
        }
        $output .= '<div class="float-right"> <button type="submit" class="btn btn-lg btn-outline-primary">VOTE</button></div></div></div>';
        
        echo $output;
    }
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $year = ElectionYear::where('status', 1)->pluck('id')->first();
        $vote = new Votes();
        $vote->user_id = $id;
        $vote->candidate_id = ($request->candidate_id);
        $vote->election_year_id = $year;
        $vote->save();

        return back();
    }
}
