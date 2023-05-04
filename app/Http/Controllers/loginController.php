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
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            session()->put('name', $user->name);
            $token =  $user->createToken($date)->accessToken;

            $response = [
                'user'  => $user,
                'token' => $token,
            ];

            return response()->json([
                'OUT_STAT' => true,
                'MESSAGE' => 'Anda berhasil login.',
                'DATA' => $response,
            ]);
        } else {
            return response()->json(['MESSAGE' => 'Data yang anda masukan tidak Valid']);
        }
    }

    public function out(Request $request)
    {
        Auth::logout();
        return response()->json([
            'OUT_STAT' => true,
            'MESSAGE' => 'Anda berhasil Log Out.',
        ]);
    }
}
