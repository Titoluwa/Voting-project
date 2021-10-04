<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        // $users = User::all();
        $users = User::where('role', 2)->orderBy('last_name', 'asc')->get(); //all user that is not admin
        return view('admin/users/index', compact('users'));
    }

    public function create()
    {
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
        // {{ $user->department == '.$d->department.' ? "selected": " "}}
    }
    public function store(Request $request)
    {
        $user = User::create($this->validateRequest()); 
        $user->last_name = Str::ucfirst($request->last_name);
        $user->first_name = Str::ucfirst($request->first_name);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('admin/users');
    }


    public function show(User $user)
    {
        return view("admin/users/show", compact('user'));
    }

    public function edit(User $user)
    {
        $faculty = DB::table('department')->groupBy('faculty')->get();
        return view("admin/users/edit", compact('user','faculty'));
    }

    public function update(Request $request, User $user)
    {
        $user->matric_no = Str::upper($request->matric_no);
        $user->email = ($request->email);   
        $user->last_name = Str::ucfirst($request->last_name);
        $user->first_name = Str::ucfirst($request->first_name);
        $user->faculty = ($request->faculty);
        $user->department = ($request->department);
        $user->level = $request->level;   
        $user->update();
        return redirect("admin/users/". $user->id);
        
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status'=>"Student Record Deleted Successfully!"]);
    
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