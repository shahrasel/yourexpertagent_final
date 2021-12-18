<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{


    public function signin(Request $request)
    {
        $user_info = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($user_info)) {
            return Redirect::back()->with('message','User Successfully Signed in');
        }
        else {
            return Redirect::back()->with('message','Invalid credential to signin');
        }
    }

    public function signup(Request $request) {
        //dd($request);

        $user_info = $request->validate([
            'first_name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'age' => ['required'],
            'marital_status' => ['required'],
            'have_children' => ['required'],
            'profession' => ['required'],

        ]);

        //dd($user_info);


        $parts = explode(" ", $request->input('first_name'));
        $lastname = array_pop($parts);
        $firstname = implode(" ", $parts);

        $user_info['last_name'] = $lastname;

        $user = new User();
        $user->first_name = $firstname;
        $user->last_name = $lastname;
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->age = $request->input('age');
        $user->marital_status = $request->input('marital_status');
        $user->have_children = $request->input('have_children');
        $user->profession = $request->input('profession');

        $user->save();

        return Redirect::back()->with('message','User Successfully Signed up!');

    }

    public function profile()
    {
        if(Auth::check()) {
            return view('profile', [
                'user_info' => Auth::user()
            ]);
        }
        else {
            return Redirect::back()->with('message','User is not signed in!');
        }
    }

    public function signout()
    {
        Auth::logout();
        return Redirect::back()->with('message','User Successfully Signed out');
    }
}
