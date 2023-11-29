<?php

namespace App\Http\Controllers;

use App\Models\Tiket_pesawat;
use Illuminate\Http\Request;

class TiketPesawatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Tiket_pesawat::get();
        $sortByAsc = $request->sortByAsc;
        $allData = $data->sortBy($sortByAsc);
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
        ])->sortBy($sortByAsc);
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
