@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">DATA KARYAWAN</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="bi bi-plus"></i>Tambah Karyawan
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="datatable" class="table display" style="width:100%">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Agama</th>
                    <th>Telpon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawans as $karyawan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $karyawan->nama_karyawan }}</td>
                        <td>{{ $karyawan->kd_jabatan }}</td>
                        <td>{{ $karyawan->jk }}</td>
                        <td>{{ $karyawan->tmp_lahir }}</td>
                        <td>{{ $karyawan->tgl_lahir }}</td>
                        <td>{{ $karyawan->alamat }}</td>
                        <td>{{ $karyawan->agama }}</td>
                        <td>{{ $karyawan->telp }}</td>
                        <td class=" p-1">
                            <a class="btn btn-warning btn-sm" style="font-size: 0.6rem;" data-bs-toggle="modal"
                                data-bs-target="#ubah"
                                onclick="populateModal('{{ $karyawan->id_karyawan }}', '{{ $karyawan->nama_karyawan }}', '{{ $karyawan->kd_jabatan }}',
                                '{{ $karyawan->jk }}', '{{ $karyawan->tmp_lahir }}', '{{ $karyawan->tgl_lahir }}', '{{ $karyawan->alamat }}', '{{ $karyawan->agama }}',
                                '{{ $karyawan->telp }}')">Ubah</a>
                            <a class="btn btn-danger btn-sm" style="font-size: 0.6rem;"
                                onclick="confirmDelete({{ $karyawan->id_karyawan }})">Hapus</a>
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
                    <h5 class="modal-title" id="tambahLabel">Tambah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="karyawan/save" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama</label>
                            <input class="form-control" id="nama_karyawan" name="nama_karyawan" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-7">
                                <label for="kd_jabatan" class="form-label">Jabatan</label>
                                <select class="form-select" aria-label="Default select" id="kd_jabatan" name="kd_jabatan"
                                    required>
                                    <option value="" disabled selected>- Pilih -</option>
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->kd_jabatan }}">{{ $jabatan->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" aria-label="Default select" id="jk" name="jk"
                                    required>
                                    <option value="" disabled selected> - Pilih - </option>
                                    <option value="Laki - Laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-7">
                                <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                                <input class="form-control" id="tmp_lahir" name="tmp_lahir" required>
                            </div>
                            <div class="col-5">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-7">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-select" aria-label="Default select" id="agama" name="agama"
                                    required>
                                    <option value="" disabled selected> - Pilih - </option>
                                    <option value="Islam">Islam</option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Khonghucu">Khonghucu</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <label for="telp" class="form-label">Telpon</label>
                                <input class="form-control" id="telp" name="telp" required>
                            </div>
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
                    <h5 class="modal-title" id="ubahLabel">Ubah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="karyawan/update" method="POST" autocomplete="off">
                    @csrf
                    <input style="display: none" id="id_karyawan1" name="id_karyawan">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama</label>
                            <input class="form-control" id="nama_karyawan1" name="nama_karyawan" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-7">
                                <label for="kd_jabatan" class="form-label">Jabatan</label>
                                <select class="form-select" aria-label="Default select" id="kd_jabatan1"
                                    name="kd_jabatan" required>
                                    <option value="" disabled selected>- Pilih -</option>
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->kd_jabatan }}">{{ $jabatan->nama_jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" aria-label="Default select" id="jk1" name="jk"
                                    required>
                                    <option value="" disabled selected> - Pilih - </option>
                                    <option value="Laki - Laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-7">
                                <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                                <input class="form-control" id="tmp_lahir1" name="tmp_lahir" required>
                            </div>
                            <div class="col-5">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir1" name="tgl_lahir" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control" id="alamat1" name="alamat" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-7">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-select" aria-label="Default select" id="agama1" name="agama"
                                    required>
                                    <option value="" disabled selected> - Pilih - </option>
                                    <option value="Islam">Islam</option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Khonghucu">Khonghucu</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <label for="telp" class="form-label">Telpon</label>
                                <input class="form-control" id="telp1" name="telp" required>
                            </div>
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
        function populateModal(id_karyawan, nama_karyawan, kd_jabatan, jk, tmp_lahir, tgl_lahir, alamat, agama, telp) {
            // Ambil elemen input dan select berdasarkan ID
            var id_karyawanInput = document.getElementById('id_karyawan1');
            var nama_karyawanInput = document.getElementById('nama_karyawan1');
            var kd_jabatanInput = document.getElementById('kd_jabatan1');
            var jkInput = document.getElementById('jk1');
            var tmp_lahirInput = document.getElementById('tmp_lahir1');
            var tgl_lahirInput = document.getElementById('tgl_lahir1');
            var alamatInput = document.getElementById('alamat1');
            var agamaInput = document.getElementById('agama1');
            var telpInput = document.getElementById('telp1');

            // Set nilai input dan select dengan nilai yang diterima dari tabel
            id_karyawanInput.value = id_karyawan;
            nama_karyawanInput.value = nama_karyawan;
            kd_jabatanInput.value = kd_jabatan;
            jkInput.value = jk;
            tmp_lahirInput.value = tmp_lahir;
            tgl_lahirInput.value = tgl_lahir;
            alamatInput.value = alamat;
            agamaInput.value = agama;
            telpInput.value = telp;

        }

        function confirmDelete(id) {
            // Tampilkan pesan konfirmasi menggunakan window.confirm()
            var result = window.confirm("Apakah yakin menghapus Karyawan ini ?");

            // Jika pengguna memilih "OK" dalam pesan konfirmasi, arahkan ke user/delete
            if (result) {
                window.location.href = "/karyawan/delete/" + id;
            }
            // Jika pengguna memilih "Cancel", tidak ada tindakan yang diambil.
        }
    </script>
@endsection
