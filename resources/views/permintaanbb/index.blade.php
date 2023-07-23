@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">DATA PERMINTAAN BAHAN BAKU</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a type="button" class="btn btn-outline-primary" href="permintaanbb/create">
                <i class="bi bi-plus"></i>Tambah Permintaan Bahan Baku
            </a>
        </div>
    </div>

    {{-- <div class="table-responsive"> --}}
    <table id="datatable" class="table table-striped" style="width:100%">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nomor Permintaan</th>
                <th>Tanggal Permintaan</th>
                <th>Nama Peminta</th>
                <th>Divisi Peminta</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->id_permintaan }}</td>
                    <td>{{ $data->tgl_permintaan }}</td>
                    <td>{{ $data->nama_peminta }}</td>
                    <td>{{ $data->nama_divisi }}</td>
                    <td class=" p-1">
                        <a class="btn btn-warning btn-sm" style="font-size: 0.6rem;"
                            href="/permintaanbb/edit/{{ $data->id_permintaan }}">Ubah</a>
                        <a class="btn btn-danger btn-sm" style="font-size: 0.6rem;"
                            onclick="confirmDelete('{{ $data->id_permintaan }}')">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- </div> --}}
@endsection

@section('script')
    <script>
        function confirmDelete(id) {
            // Tampilkan pesan konfirmasi menggunakan window.confirm()
            var result = window.confirm("Apakah yakin menghapus Permintaan Bahan Baku ini ?");

            // Jika pengguna memilih "OK" dalam pesan konfirmasi, arahkan ke user/delete
            if (result) {
                window.location.href = "/permintaanbb/delete/" + id;
            }
            // Jika pengguna memilih "Cancel", tidak ada tindakan yang diambil.
        }
    </script>
@endsection
