<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Offer::all();
        $cntData = $data->count();

        return response()->json([
            'cnt'=>$cntData,
            'data'=>$data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_offer'=>'required',
            'isi_offer'=>'required',
            'jenis_offer'=>'required',
            'foto_offer'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $filename="";
        if ($request->hasFile('foto_offer')) {
            $filename=$request->file('foto_offer')->store('images','public');
        }

        $dataOffer = Offer::create([
            'judul_offer'=>$request->input('judul_offer'),
            'isi_offer'=>$request->input('isi_offer'),
            'jenis_offer'=>$request->input('jenis_offer'),
            'foto_offer'=>$filename,
        ]);

        return response()->json([
            'message'=>'Sukses Menambahkan data'
        ]);
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
    public function update(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'judul_offer'=>'required',
            'isi_offer'=>'required',
            'jenis_offer'=>'required',
        ]);

        $dataOffer = Offer::find($request->input('id'));
        if (empty($dataOffer)) {
            return response()->json([
                'message'=>'Data tidak ditemukan'
            ], 404);
        }

        $destination=public_path("storage\\".$dataOffer->foto_offer);
        $filename = '';
        if($request->hasFile('new_foto_offer')){
            if(File::exists($destination)){
                File::delete($destination);
            }

            $filename=$request->file('new_foto_offer')->store('images','public');
        }else{
            $filename=$request->foto_offer;
        }
        
        $dataOffer->update([
            'judul_offer'=>$request->input('judul_offer'),
            'isi_offer'=>$request->input('isi_offer'),
            'jenis_offer'=>$request->input('jenis_offer'),
            'foto_offer'=>$filename
        ]);

        return response()->json([
            'message'=>'Sukses Update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id'=>'required',
        ]);

        $dataOffer = Offer::find($request->input('id'));
        if (empty($dataOffer)) {
            return response()->json([
                'message'=>'Data tidak ditemukan'
            ], 404);
        }
        
        $destination=public_path("storage\\".$dataOffer->foto_offer);
        if(File::exists($destination)){
            File::delete($destination);
        }

        $dataOffer->delete();

        return response()->json([
            'message'=>'Sukses Menghapus data'
        ]);
    }
}
