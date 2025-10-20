<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {   
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $request->session()->regenerate(); 
            return redirect('user/list');
        }
        else
        {
            dd('Creditential Not Matched');
        }
    }
    public function  logout(){
        
        Auth::logout();
        return redirect('/');
    }
}
