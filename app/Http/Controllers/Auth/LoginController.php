<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
        $this->middleware('guest:teacher')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showStudentLoginForm(){
        return view("auth.login",["guard"=>"student"]);
    }

    public function showTeacherLoginForm(){
        return view("auth.login",["guard"=>"teacher"]);
    }
    public function showAdminLoginForm(){
        return view("auth.login",["guard"=>"admin"]);
    }

    public function studentLogin(Request $req){
        if (Auth::guard('student')->attempt(['email' => $req->email, 'password' => $req->password], $req->get('remember'))) {
            return redirect()->intended('/dashboard/student');
        }
        return redirect()->back();
    }

    public function teacherLogin(Request $req){
        if (Auth::guard('teacher')->attempt(['email' => $req->email, 'password' => $req->password], $req->get('remember'))) {
            return redirect()->intended('/dashboard/teacher');
        }
        return redirect()->back();
    }
    public function adminLogin(Request $req){
        if (Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password], $req->get('remember'))) {
            return redirect()->intended('/dashboard/admin');
        }
        return redirect()->back();
    }
}
