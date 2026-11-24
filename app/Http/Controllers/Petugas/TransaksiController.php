<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // HALAMAN DATA TRANSAKSI
    public function index()
    {
        $transaksi = DB::table('tb_transaksi')->get();

        return view('petugas.transaksi.index', compact('transaksi'));
    }

    // HALAMAN CETAK STRUKTUR PARKIR
    public function cetak()
    {
        $areaParkir = DB::table('tb_area_parkir')->get();

        return view('petugas.transaksi.cetak', compact('areaParkir'));
    }

   
public function masuk()
{
    $areaParkir = DB::table('tb_area_parkir')
        ->whereColumn('terisi', '<', 'kapasitas')
        ->get();

    return view('petugas.transaksi.masuk', compact('areaParkir'));
}

public function simpanMasuk(Request $request)
{
    $request->validate([
        'plat_nomor' => 'required|string|max:15',
        'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',
        'warna' => 'required|string|max:20',
        'pemilik' => 'required|string|max:100',
        'id_area' => 'required|exists:tb_area_parkir,id_area',
        'waktu_masuk' => 'required|date',
    ]);

    $area = DB::table('tb_area_parkir')
        ->where('id_area', $request->id_area)
        ->first();

    if (!$area) {
        return back()->withInput()->with('error', 'Area parkir tidak ditemukan!');
    }

    $namaArea = strtolower($area->nama_area);
    $jenis = $request->jenis_kendaraan;

    $sesuai = (
        ($jenis === 'motor' && str_contains($namaArea, 'motor')) ||
        ($jenis === 'mobil' && str_contains($namaArea, 'mobil')) ||
        ($jenis === 'lainnya' && str_contains($namaArea, 'lainnya'))
    );

    if (!$sesuai) {
        return back()->withInput()->with('error', 'Area tidak sesuai dengan jenis kendaraan!');
    }

    $tarif = DB::table('tb_tarif')
        ->where('jenis_kendaraan', $jenis)
        ->first();

    if (!$tarif) {
        return back()->withInput()->with('error', 'Tarif kendaraan belum tersedia!');
    }

    $hasil = DB::transaction(function () use ($request, $tarif) {
        $area = DB::table('tb_area_parkir')
            ->where('id_area', $request->id_area)
            ->lockForUpdate()
            ->first();

        if (!$area || $area->terisi >= $area->kapasitas) {
            return null;
        }

        $plat = strtoupper(trim($request->plat_nomor));

        $sudahParkir = DB::table('tb_transaksi')
            ->join('tb_kendaraan', 'tb_transaksi.id_kendaraan', '=', 'tb_kendaraan.id_kendaraan')
            ->where('tb_kendaraan.plat_nomor', $plat)
            ->where('tb_transaksi.status', 'masuk')
            ->exists();

        if ($sudahParkir) {
            return null;
        }

        $idKendaraan = DB::table('tb_kendaraan')->insertGetId([
            'plat_nomor' => $plat,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna' => $request->warna,
            'pemilik' => $request->pemilik,
            'id_user' => session('id_user'),
        ]);

        $idTransaksi = DB::table('tb_transaksi')->insertGetId([
            'id_kendaraan' => $idKendaraan,
            'waktu_masuk' => $request->waktu_masuk,
            'id_tarif' => $tarif->id_tarif,
            'status' => 'masuk',
            'id_user' => session('id_user'),
            'id_area' => $request->id_area,
        ]);

        DB::table('tb_area_parkir')
            ->where('id_area', $request->id_area)
            ->increment('terisi');

        return [
            'id_transaksi' => $idTransaksi,
            'id_kendaraan' => $idKendaraan,
        ];
    });

    if (!$hasil) {
        return back()->withInput()
            ->with('error', 'Area penuh atau kendaraan masih parkir!');
    }

    $transaksi = DB::table('tb_transaksi')
        ->where('id_transaksi', $hasil['id_transaksi'])
        ->first();

    $kendaraan = DB::table('tb_kendaraan')
        ->where('id_kendaraan', $hasil['id_kendaraan'])
        ->first();

    $area = DB::table('tb_area_parkir')
        ->where('id_area', $request->id_area)
        ->first();

    $petugas = session('nama_lengkap');

    return view('petugas.transaksi.tiket', compact(
        'transaksi', 'kendaraan', 'area', 'petugas'
    ));
}


    // HALAMAN KENDARAAN KELUAR
    public function keluar()
    {
        $transaksi = DB::table('tb_transaksi')
            ->join('tb_kendaraan', 'tb_transaksi.id_kendaraan', '=', 'tb_kendaraan.id_kendaraan')
            ->where('tb_transaksi.status', 'masuk')
            ->select('tb_transaksi.*', 'tb_kendaraan.plat_nomor', 'tb_kendaraan.jenis_kendaraan')
            ->get();

        return view('petugas.transaksi.keluar', compact('transaksi'));
    }

    // PROSES KENDARAAN KELUAR
    public function prosesKeluar($id)
    {
        $berhasil = DB::transaction(function () use ($id) {
            $transaksi = DB::table('tb_transaksi')
                ->where('id_transaksi', $id)
                ->lockForUpdate()
                ->first();

            if (!$transaksi || $transaksi->status != 'masuk') {
                return false;
            }

            $waktuKeluar = now();
            $waktuMasuk = \Carbon\Carbon::parse($transaksi->waktu_masuk);

            // Durasi dibulatkan ke atas per jam
            $durasiJam = max(1, (int) ceil(
                $waktuMasuk->diffInSeconds($waktuKeluar) / 3600
            ));

            $tarif = DB::table('tb_tarif')
                ->where('id_tarif', $transaksi->id_tarif)
                ->first();

            if (!$tarif) {
                return false;
            }

            $biayaTotal = $durasiJam * $tarif->tarif_per_jam;

            DB::table('tb_transaksi')
                ->where('id_transaksi', $id)
                ->update([
                    'waktu_keluar' => $waktuKeluar,
                    'durasi_jam' => $durasiJam,
                    'biaya_total' => $biayaTotal,
                    'status' => 'keluar',
                ]);

            DB::table('tb_area_parkir')
                ->where('id_area', $transaksi->id_area)
                ->where('terisi', '>', 0)
                ->decrement('terisi');

            return true;
        });

        if (!$berhasil) {
            return back()->with('error', 'Transaksi tidak ditemukan atau tarif tidak tersedia!');
        }

        return redirect()->route('petugas.transaksi')
            ->with('success', 'Kendaraan berhasil keluar!');
    }
}