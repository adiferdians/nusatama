<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function Auth(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            session()->put('name', $user->name);

            return redirect()->intended('dashboard')
            ->withSuccess('Signed in');
        }
  
        return redirect("/")->withErrors('Login details are not valid');
    }

    public function out(){
        Auth::logout();
  
        return Redirect('/');
    }
}
