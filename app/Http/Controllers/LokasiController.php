<?php

namespace App\Http\Controllers;

use App\Models\lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $data = lokasi::all();
        $cntData = lokasi::count();
        return response()->json([
            'cnt'=>$cntData,
            'data'=>$data
        ]);
    } 
}
