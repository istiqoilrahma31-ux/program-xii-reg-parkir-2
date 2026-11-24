<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total seluruh transaksi
        $totalTransaksi = DB::table('tb_transaksi')->count();

        // Kendaraan masuk hari ini
        $kendaraanMasuk = DB::table('tb_transaksi')
            ->whereDate('waktu_masuk', today())
            ->count();

        // Kendaraan yang sudah keluar hari ini
        $kendaraanKeluar = DB::table('tb_transaksi')
            ->where('status', 'keluar')
            ->whereDate('waktu_keluar', today())
            ->count();

        // Kendaraan yang masih parkir
        $sedangParkir = DB::table('tb_transaksi')
            ->where('status', 'masuk')
            ->count();

        // Total pendapatan dari transaksi selesai
        $totalPendapatan = DB::table('tb_transaksi')
            ->where('status', 'keluar')
            ->sum('biaya_total');

        // Transaksi terbaru
        $transaksiTerbaru = DB::table('tb_transaksi')
            ->join(
                'tb_kendaraan',
                'tb_transaksi.id_kendaraan',
                '=',
                'tb_kendaraan.id_kendaraan'
            )
            ->select(
                'tb_transaksi.*',
                'tb_kendaraan.plat_nomor',
                'tb_kendaraan.jenis_kendaraan',
                'tb_kendaraan.pemilik'
            )
            ->orderByDesc('tb_transaksi.id_transaksi')
            ->limit(5)
            ->get();

        return view('owner.dashboard', compact(
            'totalTransaksi',
            'kendaraanMasuk',
            'kendaraanKeluar',
            'sedangParkir',
            'totalPendapatan',
            'transaksiTerbaru'
        ));
    }
}
