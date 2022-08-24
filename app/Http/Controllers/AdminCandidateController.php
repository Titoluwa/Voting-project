<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\User;
use App\Office;
use App\ElectionYear;
use Illuminate\Http\Request;

class AdminCandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $office = Office::first();
        $offices = Office::all();
        $users = User::where('role', 2)->orderBy('last_name','asc')->get(); //all user that is not admin
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
        $candidates = Candidate::where('election_year_id', $setyear)->get();
        
        return view('admin/candidates/index', compact('office', 'offices','candidates','users', 'election_year'));
    }
    
    public function store(Request $request)
    {
        $candidate = new Candidate();
        $candidate->user_id = ($request->user_id);
        $candidate->office_id = ($request->office_id);
        $candidate->election_year_id = ($request->election_year_id);
        $candidate->save();

        return back();
    }
    
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();
        return response()->json(['status'=>"Candidate Record Deleted Successfully!"]);
   
    }
}
