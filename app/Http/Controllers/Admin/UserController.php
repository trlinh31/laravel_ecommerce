<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.pages.user.index', compact('users'));
    }

    public function lock($id)
    {
        $user = User::find($id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        toast('Update user successfull!', 'success');
        return redirect()->back();
    }

    public function create()
    {
        return view('admin.pages.user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'avatar' => 'image|max:2048',
            'email' =>  'required|email|unique:users',
            'password' => 'required|min:4|confirmed',
            'role' => 'required'
        ]);
        $user = new User();
        $user->name = $validatedData['name'];
        if ($request->hasFile('avatar')) {
            $avatar_name = time() . '.' . $request->file('avatar')->extension();
            $user->avatar = $avatar_name;
        }
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->save();
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move(public_path('images'), $avatar_name);
        }
        toast('Create new user successfull', 'success');
        return redirect()->route('admin.users.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.pages.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'avatar' => 'image|max:2048',
            'email' =>  'required|email',
            'role' => 'required'
        ]);
        $user = User::find($id);
        $user->name = $validatedData['name'];
        if ($request->hasFile('avatar')) {
            $avatar_name = time() . '.' . $request->file('avatar')->extension();
            $user->avatar = $avatar_name;
        }
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->save();
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move(public_path('images'), $avatar_name);
        }
        toast('Update user successfull', 'success');
        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        User::destroy($id);
        toast('Delete user successfull', 'success');
        return redirect()->route('admin.users.index');
    }
}
