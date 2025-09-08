<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestAPIResource;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Jabatan::all();

        return new RestAPIResource($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jabatan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $jabatan = Jabatan::create($validator->validated());

        return new RestAPIResource($jabatan, 'Jabatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(int|string $id)
    {
        $data = Jabatan::find($id);

        if (!$data) {
            return response()->json(['message' => 'Jabatan tidak ditemukan'], 404);
        }

        return new RestAPIResource($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int|string $id)
    {
        $validator = Validator::make($request->all(), [
            'jabatan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $jabatan = Jabatan::find($id);

        if (!$jabatan) {
            return response()->json(['message' => 'Jabatan tidak ditemukan'], 404);
        }

        $jabatan->update($validator->validated());

        return new RestAPIResource($jabatan, 'Jabatan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int|string $id)
    {
        $jabatan = Jabatan::find($id);

        if (!$jabatan) {
            return response()->json(['message' => 'Jabatan tidak ditemukan'], 404);
        }

        $jabatan->delete();

        return new RestAPIResource(null, 'Jabatan berhasil dihapus');
    }
}
