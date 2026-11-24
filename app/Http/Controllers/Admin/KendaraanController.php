<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = DB::table('tb_kendaraan')->get();

        return view('admin.kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        $users = DB::table('tb_user')
            ->select('id_user', 'nama_lengkap')
            ->get();

        return view('admin.kendaraan.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'plat_nomor' => strtoupper(trim($request->plat_nomor)),
        ]);

        $request->validate([
            'plat_nomor' => [
                'required',
                'string',
                'max:15',
                Rule::unique('tb_kendaraan', 'plat_nomor'),
            ],
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',
            'warna' => 'required|string|max:20',
            'pemilik' => 'required|string|max:100',
            'id_user' => 'required|integer|exists:tb_user,id_user',
        ]);

        DB::table('tb_kendaraan')->insert([
            'plat_nomor' => $request->plat_nomor,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna' => $request->warna,
            'pemilik' => $request->pemilik,
            'id_user' => $request->id_user,
        ]);

        return redirect()
            ->route('admin.kendaraan')
            ->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $kendaraan = DB::table('tb_kendaraan')
            ->where('id_kendaraan', $id)
            ->first();

        if (!$kendaraan) {
            return redirect()
                ->route('admin.kendaraan')
                ->with('error', 'Data kendaraan tidak ditemukan.');
        }

        DB::table('tb_kendaraan')
            ->where('id_kendaraan', $id)
            ->delete();

        return redirect()
            ->route('admin.kendaraan')
            ->with('success', 'Kendaraan berhasil dihapus!');
    }
}
