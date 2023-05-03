<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\certificate;

class verificationController extends Controller
{
    public function index()
    {
        return view('content.user.verification');
    }

    public function find(Request $request)
    {
        $name = strtolower($request->nama);
        $newNumber = implode("/", $request->newNumber);
            $certificate = certificate::where('number', $newNumber)->where('name', $name)->first();

        if ($certificate) {
            return response()->json([
                'OUT_STAT' => true,
                'MESSAGE' => 'Berhasil mendapatkan data peserta',
                'DATA' => $certificate
            ]);
        }

        return response()->json([
            'OUT_STAT' => false,
            'MESSAGE' => 'Data peserta tidak valid',
        ]);
    }
}
