<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\certificate;

class CertificateController extends Controller
{
    public function index()
    {
        $certificate = certificate::all()->sortBy('id');
        return view('content.certificate.certificate', [
            'certificate' => $certificate
        ]);
    }

    function create()
    {
        return view("content.certificate.certificateInput");
    }

    function send(Request $request, $id)
    {
        if($id){
            $data = certificate::find($id);
            $data->name = $request->name;
            $data->title = $request->title;
            $data->type = $request->type;
            $data->number = $request->number;
            $data->start = $request->start;
            $data->end = $request->end;
            $data->date = $request->date;
            $data->save();
        } else {
            $data = new certificate();
            $data->name = $request->name;
            $data->title = $request->title;
            $data->type = $request->type;
            $data->number = $request->number;
            $data->start = $request->start;
            $data->end = $request->end;
            $data->date = $request->date;
            $data->save();
        }
    }

    public function getUpdate($id)
    {
        $certificate = certificate::where('id', $id)->get();
        return view('content.certificate.certificateUpdate', [
            'certificate' => $certificate
        ]);
    }

    public function detil($id)
    {
        $certificate = certificate::where('id', $id)->get();
        return view('content.certificate.certificateView', [
            'certificate' => $certificate
        ]);
    }

    public function delete($id)
    {
        $data = new certificate();
        $data->where('id', $id)->delete();
    }
}
