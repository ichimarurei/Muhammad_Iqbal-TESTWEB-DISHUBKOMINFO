<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestAPIResource;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\SKPD;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Pegawai::all();

        return new RestAPIResource($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|integer|unique:pegawai',
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'jabatan_id' => 'required|integer',
            'skpd_id' => 'required|integer',
            'unit_kerja_id' => 'required|integer',
            'nama_golongan' => 'required|string',
            'nama_pangkat' => 'required|string',
            'alamat_lengkap' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pegawai = Pegawai::create($validator->validated());
        $jabatan = Jabatan::find($pegawai->jabatan_id);
        $skpd = SKPD::find($pegawai->skpd_id);
        $unitKerja = UnitKerja::find($pegawai->unit_kerja_id);

        return new RestAPIResource($pegawai, 'Pegawai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(int|string $id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }

        return new RestAPIResource($pegawai);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int|string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'jabatan_id' => 'required|integer',
            'skpd_id' => 'required|integer',
            'unit_kerja_id' => 'required|integer',
            'nama_golongan' => 'required|string',
            'nama_pangkat' => 'required|string',
            'alamat_lengkap' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }

        $pegawai->update($validator->validated());

        return new RestAPIResource($pegawai, 'Pegawai berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int|string $id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }

        $pegawai->delete();

        return new RestAPIResource(null, 'Pegawai berhasil dihapus');
    }
}
