
@extends('layout.layout')

@section('title', 'Tambah Kendaraan')

@section('content')
<div class="container-fluid py-3">

    <div class="mb-4">
        <h3 class="fw-bold">Tambah Kendaraan</h3>
        <p class="text-secondary">Masukkan data kendaraan parkir.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('admin.kendaraan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Plat Nomor</label>
                    <input
                        type="text"
                        name="plat_nomor"
                        class="form-control"
                        maxlength="15"
                        value="{{ old('plat_nomor') }}"
                        placeholder="Contoh: AE 1234 AB"
                        required
                    >
                </div>

              
<div class="mb-3">
    <label class="form-label">Jenis Kendaraan</label>
    <select name="jenis_kendaraan" class="form-select" required>
        <option value="">-- Pilih jenis kendaraan --</option>
        <option value="motor" {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>Motor</option>
        <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil</option>
        <option value="lainnya" {{ old('jenis_kendaraan') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
    </select>
</div>


                <div class="mb-3">
                    <label class="form-label">Warna Kendaraan</label>
                    <input
                        type="text"
                        name="warna"
                        class="form-control"
                        maxlength="20"
                        value="{{ old('warna') }}"
                        placeholder="Contoh: Hitam"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Pemilik</label>
                    <input
                        type="text"
                        name="pemilik"
                        class="form-control"
                        maxlength="100"
                        value="{{ old('pemilik') }}"
                        placeholder="Masukkan nama pemilik"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">User yang Terdaftar</label>
                    <select name="id_user" class="form-select" required>
                        <option value="">-- Pilih user --</option>
                        @foreach ($users as $user)
                            <option
                                value="{{ $user->id_user }}"
                                {{ old('id_user') == $user->id_user ? 'selected' : '' }}
                            >
                                {{ $user->nama_lengkap }} (ID: {{ $user->id_user }})
                            </option>
                        @endforeach
                    </select>

                    @if ($users->isEmpty())
                        <small class="text-warning">
                            Belum ada user. Tambahkan user terlebih dahulu.
                        </small>
                    @endif
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan Kendaraan
                    </button>

                    <a href="{{ route('admin.kendaraan') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
