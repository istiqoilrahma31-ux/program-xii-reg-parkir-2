
@extends('layout.layout')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Data Kendaraan</h2>
            <p class="text-muted mb-0">
                Kelola data kendaraan parkir
            </p>
        </div>
       <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-lg me-1"></i> Tambah Kendaraan
</a>
        
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Plat Nomor</th>
                            <th>Jenis Kendaraan</th>
                            <th>Warna</th>
                            <th>Pemilik</th>
                            <th>ID User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($kendaraan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->plat_nomor }}</td>
                            <td>{{ $item->jenis_kendaraan }}</td>
                            <td>{{ $item->warna }}</td>
                            <td>{{ $item->pemilik }}</td>
                            <td>{{ $item->id_user }}</td>
                            <td>
                               
    <form action="{{ route('admin.kendaraan.destroy', $item->id_kendaraan) }}"
      method="POST"
      class="delete-form">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger btn-sm">
        <i class="bi bi-trash"></i> Hapus
    </button>
</form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7"
                                class="text-center text-muted py-4">
                                Belum ada data kendaraan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Yakin ingin menghapus?',
                text: 'Data kendaraan ini akan dihapus dan tidak dapat dikembalikan.',
                background: '#161129',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                confirmButtonColor: '#7c3aed',
                cancelButtonColor: '#302448'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

@endsection
