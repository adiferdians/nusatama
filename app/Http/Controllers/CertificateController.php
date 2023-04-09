<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\certificate;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer;



class CertificateController extends Controller
{
    public function index()
    {
        $certificate = certificate::all()->sortBy('id');
        return view('content.admin.certificate.certificate', [
            'certificate' => $certificate
        ]);
    }

    function create()
    {
        return view("content.admin.certificate.certificateInput");
    }

    function send(Request $request, $id)
    {
        if ($id) {
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
        return view('content.admin.certificate.certificateUpdate', [
            'certificate' => $certificate
        ]);
    }

    public function detil($id)
    {
        $certificate = certificate::where('id', $id)->get();
        return view('content.admin.certificate.certificateView', [
            'certificate' => $certificate
        ]);
    }

    public function delete($id)
    {
        $data = new certificate();
        $data->where('id', $id)->delete();
    }


    public function generateQrCode()
    {
        // Menyiapkan QR code renderer
        $renderer = new ImageRenderer(
            new Png(),
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(400),
            new \BaconQrCode\Renderer\Color\Rgb(0, 0, 0),
            new \BaconQrCode\Renderer\Color\Rgb(255, 255, 255)
        );

        // Menyiapkan QR code writer
        $writer = new Writer($renderer);

        // Menghasilkan QR code
        $qrCode = $writer->writeString("sapi");

        // Menampilkan QR code ke browser
        header('Content-Type: image/png');
        echo $qrCode;
    }
}
