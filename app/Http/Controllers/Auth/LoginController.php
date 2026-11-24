<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('tb_user')
            ->where('username', $request->username)
            ->where('password', $request->password)
            ->where('status_aktif', 1)
            ->first();

        if (!$user) {
            return back()->with('error', 'Username atau password salah!');
        }

        Session::put('id_user', $user->id_user);
        Session::put('nama_lengkap', $user->nama_lengkap);
        Session::put('role', $user->role);

        if ($user->role == 'admin') {
            return redirect('/admin/dasboard');
        } elseif ($user->role == 'petugas') {
            return redirect('/petugas/dashboard');
        } elseif ($user->role == 'owner') {
            return redirect('/owner/dashboard');
        }

        return back()->with('error', 'Role tidak dikenali!');
    }
     // FUNGSI LOGOUT
    public function logout()
    {
        Session::flush();

        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}

