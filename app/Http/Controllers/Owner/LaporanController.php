<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Query laporan transaksi
        $query = DB::table('tb_transaksi')
            ->join('tb_kendaraan', 'tb_transaksi.id_kendaraan', '=', 'tb_kendaraan.id_kendaraan')
            ->leftJoin('tb_area_parkir', 'tb_transaksi.id_area', '=', 'tb_area_parkir.id_area')
            ->select(
                'tb_transaksi.*',
                'tb_kendaraan.plat_nomor',
                'tb_kendaraan.jenis_kendaraan',
                'tb_kendaraan.warna',
                'tb_kendaraan.pemilik',
                'tb_area_parkir.nama_area'
            );

        // Filter tanggal awal
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate(
                'tb_transaksi.waktu_masuk',
                '>=',
                $request->tanggal_mulai
            );
        }

        // Filter tanggal akhir
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate(
                'tb_transaksi.waktu_masuk',
                '<=',
                $request->tanggal_selesai
            );
        }

        // Total transaksi
        $totalTransaksi = (clone $query)->count();

        // Total pendapatan
        $totalPendapatan = (clone $query)
            ->where('tb_transaksi.status', 'keluar')
            ->sum('tb_transaksi.biaya_total');

        // Data transaksi
        $transaksi = $query
            ->orderBy('tb_transaksi.waktu_masuk', 'desc')
            ->get();

        return view('owner.laporan.index', compact(
            'transaksi',
            'totalTransaksi',
            'totalPendapatan'
        ));
    }
    public function cetak(Request $request)
{
    $query = DB::table('tb_transaksi')
        ->join('tb_kendaraan', 'tb_transaksi.id_kendaraan', '=', 'tb_kendaraan.id_kendaraan')
        ->leftJoin('tb_area_parkir', 'tb_transaksi.id_area', '=', 'tb_area_parkir.id_area')
        ->select(
            'tb_transaksi.*',
            'tb_kendaraan.plat_nomor',
            'tb_kendaraan.jenis_kendaraan',
            'tb_kendaraan.pemilik',
            'tb_area_parkir.nama_area'
        );

    if ($request->filled('tanggal_mulai')) {
        $query->whereDate('tb_transaksi.waktu_masuk', '>=', $request->tanggal_mulai);
    }

    if ($request->filled('tanggal_selesai')) {
        $query->whereDate('tb_transaksi.waktu_masuk', '<=', $request->tanggal_selesai);
    }

    $totalTransaksi = (clone $query)->count();

    $totalPendapatan = (clone $query)
        ->where('tb_transaksi.status', 'keluar')
        ->sum('tb_transaksi.biaya_total');

    $transaksi = $query
        ->orderBy('tb_transaksi.waktu_masuk', 'desc')
        ->get();

    return view('owner.laporan.cetak', compact(
        'transaksi',
        'totalTransaksi',
        'totalPendapatan'
    ));
}
}
