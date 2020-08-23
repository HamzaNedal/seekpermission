<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginEmployee extends Controller
{
    public function login(Request $request )
    {
        // $request = $request->all();
        // dd($request);
        $emp = Employee::where('email',$request->email)->first();
        if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $details = Auth::guard('employee')->user();
           return redirect()->route('dashboard');
        } else {
            return 'auth fail';
        }
    }

    public function index(){
        return view('auth.loginEmp');
    }
}
