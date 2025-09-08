<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestAPIResource;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = UnitKerja::all();

        return new RestAPIResource($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit_kerja' => 'required|string',
            'skpd_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $unitKerja = UnitKerja::create($validator->validated());

        return new RestAPIResource($unitKerja, 'Unit Kerja berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(int|string $id)
    {
        $unitKerja = UnitKerja::find($id);

        if (!$unitKerja) {
            return response()->json(['message' => 'Unit Kerja tidak ditemukan'], 404);
        }

        return new RestAPIResource($unitKerja);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int|string $id)
    {
        $validator = Validator::make($request->all(), [
            'unit_kerja' => 'required|string',
            'skpd_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $unitKerja = UnitKerja::find($id);

        if (!$unitKerja) {
            return response()->json(['message' => 'Unit Kerja tidak ditemukan'], 404);
        }

        $unitKerja->update($validator->validated());

        return new RestAPIResource($unitKerja, 'Unit Kerja berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int|string $id)
    {
        $unitKerja = UnitKerja::find($id);

        if (!$unitKerja) {
            return response()->json(['message' => 'Unit Kerja tidak ditemukan'], 404);
        }

        $unitKerja->delete();

        return new RestAPIResource(null, 'Unit Kerja berhasil dihapus');
    }
}
