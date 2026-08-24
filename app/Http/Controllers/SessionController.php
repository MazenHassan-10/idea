<?php

declare(strict_types=1);

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
            'email' => ['required', 'string', 'min:3', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (! Auth::attempt($attribute)) {
            return back()->withErrors(['password' => 'not match'])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended(route('idea.index'))->with('success', 'you are now logged in.');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
