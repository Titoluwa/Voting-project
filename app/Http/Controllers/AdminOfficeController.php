<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;

class AdminOfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $offices = Office::orderBy('id','desc')->get();
        return view('admin/office/index', compact('offices'));
    }
    
    public function store(Request $request)
    {
        $office = new Office();
        $office->position = ($request->position);
        $office->save();
        
        return back();
    }

    public function destroy($id)
    {
        $office = Office::findOrFail($id);
        $office->delete();
        return response()->json(['status'=>"Office Record Deleted Successfully!"]);
    }
}
