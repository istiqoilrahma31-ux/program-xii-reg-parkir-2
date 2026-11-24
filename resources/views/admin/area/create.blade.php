@extends('layout.layout')

@section('title', 'Tambah Area Parkir')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Tambah Area Parkir
        </h2>

        <p class="text-secondary mb-0">
            Tambahkan area parkir baru
        </p>

    </div>


    <div class="card"
         style="
            background-color: #161129 !important;
            border: 1px solid rgba(124, 58, 237, 0.25) !important;
            border-radius: 16px;
         ">

        <div class="card-body p-4">

            <form action="{{ route('admin.area.store') }}"
                  method="POST">

                @csrf


                <!-- NAMA AREA -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Area
                    </label>

                    <input type="text"
                           name="nama_area"
                           class="form-control"
                           placeholder="Contoh: Area A"
                           value="{{ old('nama_area') }}"
                           required>

                    @error('nama_area')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                <!-- KAPASITAS -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Kapasitas
                    </label>

                    <input type="number"
                           name="kapasitas"
                           class="form-control"
                           placeholder="Contoh: 50"
                           min="1"
                           value="{{ old('kapasitas') }}"
                           required>

                    @error('kapasitas')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                <!-- STATUS -->
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select name="status"
                            class="form-select"
                            required>

                        <option value="aktif">
                            Aktif
                        </option>

                        <option value="nonaktif">
                            Nonaktif
                        </option>

                    </select>

                    @error('status')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                <!-- TOMBOL -->
                <div class="d-flex gap-2">

                    <button type="submit"
                            class="btn"
                            style="
                                background-color: #7c3aed;
                                color: white;
                            ">

                        <i class="bi bi-save"></i>
                        Simpan Area

                    </button>


                    <a href="{{ route('admin.area') }}"
                       class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection