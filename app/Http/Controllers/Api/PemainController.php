<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemain;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class PemainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemain = Pemain::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Pemain',
            'data' => $pemain,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pemain' => 'required|unique:pemains',
            'foto' => 'required|image|mimes:png,jpg',
            'tgl_lahir' => 'required|date',
            'harga_pasar' => 'required|integer',
            'posisi' => 'required|in:gk,df,mf,fw',
            'negara' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $pemain = new Pemain();
            $pemain->fill($request->all());

            if ($request->hasFile('foto')) {
                Storage::delete($pemain->foto);
                $path = $request->file('foto')->store('public/fotos');
                $pemain->foto = $path;
            }

            $pemain->save();
            return response()->json([
                'success' => true,
                'message' => 'Pemain Berhasil Ditambahkan',
                'data' => $pemain,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $pemain = Pemain::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Detail Pemain',
                'data' => $pemain,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ada',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pemain' => 'required',
            'foto' => 'nullable|image|mimes:png,jpg',
            'tgl_lahir' => 'required|date',
            'harga_pasar' => 'required|integer',
            'posisi' => 'required|in:gk,df,mf,fw',
            'negara' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $pemain = Pemain::findOrFail($id);
            $pemain->fill($request->all());

            if ($request->hasFile('foto')) {
                Storage::delete($pemain->foto);
                $path = $request->file('foto')->store('public/fotos');
                $pemain->foto = $path;
            }

            $pemain->save();
            return response()->json([
                'success' => true,
                'message' => 'Pemain Berhasil Diupdate',
                'data' => $pemain,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pemain = Pemain::findOrFail($id);
            $pemain->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data ' . $pemain->nama_pemain . ' Berhasil DiHapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ada',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }
}
