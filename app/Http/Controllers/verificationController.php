<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\certificate;

class verificationController extends Controller
{
    public function index(){
        $certificate = certificate::first();
        return view('content.user.verification', [
            'certificate' => $certificate
        ]);
    }

    public function find($number){
        $certificate = certificate::where('number', $number)->first();

        return response()->json([              
        'OUT_STAT' => true,
        'MESSAGE' => 'Success Get Data.',
        'DATA' => $certificate
        ]);
    }
}
