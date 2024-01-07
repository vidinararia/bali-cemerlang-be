<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $postPerPage = $request->input('total_pages', News::count()); // Default all data
        $orderBy = $request->input('order_by', 'id'); // Default id order
        $orderDirection = $request->input('order_direction', 'desc'); // Default to descending order
        $page = $request->input('page', 1); // Default page 1

        $data = News::orderBy($orderBy, $orderDirection)->paginate($postPerPage, ['*'], 'page', $page);

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
            'judul_berita'=>'required|string',
            'isi_berita'=>'required|string',
            'foto_berita'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename="";
        if ($request->hasFile('foto_berita')) {
            $filename=$request->file('foto_berita')->store('images/foto_berita','public');
        }

        $dataNews = News::create([
            'judul_berita'=>$request->input('judul_berita'),
            'isi_berita'=>$request->input('isi_berita'),
            'foto_berita'=>$filename,
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
        $data = News::find($id);
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
            'judul_berita'=>'required',
            'isi_berita'=>'required',
        ]);

        $dataNews = News::find($request->input('id'));
        if (empty($dataNews)) {
            return response()->json([
                'message'=>'id not found'
            ], 404);
        }

        $destination=public_path("storage\\".$dataNews->foto_berita);
        $filename = '';
        if($request->hasFile('new_foto_berita')){
            if(File::exists($destination)){
                File::delete($destination);
            }

            $filename=$request->file('new_foto_berita')->store('images/foto_berita','public');
        }else{
            $filename=$request->foto_berita;
        }
        
        $dataNews->update([
            'judul_berita'=>$request->input('judul_berita'),
            'isi_berita'=>$request->input('isi_berita'),
            'foto_berita'=>$filename
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
        $dataNews = News::find($id);
        if (empty($dataNews)) {
            return response()->json([
                'message'=>'id not found'
            ], 404);
        }

        $destination=public_path("storage\\".$dataNews->foto_berita);
        if(File::exists($destination)){
            File::delete($destination);
        }

        $dataNews->delete();

        return response()->json([
            'message'=>'Success delete data'
        ]);
    }
}
