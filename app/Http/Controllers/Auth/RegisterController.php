<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function store(UserValidate $request)
    {
   
        $image = $request->file('image');
        if($image){
            $img_name = time().rand(10000, 100000).$image->getClientOriginalName();
            $image->storeAs('images', $img_name, 'public');
            $img_name = 'storage/images/' . $img_name;
        }



        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->mo_no = $request->mo_no;
        $user->image = isset($img_name) ? $img_name : null;
        $user->save();
        return redirect('/')->with('success', 'Registerd Successfully');
    }
}
