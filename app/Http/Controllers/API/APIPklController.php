<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIPklController extends Controller
{
    public function index()
    {
        return response()->json(Pkl::with(['siswa', 'industri', 'guru'])->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required|exists:siswas,id',
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'bidang_usaha' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pkl = Pkl::create($request->all());
        return response()->json([
            'message' => 'Data PKL berhasil disimpan.',
            'data' => $pkl
        ], 201);
    }

    // ... tambahkan show, update, destroy ...
}