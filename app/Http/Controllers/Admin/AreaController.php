<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    // MENAMPILKAN DATA AREA
    public function index()
    {
        $areas = DB::table('tb_area_parkir')
            ->orderBy('id_area', 'asc')
            ->get();

        return view('admin.area.index', compact('areas'));
    }

    // FORM TAMBAH AREA
    public function create()
    {
        return view('admin.area.create');
    }

    // SIMPAN AREA
    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1',
        ]);

        DB::table('tb_area_parkir')->insert([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'terisi' => 0,
        ]);

        return redirect()
            ->route('admin.area')
            ->with('success', 'Area parkir berhasil ditambahkan!');
    }

    // FORM EDIT AREA
    public function edit($id)
    {
        $area = DB::table('tb_area_parkir')
            ->where('id_area', $id)
            ->first();

        return view('admin.area.edit', compact('area'));
    }

    // UPDATE AREA
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_area' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1',
        ]);

        DB::table('tb_area_parkir')
            ->where('id_area', $id)
            ->update([
                'nama_area' => $request->nama_area,
                'kapasitas' => $request->kapasitas,
            ]);

        return redirect()
            ->route('admin.area')
            ->with('success', 'Area parkir berhasil diperbarui!');
    }

    // HAPUS AREA
    public function destroy($id)
    {
        DB::table('tb_area_parkir')
            ->where('id_area', $id)
            ->delete();

        return redirect()
            ->route('admin.area')
            ->with('success', 'Area parkir berhasil dihapus!');
    }
}