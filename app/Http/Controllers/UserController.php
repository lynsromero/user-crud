<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\fileExists;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()) {
            return redirect('/');
        }

        $users = User::paginate(15);
        $search = $request->search;
        if ($search) {

            $users = User::where('first_name', 'LIKE', '%' . $search . '%')
                ->orwhere('last_name', 'LIKE', '%' . $search . '%')
                ->orwhere('email', 'LIKE', '%' . $search . '%')
                ->orwhere('mo_no', 'LIKE', '%' . $search . '%')
                ->orwhere('gender', 'LIKE', '%' . $search . '%')
                ->paginate(5);
        }

        return view('userlist', compact('users', 'search'));
    }

    public function create(Request $request)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        return view('user-create');
    }
    public function store(UserValidate $request)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $image = $request->file('image');
        if ($image) {
            $img_name = time() . rand(10000, 100000) . $image->getClientOriginalName();
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
        $user->hobby = ($request->hobby) ? implode(' , ', $request->hobby) : null;
        $user->image = isset($img_name) ? $img_name : null;
        $user->save();
        return redirect('user/list');
    }



    public function edit($id)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find($id);

        return view('user-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find($id);
        $image = $request->file('image');
        if ($image) {
            if ($user->image && file_exists($user->image)) {
                unlink($user->image);
            }
            $img_name = time() . rand(10000, 100000) . $image->getClientOriginalName();
            $image->storeAs('images', $img_name, 'public');
            $img_name = 'storage/images/' . $img_name;
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mo_no = $request->mo_no;
        $user->image = isset($img_name) ? $img_name : $user->image;
        $user->save();
        return redirect('user/list');
    }

    public function destroy($id)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find($id);
        if ($user->image && file_exists($user->image)) {
            unlink($user->image);
        }
        $user->delete();
        return redirect('user/list');
    }
}
