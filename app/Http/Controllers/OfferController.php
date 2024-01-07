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
    public function index(Request $request)
    {
        $postPerPage = $request->input('total_pages', Offer::count()); // Default all data
        $orderBy = $request->input('order_by', 'id'); // Default id order
        $orderDirection = $request->input('order_direction', 'desc'); // Default to descending order
        $page = $request->input('page', 1); // Default page 1

        $data = Offer::orderBy($orderBy, $orderDirection)->paginate($postPerPage, ['*'], 'page', $page);

        return response()->json([
            'cnt'=>$data->total(),
            'data'=>$data->items(),
            'current_page'=>$data->currentPage(),
            'total_pages'=>$data->lastPage(),
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
            $filename=$request->file('foto_offer')->store('images/foto_offer','public');
        }

        $dataOffer = Offer::create([
            'judul_offer'=>$request->input('judul_offer'),
            'isi_offer'=>$request->input('isi_offer'),
            'jenis_offer'=>$request->input('jenis_offer'),
            'foto_offer'=>$filename,
        ]);

        return response()->json([
            'message'=>'Success create data'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Offer::find($id);
        if($data){
            return response() -> json([
                'status' => true,
                'data' => $data
            ], 200);
        } else {
            return response() -> json([
                'status' => false,
                'message' => "id not found"
            ]);
        }
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
                'message'=>'id not found'
            ], 404);
        }

        $destination=public_path("storage\\".$dataOffer->foto_offer);
        $filename = '';
        if($request->hasFile('new_foto_offer')){
            if(File::exists($destination)){
                File::delete($destination);
            }

            $filename=$request->file('new_foto_offer')->store('images/foto_offer','public');
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
            'message'=>'Success update data'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataOffer = Offer::find($id);
        if (empty($dataOffer)) {
            return response()->json([
                'message'=>'id not found'
            ], 404);
        }
        
        $destination=public_path("storage\\".$dataOffer->foto_offer);
        if(File::exists($destination)){
            File::delete($destination);
        }

        $dataOffer->delete();

        return response()->json([
            'message'=>'Success delete data'
        ]);
    }
}
