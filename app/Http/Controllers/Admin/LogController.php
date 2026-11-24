<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function index()
    {
        $logs = DB::table('tb_log_aktivitas')
            ->join('tb_user', 'tb_log_aktivitas.id_user', '=', 'tb_user.id_user')
            ->select(
                'tb_log_aktivitas.id_log',
                'tb_log_aktivitas.aktivitas',
                'tb_log_aktivitas.waktu_aktivitas',
                'tb_user.nama_lengkap'
            )
            ->orderBy('tb_log_aktivitas.waktu_aktivitas', 'desc')
            ->get();

        return view('admin.log.index', compact('logs'));
    }
}
