@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">DATA ATK</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="bi bi-plus"></i>Tambah ATK
            </button>
        </div>
    </div>

    {{-- <div class="table-responsive"> --}}
    <table id="datatable" class="table table-striped" style="width:100%">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Kode ATK</th>
                <th>Nama ATK</th>
                <th>Jenis ATK</th>
                <th>Stock</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->kd_atk }}</td>
                    <td>{{ $data->nama_atk }}</td>
                    <td>{{ $data->jenis_atk }}</td>
                    <td>{{ $data->stok }}</td>
                    <td class=" p-1">
                        <a class="btn btn-warning btn-sm" style="font-size: 0.6rem;" data-bs-toggle="modal"
                            data-bs-target="#ubah"
                            onclick="populateModal('{{ $data->kd_atk }}', '{{ $data->nama_atk }}','{{ $data->jenis_atk }}','{{ $data->stok }}')">Ubah</a>
                        <a class="btn btn-danger btn-sm" style="font-size: 0.6rem;"
                            onclick="confirmDelete('{{ $data->kd_atk }}')">Hapus</a>
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
                    <h5 class="modal-title" id="tambahLabel">Tambah ATK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="atk/save" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3 row">
                            <div class="col-7">
                                <label for="kd_atk" class="form-label">Kode ATK</label>
                                <input class="form-control" id="kd_atk" name="kd_atk" value="{{ $kode_atk_terakhir }}"
                                    required>
                            </div>
                            <div class="col-5">
                                <label for="stok" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_atk" class="form-label">Nama ATK</label>
                            <input class="form-control" id="nama_atk" name="nama_atk" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_atk" class="form-label">Jenis ATK</label>
                            <input class="form-control" id="jenis_atk" name="jenis_atk" required>
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
                    <h5 class="modal-title" id="ubahLabel">Ubah ATK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="atk/update" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3 row">
                            <div class="col-7">
                                <label for="kd_atk" class="form-label">Kode ATK</label>
                                <input class="form-control" id="kd_atk1" name="kd_atk" readonly>
                            </div>
                            <div class="col-5">
                                <label for="stok" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stok1" name="stok" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_atk" class="form-label">Nama ATK</label>
                            <input class="form-control" id="nama_atk1" name="nama_atk" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_atk" class="form-label">Jenis ATK</label>
                            <input class="form-control" id="jenis_atk1" name="jenis_atk" required>
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
        function populateModal(kd_atk, nama_atk, jenis_atk, stok) {
            // Ambil elemen input dan select berdasarkan ID
            var kd_atkInput = document.getElementById('kd_atk1');
            var nama_atkInput = document.getElementById('nama_atk1');
            var jenis_atkInput = document.getElementById('jenis_atk1');
            var stokInput = document.getElementById('stok1');

            // Set nilai input dan select dengan nilai yang diterima dari tabel
            kd_atkInput.value = kd_atk;
            nama_atkInput.value = nama_atk;
            jenis_atkInput.value = jenis_atk;
            stokInput.value = stok;
        }

        function confirmDelete(id) {
            // Tampilkan pesan konfirmasi menggunakan window.confirm()
            var result = window.confirm("Apakah yakin menghapus ATK ini ?");

            // Jika pengguna memilih "OK" dalam pesan konfirmasi, arahkan ke user/delete
            if (result) {
                window.location.href = "/atk/delete/" + id;
            }
            // Jika pengguna memilih "Cancel", tidak ada tindakan yang diambil.
        }
    </script>
@endsection
