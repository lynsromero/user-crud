<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'first_name' => 'required|max:20|min:3',
            'last_name' => 'required|max:20|min:3',
            'email' =>'email|unique:users',
            'password' => 'required|min:6|max:10',
            'mo_no' => 'required|integer|digits:11'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->mo_no = $request->mo_no;
        $user->save();
        return redirect('/');
    }
}
