<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $postPerPage = $request->input('total_pages', Gallery::count()); // Default all data
        $orderBy = $request->input('order_by', 'id'); // Default id order
        $orderDirection = $request->input('order_direction', 'desc'); // Default to descending order
        $page = $request->input('page', 1); // Default page 1

        $data = Gallery::orderBy($orderBy, $orderDirection)->paginate($postPerPage, ['*'], 'page', $page);

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
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename="";
        if ($request->hasFile('image')) {
            $filename=$request->file('image')->store('images/gallery','public');
        }

        $dataGallery = Gallery::create([
            'image'=>$filename,
        ]);

        return response()->json([
            'message'=>'Success upload image'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Gallery::find($id);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataGallery = Gallery::find($id);
        if (empty($dataGallery)) {
            return response()->json([
                'message'=>'id not found'
            ], 404);
        }

        $destination=public_path("storage\\".$dataGallery->gallery);
        if(File::exists($destination)){
            File::delete($destination);
        }

        $dataGallery->delete();

        return response()->json([
            'message'=>'Success delete data'
        ]);
    }
}
