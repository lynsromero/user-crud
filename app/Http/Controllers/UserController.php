<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()) {
            return redirect('/');
        }

        $search = $request->search;
        $users = User::paginate(15);
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
        return view('user-create');
    }
    public function store(UserValidate $request)
    {
        $user = new User();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->mo_no = $request->mo_no;
        $user->save();
        return redirect('user/list');
    }



    public function edit($id)
    {
        $user = User::find($id);

        return view('user-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->hasFile('image')) {
            if ($user->image) {
                $oldImagePath = public_path('images') . '/' . $user->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mo_no = $request->mo_no;
        $user->save();
        return redirect('user/list');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('user/list');
    }

    public function show($id)
    {
        dd($id, "show");
    }

    public function search(Request $request)
    {

        $search = $request->search;
        $users = User::paginate(5);

        if ($search != '') {

            $users = User::where('first_name', 'LIKE', '%' . $search . '%')
                ->orwhere('last_name', 'LIKE', '%' . $search . '%')
                ->orwhere('email', 'LIKE', '%' . $search . '%')
                ->orwhere('mo_no', 'LIKE', '%' . $search . '%')
                ->orwhere('gender', 'LIKE', '%' . $search . '%')
                ->paginate(5);
        }
        return view('userlist', compact('users'));
    }
}
