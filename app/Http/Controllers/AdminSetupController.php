<?php

namespace App\Http\Controllers;

use App\ElectionYear;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminSetupController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {   
        $current_year = Carbon::now()->year;
        $previous_year = (int)$current_year-1;
        $election_year = ElectionYear::orderBy('id', 'DESC')->get();
        return view('admin.setup.index', compact('election_year', 'previous_year','current_year'));
    }
    public function store(Request $request)
    {
        ElectionYear::where('status', 1)->update(['status'=> 0]);
        $setup = new ElectionYear();
        $setup->year = ($request->year);
        $setup->start_date = ($request->start_date);
        $setup->end_date = ($request->end_date);
        $setup->save();
        return redirect('admin/setup')->with('message',"$request->year has been added and set!");
    }
    public function edit(ElectionYear  $setup)
    {
        return view("admin.setup.edit", compact('setup'));
    }
    public function update(Request $request, ElectionYear  $setup)
    {
        $setup->year = ($request->year);
        $setup->start_date = ($request->start_date);
        $setup->end_date = ($request->end_date);
        $setup->update();
        return redirect("admin/setup/". $setup->id ."/edit")->with('message',"$request->year election date has been Updated!");; 
    }
    
}
