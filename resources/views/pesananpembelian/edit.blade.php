@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">PERMINTAAN ATK</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a type="button" class="btn btn-outline-primary" href="/permintaanatk">
                <i class="bi bi-box-arrow-left"></i> Kembali ke List Permintaan ATK
            </a>
        </div>
    </div>
    <form action="/permintaanatk/save" method="POST" autocomplete="off">
        @csrf
        <div class="row">
            <div class="card col-6">
                <div class="card-header bg-secondary text-white">
                    <h4>Header Informasi</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="id_permintaan" class="form-label">Nomor Permintaan</label>
                        <input class="form-control" id="id_permintaan" name="id_permintaan"
                            value="{{ $header->id_permintaan }}" readonly>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-4">
                            <label for="tgl_permintaan" class="form-label">Tanggal Permintaan</label>
                            <input type="date" class="form-control" id="tgl_permintaan" name="tgl_permintaan"
                                value="{{ $header->tgl_permintaan }}" readonly>
                        </div>
                        <div class="col-4">
                            <label for="nama_peminta" class="form-label">User</label>
                            <input class="form-control" id="nama_peminta" name="nama_peminta"
                                value="{{ $header->nama_peminta }}" readonly>
                        </div>
                        <div class="col-4">
                            <label for="nama_divisi" class="form-label">Divisi</label>
                            <label for="nama_divisi" class="form-label">User</label>
                            <input class="form-control" id="nama_divisi" name="nama_divisi"
                                value="{{ $header->nama_divisi }}" readonly>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card-header">
                </div>
                <br>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="kd_atk" class="form-label">Pilih ATK</label>
                        <select class="form-select" aria-label="Default select" id="kd_atk" name="kd_atk" required>
                            <option value="" disabled selected>- Pilih -</option>
                            @foreach ($atk as $data)
                                <option value="{{ $data->kd_atk }}">{{ $data->nama_atk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="jumlah_permintaan" class="form-label">Jumlah Permintaan</label>
                            <input type="number" class="form-control" id="jumlah_permintaan" name="jumlah_permintaan"
                                placeholder="1">
                        </div>
                        <div class="col-6">
                            <label for="tgl_butuh" class="form-label">Tanggal Dibutuhkan</label>
                            <input type="date" class="form-control" id="tgl_butuh" name="tgl_butuh"
                                value="{{ $datenow }}">
                        </div>
                    </div>
                </div>
                <div class="card-foother">
                    <div class="mb-3">
                        <div class="d-grid gap-2 col-11 mx-auto">
                            <button class="btn btn-primary" type="submit">Tambahkan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card col-6">
                <div class="card-header bg-secondary text-white">
                    <h4>Detail Informasi</h4>
                </div>
                <div class="card-body">
                    <table>
                        <table id="datatable" class="table display" style="width:100%">
                            <thead class="table-primary">
                                <tr>
                                    <th>Nama ATK</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Perlu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $data)
                                    <tr>
                                        <td>{{ $data->nama_atk }}</td>
                                        <td>{{ $data->jumlah_permintaan }}</td>
                                        <td>{{ $data->tgl_butuh }}</td>
                                        <td>
                                            <a class="btn btn-danger btn-sm" style="font-size: 0.6rem;"
                                                onclick="confirmDelete('{{ $data->id_permintaan }}', '{{ $data->kd_atk }}')">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        function confirmDelete(id, kd_atk) {
            // Tampilkan pesan konfirmasi menggunakan window.confirm()
            var result = window.confirm("Apakah yakin menghapus Barang ini ?");

            // Jika pengguna memilih "OK" dalam pesan konfirmasi, arahkan ke user/delete
            if (result) {
                window.location.href = "/permintaanatk/delete/" + id + "/" + kd_atk;
            }
            // Jika pengguna memilih "Cancel", tidak ada tindakan yang diambil.
        }
    </script>
@endsection
