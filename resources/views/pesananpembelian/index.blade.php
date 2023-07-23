@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">DATA PESANAN PEMBELIAN (PO)</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a type="button" class="btn btn-outline-primary" href="pesananpembelian/create">
                <i class="bi bi-plus"></i>Tambah Pesanan Pembelian
            </a>
        </div>
    </div>

    {{-- <div class="table-responsive"> --}}
    <table id="datatable" class="table table-striped" style="width:100%">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Pemasok</th>
                <th>Tanggal</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->id_pesanan }}</td>
                    <td>{{ $data->kode_pemasok }}</td>
                    <td>{{ $data->tgl_pesanan }}</td>
                    <td>{{ $data->total_harga }}</td>
                    <td class=" p-1">
                        <a class="btn btn-warning btn-sm" style="font-size: 0.6rem;"
                            href="/pesananpembelian/edit/{{ $data->id_pesanan }}">Ubah</a>
                        <a class="btn btn-danger btn-sm" style="font-size: 0.6rem;"
                            onclick="confirmDelete('{{ $data->id_pesanan }}')">Hapus</a>
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
            var result = window.confirm("Apakah yakin menghapus Pesanan Pembelian ini ?");

            // Jika pengguna memilih "OK" dalam pesan konfirmasi, arahkan ke user/delete
            if (result) {
                window.location.href = "/pesananpembelian/delete/" + id;
            }
            // Jika pengguna memilih "Cancel", tidak ada tindakan yang diambil.
        }
    </script>
@endsection
