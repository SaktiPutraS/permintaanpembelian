@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">INPUT PERMINTAAN ATK</h1>
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
                            value="{{ $id_permintaan_terakhir }}">
                    </div>
                    <div class="mb-3 row">
                        <div class="col-4">
                            <label for="tgl_permintaan" class="form-label">Tanggal Permintaan</label>
                            <input type="date" class="form-control" id="tgl_permintaan" name="tgl_permintaan"
                                value="{{ $datenow }}">
                        </div>
                        <div class="col-4">
                            <label for="nama_peminta" class="form-label">User</label>
                            <select class="form-select" aria-label="Default select" id="nama_peminta" name="nama_peminta"
                                required>
                                <option value="" disabled selected>- Pilih -</option>
                                @foreach ($user as $data)
                                    <option value="{{ $data->nama_karyawan }}">{{ $data->nama_karyawan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="nama_divisi" class="form-label">Divisi</label>
                            <select class="form-select" aria-label="Default select" id="nama_divisi" name="nama_divisi"
                                required>
                                <option value="" disabled selected>- Pilih -</option>
                                @foreach ($divisi as $data)
                                    <option value="{{ $data->nama_jabatan }}">{{ $data->nama_jabatan }}</option>
                                @endforeach
                            </select>
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
                                    <th>ATK</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection
