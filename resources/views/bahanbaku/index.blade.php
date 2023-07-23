@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">DATA BAHAN BAKU</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="bi bi-plus"></i>Tambah Bahan Baku
            </button>
        </div>
    </div>

    {{-- <div class="table-responsive"> --}}
    <table id="datatable" class="table table-striped" style="width:100%">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Kode Bahan Baku</th>
                <th>Nama Bahan Baku</th>
                <th>Jenis Bahan Baku</th>
                <th>Stock</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->kd_bahanbaku }}</td>
                    <td>{{ $data->nama_bahanbaku }}</td>
                    <td>{{ $data->jenis_bahanbaku }}</td>
                    <td>{{ $data->stok }}</td>
                    <td class=" p-1">
                        <a class="btn btn-warning btn-sm" style="font-size: 0.6rem;" data-bs-toggle="modal"
                            data-bs-target="#ubah"
                            onclick="populateModal('{{ $data->kd_bahanbaku }}', '{{ $data->nama_bahanbaku }}','{{ $data->jenis_bahanbaku }}','{{ $data->stok }}')">Ubah</a>
                        <a class="btn btn-danger btn-sm" style="font-size: 0.6rem;"
                            onclick="confirmDelete('{{ $data->kd_bahanbaku }}')">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- </div> --}}
@endsection

@section('modal')
    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-dark">
                    <h5 class="modal-title" id="tambahLabel">Tambah Bahan Baku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="bahanbaku/save" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3 row">
                            <div class="col-7">
                                <label for="kd_bahanbaku" class="form-label">Kode Bahan Baku</label>
                                <input class="form-control" id="kd_bahanbaku" name="kd_bahanbaku"
                                    value="{{ $kode_bahanbaku_terakhir }}" required>
                            </div>
                            <div class="col-5">
                                <label for="stok" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_bahanbaku" class="form-label">Nama Bahan Baku</label>
                            <input class="form-control" id="nama_bahanbaku" name="nama_bahanbaku" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_bahanbaku" class="form-label">Jenis Bahan Baku</label>
                            <input class="form-control" id="jenis_bahanbaku" name="jenis_bahanbaku" required>
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
                    <h5 class="modal-title" id="ubahLabel">Ubah Bahan Baku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="bahanbaku/update" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3 row">
                            <div class="col-7">
                                <label for="kd_bahanbaku" class="form-label">Kode Bahan Baku</label>
                                <input class="form-control" id="kd_bahanbaku1" name="kd_bahanbaku" readonly>
                            </div>
                            <div class="col-5">
                                <label for="stok" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stok1" name="stok" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_bahanbaku" class="form-label">Nama Bahan Baku</label>
                            <input class="form-control" id="nama_bahanbaku1" name="nama_bahanbaku" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_bahanbaku" class="form-label">Jenis Bahan Baku</label>
                            <input class="form-control" id="jenis_bahanbaku1" name="jenis_bahanbaku" required>
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
        function populateModal(kd_bahanbaku, nama_bahanbaku, jenis_bahanbaku, stok) {
            // Ambil elemen input dan select berdasarkan ID
            var kd_bahanbakuInput = document.getElementById('kd_bahanbaku1');
            var nama_bahanbakuInput = document.getElementById('nama_bahanbaku1');
            var jenis_bahanbakuInput = document.getElementById('jenis_bahanbaku1');
            var stokInput = document.getElementById('stok1');

            // Set nilai input dan select dengan nilai yang diterima dari tabel
            kd_bahanbakuInput.value = kd_bahanbaku;
            nama_bahanbakuInput.value = nama_bahanbaku;
            jenis_bahanbakuInput.value = jenis_bahanbaku;
            stokInput.value = stok;
        }

        function confirmDelete(id) {
            // Tampilkan pesan konfirmasi menggunakan window.confirm()
            var result = window.confirm("Apakah yakin menghapus Bahan Baku ini ?");

            // Jika pengguna memilih "OK" dalam pesan konfirmasi, arahkan ke user/delete
            if (result) {
                window.location.href = "/bahanbaku/delete/" + id;
            }
            // Jika pengguna memilih "Cancel", tidak ada tindakan yang diambil.
        }
    </script>
@endsection
