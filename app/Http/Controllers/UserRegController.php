<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use App\User;
use App\Office;
use App\ElectionYear;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\CandidateRegMail;

class UserRegController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }
    public function index()
    {
        $offices = Office::all();
        $candidates = Candidate::all();
        $election_year = ElectionYear::where('status', 1)->first(); // only the set year will display

        $users = $candidates->pluck('user_id')->all(); // an array of the user-id (to have all users identification)
        $id = Auth::user()->id;

        $startDate = $election_year->start_date;
        $endDate = $election_year->end_date;
        $currentdate = Carbon::now();
        $start_date_check = $currentdate->gt($startDate);
        $end_date_check = $currentdate->gt($endDate);

        return view('user/register', compact('offices','candidates', 'election_year','id','users','end_date_check','start_date_check'));

    }
    public function store(Request $request)
    {
        $candidate = new Candidate();
        $candidate->user_id = ($request->user_id);
        $candidate->office_id = ($request->office_id);
        $candidate->election_year_id = ($request->election_year_id);
        $candidate->save();

        $email = Auth::user()->email;
        $matricno = Auth::user()->matric_no;

        Mail::to($email)->send(new CandidateRegMail($matricno));

        return back();
    }
}
