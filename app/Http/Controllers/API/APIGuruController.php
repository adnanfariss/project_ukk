<?php

namespace App\Http\Controllers\API;

use App\Models\Guru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class APIGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     // Tampilkan semua data guru
    public function index()
    {
        $guru = Guru::all();
        return response()->json($guru);
    }

    // Simpan data guru baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:50',
            'nip' => 'required|string|max:18|unique:gurus',
            'gender' => 'required|in:L,P',
            'alamat' => 'required',
            'kontak' => 'required|string|max:16',
            'email' => 'required|email|max:30|unique:gurus',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $guru = Guru::create($request->all());
        return response()->json([
            'message' => 'Data guru berhasil disimpan',
            'data' => $guru
        ], 201);
    }

    // Tampilkan satu guru berdasarkan ID
    public function show($id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json(['message' => 'Data guru tidak ditemukan'], 404);
        }

        return response()->json($guru);
    }

    // Update data guru
    public function update(Request $request, $id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json(['message' => 'Data guru tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:50',
            'nip' => 'sometimes|required|string|max:18|unique:gurus,nip,'.$id,
            'gender' => 'sometimes|required|in:L,P',
            'alamat' => 'sometimes|required',
            'kontak' => 'sometimes|required|string|max:16',
            'email' => 'sometimes|required|email|max:30|unique:gurus,email,'.$id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $guru->update($request->all());

        return response()->json([
            'message' => 'Data guru berhasil diupdate',
            'data' => $guru
        ]);
    }

    // Hapus data guru
    public function destroy($id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json(['message' => 'Data guru tidak ditemukan'], 404);
        }

        $guru->delete();

        return response()->json(['message' => 'Data guru berhasil dihapus']);
    }
}
