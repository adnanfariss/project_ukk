<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Industri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIIndustriController extends Controller
{
    public function index()
    {
        return response()->json(Industri::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'bidang_usaha' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
            'email' => 'required|email',
            'website' => 'nullable|url'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $industri = Industri::create($request->all());
        return response()->json([
            'message' => 'Data industri berhasil disimpan.',
            'data' => $industri
        ], 201);
    }

    // ... tambahkan show, update, destroy seperti pada SiswaController ...
}