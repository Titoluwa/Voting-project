<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Votes;
use App\Office;
use App\Candidate;
use App\ElectionYear;

class AdminVotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {   
        
        $offices = Office::all();

        $election_year = ElectionYear::where('status', 1)->first(); // only the set year will display

        if($election_year == null)
        {
            $election_year = null;
            $setyear = null;            
        } else
        {
            $election_year = $election_year;
            $setyear = ElectionYear::where('status', 1)->pluck('id')->first();
        }

        $votes = Votes::where('election_year_id', $setyear)->get();
        $candidates = Candidate::where('election_year_id', $setyear)->get();
        $winners = Candidate::where('election_year_id', $setyear)->where('success_flag', 1)->get();


        return view('admin/votes/index', compact('votes', 'offices', 'candidates', 'election_year', 'winners'));
    }
    public function store(Request $request)
    {
        $winner = Candidate::where('id', ($request->candidate_id))->first();
        $winner->success_flag = 1;
        $winner->save();
        return back();
    }
}
