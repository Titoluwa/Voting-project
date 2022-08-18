<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Candidate;
use App\User;
use App\Office;
use App\Votes;
use App\ElectionYear;
use Carbon\Carbon;

class UserHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }
    public function index()
    {
        return view('user/index');
    }
    public function results()
    {
        $year = ElectionYear::where('status', 1)->first();
        $votes = Votes::all();
        $offices = Office::all();
        $candidates = Candidate::all();
        
        if($year == null)
        {
            $endDate = null;
            $currentdate = Carbon::now();
            $end_date_check = null;
        } else{
            //To check the date for election voting. 
            $endDate = $year->end_date;
            // $currentdate = Carbon::createFromFormat('d/m/Y', '1/10/2021');
            $currentdate = Carbon::now();
            $end_date_check = $currentdate->lt($endDate);
        }
        
        return view('user/results', compact('offices','votes','candidates', 'year', 'end_date_check'));
    }
}
