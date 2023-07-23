@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">DATA USER</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="bi bi-plus"></i>Tambah User
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="datatable" class="table display" style="width:100%">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->level }}</td>
                        <td class=" p-1">
                            <a class="btn btn-warning btn-sm" style="font-size: 0.6rem;" data-bs-toggle="modal"
                                data-bs-target="#ubah"
                                onclick="populateModal('{{ $data->id }}', '{{ $data->name }}', '{{ $data->email }}', '{{ $data->level }}')">Ubah</a>
                            <a class="btn btn-danger btn-sm" style="font-size: 0.6rem;"
                                onclick="confirmDelete({{ $data->id }})">Hapus</a>
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
                    <h5 class="modal-title" id="tambahLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="user/save" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">Kami tidak akan pernah membagikan email Anda kepada orang
                                lain.</div>
                        </div>
                        <div class="mb-3">
                            <label for="pasword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pasword" name="password" pattern=".{8,}"
                                required title="Password harus memiliki minimal 8 karakter">
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Panjangnya harus 8-20 karakter..
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select" name="level" required>
                                <option value="" disabled selected>Pilih Level</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Manager">Manager</option>
                                <option value="Karyawan">Karyawan</option>
                            </select>
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
                    <h5 class="modal-title" id="ubahLabel">Ubah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="user/update" method="POST" autocomplete="off">
                    @csrf
                    <input style="display: none" id="id1" name="id">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="name1" class="form-label">Nama</label>
                            <input class="form-control" id="name1" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email1" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email1" name="email"
                                aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">Kami tidak akan pernah membagikan email Anda kepada
                                orang
                                lain.</div>
                        </div>
                        <div class="mb-3">
                            <label for="pasword1" class="form-label">Reset Pasword</label>
                            <input type="password" class="form-control" id="pasword1" name="password" pattern=".{8,}"
                                title="Password harus memiliki minimal 8 karakter">
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Panjangnya harus 8-20 karakter..
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select" id="level1" name="level"
                                required>
                                <option value="" disabled selected>Pilih Level</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Manager">Manager</option>
                                <option value="Karyawan">Karyawan</option>
                            </select>
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
        function populateModal(id, name, email, level) {
            // Ambil elemen input dan select berdasarkan ID
            var idInput = document.getElementById('id1');
            var nameInput = document.getElementById('name1');
            var emailInput = document.getElementById('email1');
            var levelSelect = document.getElementById('level1');

            // Set nilai input dan select dengan nilai yang diterima dari tabel
            idInput.value = id;
            nameInput.value = name;
            emailInput.value = email;
            levelSelect.value = level;
        }

        function confirmDelete(id) {
            // Tampilkan pesan konfirmasi menggunakan window.confirm()
            var result = window.confirm("Apakah yakin menghapus user ini ?");

            // Jika pengguna memilih "OK" dalam pesan konfirmasi, arahkan ke user/delete
            if (result) {
                window.location.href = "/user/delete/" + id;
            }
            // Jika pengguna memilih "Cancel", tidak ada tindakan yang diambil.
        }
    </script>
@endsection
