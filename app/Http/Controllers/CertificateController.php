<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\certificate;
use App\Models\type;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class CertificateController extends Controller
{
    public function index()
    {
        $certificate = certificate::orderBy('id')->paginate(10);
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


    public function generateQrCode($phrase)
    {
        $qrCode = QrCode::format('svg')
            ->size(300)
            ->errorCorrection('H')
            ->generate($phrase);

        return response()->json([
            'DATA' => base64_encode($qrCode)
        ]);
    }

    function createType()
    {
        return view("content.admin.certificate.typetraining");
    }

    public function sendType(Request $request){
        DB::beginTransaction();
        try {

            $data[] = [
                'type' => $request->type,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
            dd($data);
            type::insert($data);
            DB::commit();

            return response()->json(['success' => true, 'message' => 'data berhasil diinputkan', 'data' => $data], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['success' => false, 'messages' => $e->getMessage()], 400);
        }
    }
}
