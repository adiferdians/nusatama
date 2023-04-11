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

    public function find($number)
    {
        $certificate = certificate::where('number', $number)->first();

        if ($certificate) {
            return response()->json([
                'OUT_STAT' => true,
                'MESSAGE' => 'Success mendapatkan data peserta',
                'DATA' => $certificate
            ]);
        }

        return response()->json([
            'OUT_STAT' => false,
            'MESSAGE' => 'Data peserta tidak valid',
        ]);
    }
}
