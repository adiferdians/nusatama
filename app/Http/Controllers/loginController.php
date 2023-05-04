<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function Auth(Request $request)
    {

        $date = Carbon::now()->format('H:i:s');
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            session()->put('name', $user->name);
            $token =  $user->createToken($date)->accessToken;

            $response = [
                'user'  => $user,
                'token' => $token,
            ];

            return response()->json([
                'OUT_STAT' => true,
                'MESSAGE' => 'You have successfully logged in to your account.',
                'DATA' => $response,
            ]);
        } else {
            return response()->json(['MESSAGE' => 'Invalid login credentials']);
        }
    }

    public function out(Request $request)
    {
        Auth::logout();
        $request->user()->currentAccessToken()->delete();
        return Redirect('/');
    }
}
