@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">DATA PEMASOK</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="bi bi-plus"></i>Tambah Pemasok
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="datatable" class="table display" style="width:100%">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kode Pemasok</th>
                    <th>Nama Pemasok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->kode_pemasok }}</td>
                        <td>{{ $data->nama_pemasok }}</td>
                        <td class=" p-1">
                            <a class="btn btn-warning btn-sm" style="font-size: 0.6rem;" data-bs-toggle="modal"
                                data-bs-target="#ubah"
                                onclick="populateModal('{{ $data->kode_pemasok }}', '{{ $data->nama_pemasok }}')">Ubah</a>
                            <a class="btn btn-danger btn-sm" style="font-size: 0.6rem;"
                                onclick="confirmDelete('{{ $data->kode_pemasok }}')">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('modal')
    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-dark">
                    <h5 class="modal-title" id="tambahLabel">Tambah Pemasok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="pemasok/save" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="kode_pemasok" class="form-label">Kode Pemasok</label>
                            <input class="form-control" id="kode_pemasok" name="kode_pemasok"
                                value="{{ $kode_pemasok_terakhir }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pemasok" class="form-label">Nama Pemasok</label>
                            <input class="form-control" id="nama_pemasok" name="nama_pemasok" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ubah -->
    <div class="modal fade" id="ubah" tabindex="-1" aria-labelledby="ubahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-dark">
                    <h5 class="modal-title" id="ubahLabel">Ubah Pemasok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="pemasok/update" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="kode_pemasok" class="form-label">Kode Pemasok</label>
                            <input class="form-control" id="kode_pemasok1" name="kode_pemasok" readonly required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pemasok" class="form-label">Nama Pemasok</label>
                            <input class="form-control" id="nama_pemasok1" name="nama_pemasok" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function populateModal(kode_pemasok, nama_pemasok) {
            // Ambil elemen input dan select berdasarkan ID
            var kode_pemasokInput = document.getElementById('kode_pemasok1');
            var nama_pemasokInput = document.getElementById('nama_pemasok1');

            // Set nilai input dan select dengan nilai yang diterima dari tabel
            kode_pemasokInput.value = kode_pemasok;
            nama_pemasokInput.value = nama_pemasok;
        }

        function confirmDelete(id) {
            // Tampilkan pesan konfirmasi menggunakan window.confirm()
            var result = window.confirm("Apakah yakin menghapus Pemasok ini ?");

            // Jika pengguna memilih "OK" dalam pesan konfirmasi, arahkan ke user/delete
            if (result) {
                window.location.href = "/pemasok/delete/" + id;
            }
            // Jika pengguna memilih "Cancel", tidak ada tindakan yang diambil.
        }
    </script>
@endsection
