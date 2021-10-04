<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'matric_no' => ['required', 'string', 'max:12', 'min:12', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:40', 'unique:users'],
            'last_name' => ['required', 'string', 'max:100'],
            'first_name' => ['required', 'string', 'max:100'],
            'faculty' => ['required', 'string', 'max:100'],
            'department' => ['required', 'string', 'max:100'],
            'level' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        

        return User::create([
            'email' => $data['email'],
            'matric_no' => $data['matric_no'],
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'level' => $data['level'],
            'faculty' => $data['faculty'],
            'department' => $data['department'],
            'password' => Hash::make($data['password']),
        ]);
        $faculty = DB::table('department')->groupBy('faculty')->get();
        $user = new User();
        return view('admin/users/create', compact('user','faculty'));
    }
    public function fetch(Request $request){
        $value = $request->get('value');
        $dept = DB::table('department')->where('faculty', $value)->groupBy('department')->get();
        $output = '<option value="" selected disabled hidden> Select Department </option>';
        foreach($dept as $d){
            $output .= '<option value="' .$d->department.'">' .$d->department.' </option>';
        }
        echo $output;
    }
}
