<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegMail;

class RegistrationController extends Controller
{
    public function index()
    {
        $faculty = DB::table('department')->selectRaw('faculty')->groupBy('faculty')->get();
        $user = new User();
        return view('registration', compact('user','faculty'));
    }
    public function fetch(Request $request){
        $value = $request->get('value');
        $dept = DB::table('department')->select('department')->where('faculty', $value)->groupBy('department')->get();
        $output = '<option value="" selected disabled hidden> Select Department </option>';
        foreach($dept as $d){
            $output .= '<option value="' .$d->department.'">' .$d->department.' </option>';
        }
        echo $output;
    }
    public function store(Request $request)
    {
        $user = User::create($this->validateRequest());
        $user->role = 1;
        $user->last_name = Str::ucfirst($request->last_name);
        $user->first_name = Str::ucfirst($request->first_name);
        $user->password = Hash::make($request->password);
        $user->save();

        $email = $request->email;
        // Mail::to($email)->send(new UserRegMail($user));

        return redirect('login');
    }
    private function validateRequest(){
        return request()->validate([
            'matric_no' => 'required|string|max:12|min:12|unique:users',
            'email' => 'required|email|max:30|unique:users',
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'faculty' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'level' => 'required|integer',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }
}
