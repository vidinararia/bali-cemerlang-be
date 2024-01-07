<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $postPerPage = $request->input('total_pages', Promo::count()); // Default all data
        $orderBy = $request->input('order_by', 'id'); // Default id order
        $orderDirection = $request->input('order_direction', 'desc'); // Default to descending order
        $page = $request->input('page', 1); // Default page 1

        $data = Promo::orderBy($orderBy, $orderDirection)->paginate($postPerPage, ['*'], 'page', $page);

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
            'judul_promo'=>'required|string',
            'isi_promo'=>'required|string',
            'foto_promo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename="";
        if ($request->hasFile('foto_promo')) {
            $filename=$request->file('foto_promo')->store('images/foto_promo','public');
        }

        $dataPromo = Promo::create([
            'judul_promo'=>$request->input('judul_promo'),
            'isi_promo'=>$request->input('isi_promo'),
            'foto_promo'=>$filename,
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
        $data = Promo::find($id);
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
            'judul_promo'=>'required',
            'isi_promo'=>'required',
        ]);

        $dataPromo = Promo::find($request->input('id'));
        if (empty($dataPromo)) {
            return response()->json([
                'message'=>'id not found'
            ], 404);
        }

        $destination=public_path("storage\\".$dataPromo->foto_promo);
        $filename = '';
        if($request->hasFile('new_foto_promo')){
            if(File::exists($destination)){
                File::delete($destination);
            }

            $filename=$request->file('new_foto_promo')->store('images/foto_promo','public');
        }else{
            $filename=$request->foto_promo;
        }
        
        $dataPromo->update([
            'judul_promo'=>$request->input('judul_promo'),
            'isi_promo'=>$request->input('isi_promo'),
            'foto_promo'=>$filename
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
        $dataPromo = Promo::find($id);
        if (empty($dataPromo)) {
            return response()->json([
                'message'=>'id not found'
            ], 404);
        }

        $destination=public_path("storage\\".$dataPromo->foto_promo);
        if(File::exists($destination)){
            File::delete($destination);
        }

        $dataPromo->delete();

        return response()->json([
            'message'=>'Success delete data'
        ]);
    }
}
