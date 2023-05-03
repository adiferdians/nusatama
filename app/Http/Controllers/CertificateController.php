<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\certificate;
use App\Models\type;
use Carbon\Carbon;
use Validator;
use phpseclib3\File\ASN1\Maps\Certificate as MapsCertificate;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class CertificateController extends Controller
{
    public function index()
    {
        $certificate = certificate::orderByDesc('id')->paginate(10);
        return view('content.admin.certificate.certificate', [
            'certificate' => $certificate
        ]);
    }

    function create()
    {
        return view("content.admin.certificate.certificateInput");
    }

    function send(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'   => 'required',
            'title'   => 'required',
            'type'   => 'required',
            'start'   => 'required',
            'end'   => 'required',
            'date'   => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validate->messages()
            ], 422);
        }

        if ($request->type == "Public Training") {
            $kodeType = "PT";
        } elseif ($request->type == "Inhouse Training") {
            $kodeType = "IT";
        } elseif ($request->type == "Custom Training") {
            $kodeType = "CT";
        }

        $bulan = date('m', strtotime($request->date));
        $tahun = date('Y', strtotime($request->date));
        $initial = "AAA";

        $bulan_romawi = '';
        if ($bulan >= 1 && $bulan <= 12) {
            $angka_romawi = [
                1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
            ];
            $bulan_romawi = str_repeat('X', intval($bulan / 10)) . $angka_romawi[$bulan % 10];
        }

        DB::beginTransaction();
        try {

            $data = [
                'name' => $request->name,
                'title' => $request->title,
                'type' => $request->type,
                'number' => $initial."/". $kodeType. "/". $bulan_romawi. "/". $tahun,
                'start' => $request->start,
                'end' => $request->end,
                'date' => $request->date,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];

            $request->id ? certificate::where('id', $request->id)->update($data) : certificate::insert($data);
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Data berhasil diinputkan', 'data' => $data], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['success' => false, 'messages' => $e->getMessage()], 400);
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
}
