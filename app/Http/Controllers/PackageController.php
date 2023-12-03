<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $postPerPage = $request->input('total_pages', Package::count()); // Default all data
        $orderBy = $request->input('order_by', 'id'); // Default id order
        $orderDirection = $request->input('order_direction', 'desc'); // Default to descending order
        $page = $request->input('page', 1); // Default page 1
        
        $data = Package::orderBy($orderBy, $orderDirection)->paginate($postPerPage, ['*'], 'page', $page);
        
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
            'nama_paket'=>'required',
            'destinasi'=>'required',
            'tanggal'=>'required',
            'jam_keberangkatan'=>'required',
            'harga'=>'required',
            'benefit'=>'required',
        ]);

        $dataPackage = Package::create([
            'nama_paket'=>$request->input('nama_paket'),
            'destinasi'=>$request->input('destinasi'),
            'tanggal'=>$request->input('tanggal'),
            'jam_keberangkatan'=>$request->input('jam_keberangkatan'),
            'harga'=>$request->input('harga'),
            'benefit'=>$request->input('benefit'),
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
        $data = Package::find($id);
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
            'nama_paket'=>'required',
            'destinasi'=>'required',
            'tanggal'=>'required',
            'jam_keberangkatan'=>'required',
            'harga'=>'required',
            'benefit'=>'required',
        ]);

        $dataPackage = Package::find($request->input('id'));
        if (empty($dataPackage)) {
            return response()->json([
                'message'=>'id not found'
            ], 404);
        }

        $dataPackage->update([
            'nama_paket'=>$request->input('nama_paket'),
            'destinasi'=>$request->input('destinasi'),
            'tanggal'=>$request->input('tanggal'),
            'jam_keberangkatan'=>$request->input('jam_keberangkatan'),
            'harga'=>$request->input('harga'),
            'benefit'=>$request->input('benefit'),
        ]);

        return response()->json([
            'message'=>'Success update data'
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

        $dataPackage = Package::find($request->input('id'));
        if (empty($dataPackage)) {
            return response()->json([
                'message'=>'id not found'
            ], 404);
        }

        $dataPackage->delete();

        return response()->json([
            'message'=>'Success delete data'
        ]);
    }

    public function restore(Request $request)
    {
        $request->validate([
            'id'=>'required',
        ]);

        $dataPackage = Package::withTrashed()->find($request->input('id'));
        if (empty($dataPackage)) {
            return response()->json([
                'message'=>'id not found'
            ], 404);
        }
        
        $dataPackage->restore();

        return response()->json([
            'message'=>'Success restore data'
        ]);
    }
}
