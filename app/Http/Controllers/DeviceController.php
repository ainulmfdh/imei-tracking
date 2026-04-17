<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{

    public function index()
    {
        $devices = Device::all();
        return view('devices.index', compact('devices'));
    }

    public function scan()
    {
        return view('devices.scan');
    }

    // public function find(Request $request)
    // {
    //     $device = Device::where('imei',$request->imei)->first();
    //     return response()->json($device);

    //      $imei = preg_replace('/\D/', '', $request->imei);

    //     $data = DB::table('devices')
    //         ->where('imei', $imei)
    //         ->first();

    //     return response()->json($data);
    // }

    public function find(Request $request)
    {
        try {

            if (!$request->imei) {
                return response()->json([
                    'error' => 'IMEI kosong'
                ], 400);
            }

            // bersihkan IMEI
            $imei = preg_replace('/\D/', '', $request->imei);

            // ambil 15 digit saja
            $imei = substr($imei, 0, 15);

            $data = DB::table('devices')
                ->where('imei', $imei)
                ->first();

            return response()->json($data ?? []);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);

        }
    }

    public function masuk(Request $request)
    {

        $device = Device::where('imei',$request->imei)->first();

        $device->status = 'available';
        $device->save();

        Transaction::create([
            'imei'=>$request->imei,
            'type'=>'masuk',
            'petugas'=>Auth::user()->name
        ]);

        return redirect()->back()->with('success','HP Masuk berhasil');
    }

    public function keluar(Request $request)
    {

        $device = Device::where('imei',$request->imei)->first();

        $device->status = 'dipakai';
        $device->save();

        Transaction::create([
            'imei'=>$request->imei,
            'type'=>'keluar',
            'petugas'=>Auth::user()->name
        ]);

        return redirect()->back()->with('success','HP Keluar berhasil');
    }
}