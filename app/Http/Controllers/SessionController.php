<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attribute = $request->validate([
            'name' => ['required' , 'string' , 'min:3' , 'max:255'],
            'email' => ['required' , 'string' , 'min:3' , 'max:255']
        ]);

        if(! Auth::attempt($attribute))
        {
            return back()->withErrors(['password' => 'not match'])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended('/')->with('sucess' , 'you are now logged in.');
    }
    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
