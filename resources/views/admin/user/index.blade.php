@extends('layout.layout')

@section('content')

<div class="container-fluid">

    <!-- JUDUL -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Data User
            </h2>

            <p class="text-secondary mb-0">
                Kelola data pengguna E-PARKIR
            </p>
        </div>

        <a href="{{ route('admin.user.create') }}"
           class="btn"
           style="background-color: #7c3aed; color: white;">
            <i class="bi bi-plus-lg"></i> Tambah User
        </a>

    </div>


    <!-- PESAN BERHASIL -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <!-- CARD DATA USER -->
    <div class="card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-dark table-hover align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $user)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $user->nama_lengkap }}
                            </td>

                            <td>
                                {{ $user->username }}
                            </td>

                            <td>
                                @if($user->role == 'admin')
                                    <span class="badge bg-primary">
                                        Admin
                                    </span>
                                @elseif($user->role == 'petugas')
                                    <span class="badge bg-secondary">
                                        Petugas
                                    </span>
                                @else
                                    <span class="badge bg-info">
                                        Owner
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($user->status_aktif == 1)
                                    <span class="badge bg-success">
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td>

                                <!-- EDIT -->
                                <a href="{{ route('admin.user.edit', $user->id_user) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>


                               <form action="{{ route('admin.user.destroy', $user->id_user) }}"
                                 method="POST"
                                 class="delete-form"
                                 style="display: inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada data user.
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

<style>
.swal-delete-popup {
    background: #161129 !important;
    border: 1px solid #9333ea !important;
    border-radius: 20px !important;
    color: white !important;
}

.swal-delete-title {
    color: white !important;
}

.swal-delete-text {
    color: #b8b5c9 !important;
}

.swal-delete-confirm {
    background: #7c3aed !important;
    border-radius: 9px !important;
}

.swal-delete-cancel {
    background: #302448 !important;
    border-radius: 9px !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Yakin ingin menghapus?',
                text: 'Data ini akan dihapus dan tidak dapat dikembalikan.',
                background: '#161129',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'swal-delete-popup',
                    title: 'swal-delete-title',
                    htmlContainer: 'swal-delete-text',
                    confirmButton: 'swal-delete-confirm',
                    cancelButton: 'swal-delete-cancel'
                }
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