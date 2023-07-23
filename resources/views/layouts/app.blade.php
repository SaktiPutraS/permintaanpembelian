<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Aplikasi Permintaan</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    {{-- Bootstrap Dashboard --}}
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- Datatables --}}
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.5/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.5/datatables.min.js"></script>

</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-secondary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">PT MADA WIKRI TUNGGAL</a>
        <div class="navbar-nav">
            @guest
                @if (Route::has('login'))
                    <a class="btn btn-dark text-light px-3" href="{{ route('login') }}"><b>{{ __('Login') }}</b></a>
                @endif
            @else
                <a class="btn btn-dark text-light px-3" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <b>{{ __('Logout') }}</b>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/home">
                                DASHBOARD
                            </a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="#">MENU</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#masterdata" role="button"
                                aria-expanded="false" aria-controls="masterdata">
                                <i class="bi bi-archive"></i> Master Data
                            </a>
                        </li>
                        <div class="collapse px-3" id="masterdata">
                            <li class="nav-item">
                                <a class="nav-link" href="/user">
                                    <i class="bi bi-people-fill"> Data User </i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/karyawan">
                                    <i class="bi bi-people-fill"> Data Karyawan </i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/jabatan">
                                    <i class="bi bi-people-fill"> Data Jabatan </i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/bahanbaku">
                                    <i class="bi bi-box-seam"> Data Bahan Baku </i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/atk">
                                    <i class="bi bi-box-seam"> Data ATK </i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/pemasok">
                                    <i class="bi bi-building-add"> Pemasok </i>
                                </a>
                            </li>
                        </div>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ListPermintaan" role="button"
                                aria-expanded="false" aria-controls="ListPermintaan">
                                <i class="bi bi-archive"></i> List Permintaan
                            </a>
                        </li>
                        <div class="collapse px-3" id="ListPermintaan">
                            <li class="nav-item">
                                <a class="nav-link" href="/permintaanbb">
                                    <i class="bi bi-card-list"></i> Bahan Baku
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/permintaanatk">
                                    <i class="bi bi-card-list"></i> ATK
                                </a>
                            </li>
                        </div>
                        <li class="nav-item">
                            <a class="nav-link" href="/pesananpembelian">
                                <i class="bi bi-card-list"></i> List Pesanan Pembelian (PO)
                            </a>
                        </li>
                        <br>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#laporan" role="button"
                                aria-expanded="false" aria-controls="laporan">
                                LAPORAN
                            </a>
                        </li>
                        <div class="collapse px-3" id="laporan">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-clipboard-data"> Permintaan Bahan Baku Di Konfirmasi </i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-clipboard-data"> Permintaan ATK Di Konfirmasi </i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-clipboard-data"> Stock Bahan Baku </i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-clipboard-data"> Stock ATK </i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-clipboard-data"> Permintaan Bahan Baku Bulanan </i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-clipboard-data"> Permintaan ATK Bulanan </i>
                                </a>
                            </li>
                        </div>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

    @yield('modal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <script>
        new DataTable('#datatable');
        table
            .on('order.dt search.dt', function() {
                let i = 1;

                table
                    .cells(null, 0, {
                        search: 'applied',
                        order: 'applied'
                    })
                    .every(function(cell) {
                        this.data(i++);
                    });
            })
            .draw();
    </script>

    @yield('script')
</body>

</html>
