<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
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

    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest:admin');
        $this->middleware('guest:student');
        $this->middleware('guest:teacher');
    }



    public function showRegisterForm(){
        return view("auth.register");
    }


    protected function register(Request $req)
    {   
        $this->validate($req, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            "phone"=>["required","string"],
            "department_id"=>"required"
        ]);
        Student::create([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'roll' => $req->roll,
            'department_id' => $req->department_id,
            'password' => Hash::make($req->password),
        ]);
       return redirect(route("login.student"));
    }
}
