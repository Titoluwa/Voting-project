<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {

        return view('admin/index');
    }
}
