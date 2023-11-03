<?php

namespace App\Http\Controllers;

use App\Http\Resources\TiketResource;
use App\Models\tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = tiket::with('nama_pesawat:id,nama_pesawat')->with('lokasi_awal:id,nama_lokasi')->with('lokasi_tujuan:id,nama_lokasi');
        $allData = $data->get();
        $cntData = $data->count();

        $lokasi_awal = $request->lokasi_awal;
        $lokasi_tujuan = $request->lokasi_tujuan;
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_tujuan = $request->tanggal_tujuan;
        
        $findData = $data->where([
            'id_lokasi_awal'=>$lokasi_awal,
            'id_lokasi_tujuan'=>$lokasi_tujuan,
            'tanggal_lokasi_awal'=>$tanggal_awal,
            'tanggal_lokasi_tujuan'=>$tanggal_tujuan
        ])->get();
        $cntFindData = $findData->count();
        
        if(!$lokasi_awal && !$lokasi_tujuan && !$tanggal_awal && !$tanggal_tujuan) {
            return response()->json([
                'cnt'=>$cntData,
                'data'=>$allData
            ]);
        } else {
            return response()->json([
                'cnt'=>$cntFindData,
                'data'=>$findData
            ]);
        }
        
        
        // return TiketResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
