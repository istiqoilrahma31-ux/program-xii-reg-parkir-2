@extends('layout.layout')

@section('title', 'Tarif Parkir')

@section('content')

<div class="container-fluid">

    <!-- JUDUL -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Tarif Parkir
            </h2>

            <p class="mb-0" style="color: #a0aec0;">
                Kelola tarif parkir E-PARKIR
            </p>
        </div>

        <!-- TAMBAH TARIF -->
        <a href="{{ route('admin.tarif.create') }}"
           class="btn"
           style="
                background-color: #7c3aed;
                color: white;
                border-radius: 8px;
           ">

            <i class="bi bi-plus-lg"></i>
            Tambah Tarif

        </a>

    </div>


    <!-- PESAN BERHASIL -->
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <!-- PESAN ERROR -->
    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- CARD -->
    <div class="card"
         style="
            background-color: #161129 !important;
            border: 1px solid rgba(124, 58, 237, 0.25) !important;
            border-radius: 16px;
         ">

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table align-middle mb-0"
                       style="color: white;">

                    <thead>

                        <tr style="
                            background-color: #1d1535;
                            border-bottom: 1px solid #2b2145;
                        ">

                            <th class="py-3 px-3">
                                No
                            </th>

                            <th class="py-3">
                                Jenis Kendaraan
                            </th>

                            <th class="py-3">
                                Tarif Per Jam
                            </th>

                            <th class="py-3">
                                Status
                            </th>

                            <th class="py-3 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($tarifs as $tarif)

                            <tr style="
                                border-bottom: 1px solid #2b2145;
                            ">

                                <!-- NO -->
                                <td class="px-3">
                                    {{ $loop->iteration }}
                                </td>


                                <!-- JENIS KENDARAAN -->
                                <td>

                                    {{ ucfirst($tarif->jenis_kendaraan) }}

                                </td>


                                <!-- TARIF -->
                                <td>

                                    Rp
                                    {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}

                                </td>


                                <!-- STATUS -->
                                <td>

                                    <span class="badge px-3 py-2"
                                          style="
                                            background-color: #22c55e;
                                            border-radius: 7px;
                                          ">

                                        Aktif

                                    </span>

                                </td>


                                <!-- AKSI -->
                                <td class="text-center">

                                    <!-- EDIT -->
                                    <button type="button"
                                            class="btn btn-sm me-2"
                                            style="
                                                background-color: #7c3aed;
                                                color: white;
                                                border-radius: 7px;
                                            "
                                            disabled
                                            title="Fitur edit belum dibuat">

                                        <i class="bi bi-pencil"></i>

                                    </button>


                                    <!-- HAPUS -->
                                    <form action="{{ route('admin.tarif.destroy', $tarif->id_tarif) }}"
                                          method="POST"
                                          style="display: inline;">

                                        @csrf

                                        @method('DELETE')

                                        <button type="button"
                                                class="btn btn-sm"
                                                style="
                                                    background-color: #7c3aed;
                                                    color: white;
                                                    border-radius: 7px;
                                                "
                                                onclick="bukaModalHapus(this.form)">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center py-5"
                                    style="color: #a0aec0;">

                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                                    Belum ada data tarif.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <!-- JUMLAH DATA -->
            <div class="mt-3"
                 style="
                    color: #a0aec0;
                    font-size: 14px;
                 ">

                Menampilkan

                <strong style="color: white;">
                    {{ $tarifs->count() }}
                </strong>

                data tarif

            </div>

        </div>

    </div>

</div>


<!-- ===================================================== -->
<!-- MODAL HAPUS -->
<!-- ===================================================== -->

<div id="modalHapus"
     style="
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.75);
        z-index: 99999;
        align-items: center;
        justify-content: center;
     ">

    <div style="
        width: 400px;
        max-width: 90%;
        background: #161129;
        border: 1px solid #7c3aed;
        border-radius: 18px;
        padding: 30px;
        text-align: center;
        color: white;
        box-shadow: 0 15px 50px rgba(0,0,0,0.6);
    ">

        <!-- ICON -->
        <div style="
            font-size: 55px;
            color: #a855f7;
            margin-bottom: 10px;
        ">

            <i class="bi bi-exclamation-circle"></i>

        </div>


        <!-- JUDUL -->
        <h4 class="fw-bold">
            Yakin ingin menghapus?
        </h4>


        <!-- KETERANGAN -->
        <p style="color: #a0aec0;">

            Data tarif ini akan dihapus dan
            tidak dapat dikembalikan.

        </p>


        <!-- TOMBOL -->
        <div class="mt-4">

            <!-- BATAL -->
            <button type="button"
                    onclick="tutupModalHapus()"
                    style="
                        border: none;
                        padding: 10px 20px;
                        border-radius: 8px;
                        background: #2b2145;
                        color: white;
                        margin-right: 8px;
                    ">

                Batal

            </button>


            <!-- YA HAPUS -->
            <button type="button"
                    onclick="lanjutkanHapus()"
                    style="
                        border: none;
                        padding: 10px 20px;
                        border-radius: 8px;
                        background: #7c3aed;
                        color: white;
                    ">

                Ya, Hapus

            </button>

        </div>

    </div>

</div>


<script>

    let formHapus = null;


    function bukaModalHapus(form)
    {
        formHapus = form;

        document.getElementById('modalHapus').style.display = 'flex';
    }


    function tutupModalHapus()
    {
        document.getElementById('modalHapus').style.display = 'none';

        formHapus = null;
    }


    function lanjutkanHapus()
    {
        if (formHapus) {

            formHapus.submit();

        }
    }

</script>


@endsection