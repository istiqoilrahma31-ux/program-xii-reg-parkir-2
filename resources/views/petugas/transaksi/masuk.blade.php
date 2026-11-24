
@extends('layout.petugas')

@section('title', 'Kendaraan Masuk')

@section('content')
<div class="container-fluid py-3">
    <h3 class="fw-bold mb-1">Kendaraan Masuk</h3>
    <p class="text-muted mb-4">Form pencatatan kendaraan masuk area parkir.</p>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-3">
            <strong>Form Registrasi Parkir</strong>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('petugas.transaksi.simpanMasuk') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Plat Nomor Kendaraan</label>
                        <input type="text" name="plat_nomor" class="form-control"
                               value="{{ old('plat_nomor') }}"
                               placeholder="Contoh: N 1234 AB" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Jenis Kendaraan</label>
                        <select name="jenis_kendaraan" id="jenis_kendaraan"
                                class="form-select" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="motor">Motor</option>
                            <option value="mobil">Mobil</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Warna Kendaraan</label>
                        <input type="text" name="warna" class="form-control"
                               placeholder="Masukkan warna" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Pemilik</label>
                        <input type="text" name="pemilik" class="form-control"
                               placeholder="Masukkan nama pemilik" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Area Parkir</label>
                        <select name="id_area" id="id_area" class="form-select" required>
                            <option value="">-- Pilih Area --</option>
                            @foreach($areaParkir as $area)
                                <option value="{{ $area->id_area }}"
                                        data-nama="{{ strtolower($area->nama_area) }}">
                                    {{ $area->nama_area }}
                                    ({{ $area->kapasitas - $area->terisi }} tempat tersedia)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Waktu Masuk</label>
                        <input type="datetime-local" name="waktu_masuk"
                               class="form-control"
                               value="{{ old('waktu_masuk', now()->format('Y-m-d\TH:i')) }}"
                               required>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('petugas.transaksi') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-printer"></i> Simpan & Cetak Tiket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const jenis = document.getElementById('jenis_kendaraan');
    const area = document.getElementById('id_area');

    function filterArea() {
        const tipe = jenis.value;
        area.value = '';

        Array.from(area.options).forEach(function (option, index) {
            if (index === 0) return;

            const nama = option.dataset.nama || '';
            let cocok = false;

            if (tipe === 'motor') cocok = nama.includes('motor');
            if (tipe === 'mobil') cocok = nama.includes('mobil');
            if (tipe === 'lainnya') cocok = nama.includes('lainnya');

            option.hidden = !cocok;
        });
    }

    jenis.addEventListener('change', filterArea);
});
</script>
@endsection
