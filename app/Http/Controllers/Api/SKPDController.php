<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestAPIResource;
use App\Models\SKPD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SKPDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = SKPD::all();

        return new RestAPIResource($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'skpd' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $skpd = SKPD::create($validator->validated());

        return new RestAPIResource($skpd, 'SKPD berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(int|string $id)
    {
        $data = SKPD::find($id);

        if (!$data) {
            return response()->json(['message' => 'SKPD tidak ditemukan'], 404);
        }

        return new RestAPIResource($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int|string $id)
    {
        $validator = Validator::make($request->all(), [
            'skpd' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $skpd = SKPD::find($id);

        if (!$skpd) {
            return response()->json(['message' => 'SKPD tidak ditemukan'], 404);
        }

        $skpd->update($validator->validated());

        return new RestAPIResource($skpd, 'SKPD berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int|string $id)
    {
        $skpd = SKPD::find($id);

        if (!$skpd) {
            return response()->json(['message' => 'SKPD tidak ditemukan'], 404);
        }

        $skpd->delete();

        return new RestAPIResource(null, 'SKPD berhasil dihapus');
    }
}
