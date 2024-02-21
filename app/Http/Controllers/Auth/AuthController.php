<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' =>  'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            if (Auth::user()->status) {
                if (Auth::user()->role == 1) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect('/');
                }
            } else {
                return redirect()->back()->with('error', 'Your account is locked');
            }
        }
        toast('Email or password invalid!', 'error');
        return redirect()->back()->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function signupPost(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' =>  'required|email|unique:users',
            'password' => 'required|min:4|confirmed',
        ]);
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = 0;
        $user->save();
        Auth::login($user);
        if (Auth::user()->role == 1) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect('/');
        }
    }
}
