<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function create(Request $request) {
        //Validate inputs
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:30'
        ]);

        //Create new user
        $user = new User();
        $user->first_name = $request->fname;
        $user->last_name = $request->lname;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return redirect()->back()->with('success', 'Registration successful, proceed to login');
        } else {
            return redirect()->back()->with('fail', 'Oops! Something went wrong, please try again');
        }
    }

    function check(Request $request) {
        //Validate inputs
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'Email is not registered'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->route('user.login')->with('fail', 'Email or password is incorrect');
        }
    }

    function logout() {
        //Log users out
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
