<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
        //
    }

    public function authenticate(Request $request)
    {

        $request->validate([
            'username'=>'required',
            'password'=>'required|min:5',
        ]);

 
        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->regenerate();
            return redirect()->intended('/index');
        }else{
            return back()->with('gagal','User dan password tidak ditemukan');
        }
    }

    public function logout(Request $request){
       
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');

    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
}