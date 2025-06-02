<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APISiswaController extends Controller
{
    public function index()
    {
        return response()->json(Siswa::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:50',
            'nis' => 'required|string|size:5|unique:siswas',
            'gender' => 'required|in:L,P',
            'alamat' => 'required',
            'kontak' => 'required|string|max:16',
            'email' => 'required|email|max:30|unique:siswas',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $siswa = Siswa::create($request->all());
        return response()->json([
            'message' => 'Data siswa berhasil disimpan.',
            'data' => $siswa
        ], 201);
    }

    public function show($id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        return response()->json($siswa);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:50',
            'nis' => 'sometimes|required|string|size:5|unique:siswas,nis,'.$id,
            'gender' => 'sometimes|required|in:L,P',
            'alamat' => 'sometimes|required',
            'kontak' => 'sometimes|required|string|max:16',
            'email' => 'sometimes|required|email|max:30|unique:siswas,email,'.$id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $siswa->update($request->all());

        return response()->json([
            'message' => 'Data siswa berhasil diubah.',
            'data' => $siswa
        ]);
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $siswa->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}