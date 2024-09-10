<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
$pageTitle = 'Sistem Informasi Pangan'; // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
    <div class="">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div class="info d-flex align-items-center">
                        <div class="info-item text-white mx-4">
                            <i class="bi bi-geo-alt text-warning"></i> DISPERTAPA Kabupaten Blitar
                        </div>
                        <div class="info-item text-white mx-5">
                            <i class="bi bi-telephone text-warning"></i> (0342) 801592
                        </div>
                        <div class="info-item text-white mx-5">
                            <i class="bi bi-envelope text-warning"></i> dispertablitar@blitarkab.go.id
                        </div>
                        <div class="info-item text-white mx-4">
                            <i class="bi bi-map text-warning"></i> Jl. A.Yani No.25 Blitar
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div id="topbar" class="navbar navbar-expand-md navbar-dark bg-dark p-3"
            style="background-color: #11421d !important">
            <a class="navbar-brand" href="/home">
                <img class="img-responsive" src="{{ asset('images/logo.png') }}" />
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                data-bs-target=".navbar-responsive-collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}"><i
                                class="bi bi-house-door"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('data-pangan-public') ? 'active' : '' }}"
                            href="{{ url('data-pangan-public') }}"><i class="bi bi-graph-up"></i> Data Pangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('nbmpublic') ? 'active' : '' }}" href="{{ url('nbmpublic') }}"><i
                                class="bi bi-bar-chart"></i> NBM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('publikasi-pangan-public') ? 'active' : '' }}"
                            href="{{ url('publikasi-pangan-public') }}"><i class="bi bi-journal"></i> Publikasi Pangan</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" href="#"><i class="bi bi-tag"></i> Data harga</a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ url('hargaprodusen-public') }}">Harga
                                    Produsen</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="{{ url('index/login') }}" class="btn btn-login ms-3 ml-3"><i
                        class="bi bi-box-arrow-in-right ml-3"></i>Login</a>
            </div>
        </div>
    </div>
    <div>
        <!-- Isi -->
        <div class="header-image">
            <h1>PUBLIKASI PANGAN</h1>
            <nav>
                <a href="{{ url('/') }}">BERANDA</a> > <a href="{{ url('/publikasi-pangan-public') }}">PUBLIKASI
                    PANGAN</a>
            </nav>
        </div>
        <div class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col comp-grid ">
                        <div class=" page-content">
                            <div id="datapangan-list-records">
                                <div id="page-main-content" class="table-responsive">
                                    <div class="filter-tags mb-2">
                                        <?php Html::filter_tag('search', __('Search')); ?>
                                    </div>
                                    {{-- <table class="table table-hover table-striped table-sm text-left">
                                        <thead class="table-header">
                                            <tr>
                                                <th class="td-id"> No</th>
                                                <th class="td-judul"> Judul</th>
                                                <th class="td-file"> File</th>
                                                <th class="td-tahun"> Tahun</th>
                                                <th class="td-nama"> Kecamatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($publikasiPangan as $index => $data)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $data->judul }}</td>
                                                    <td>
                                                        @if ($data->gambar)
                                                            <a href="{{ asset('storage/' . $data->file) }}"
                                                                target="_blank">Download</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $data->tahun }}</td>
                                                    <td>{{ $data->kecamatan->nama }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table> --}}
                                    <div class="container">
                                        <div class="row">
                                            @foreach ($publikasiPangan as $post)
                                                <div class="col-md-6 col-lg-4 mb-4">
                                                    <div class="card shadow-sm border-0 h-100">
                                                        <img src="{{ $post['gambar'] }}" class="card-img-top"
                                                            alt="{{ $post['judul'] }}">
                                                        <div class="card-des">
                                                            <h5 class="card-title">{{ $post['judul'] }}</h5>
                                                            <p class="card-text text-muted">{{ $post['tahun'] }}</p>
                                                            <p class="card-text text-muted">
                                                                {{ $post->kecamatan->nama ?? '-Data Kosong-' }}
                                                            <p>By : {{ $post->author ?? '-Data Kosong-' }}</p>
                                                            </p>
                                                            <a href="{{ $post['gambar'] }}" class="btn btn-success"
                                                                target="_blank">Read More</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Page custom css -->
@section('pagecss')
    <style>
        .card-des p,
        .card-des h5 {
            margin-bottom: 0px;
            margin-left: 7px;
        }

        .card-des a {
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 7px;
        }

        .card {
            opacity: 0;
            transform: translateY(20px) scale(1);
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;
        }

        .card.show {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .header-image {
            position: relative;
            background-image: url('images/sayuran.jpg');
            background-size: cover;
            background-position: center;
            padding: 60px 20px;
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }

        .header-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .header-image h1,
        .header-image nav {
            position: relative;
            z-index: 2;
        }

        .header-image h1 {
            margin: 0;
            font-size: 2.5em;
            font-weight: bold;
        }

        .header-image nav {
            margin-top: 10px;
            font-size: 1.2em;
        }

        .header-image nav a {
            color: #FFFFFF;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .header-image nav a:first-child {
            color: #FFFFFF;
        }

        .header-image nav a:first-child:hover {
            color: #FFD700;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .header-image nav a:last-child {
            color: #00FF00;
        }

        .header-image nav a:last-child:hover {
            color: #00CC00;
            text-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
        }

        .btn-login {
            margin right: 5px;
            background-color: white;
            color: black;
            border-radius: 20px;
            padding: 5px 28px;
        }

        .btn-login:hover {
            background-color: #f8f9fa;
            color: rgb(93, 92, 92);
        }
    </style>
@endsection
<!-- Page custom js -->
@section('pagejs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cards = document.querySelectorAll('.card');
            cards.forEach((card, i) => {
                setTimeout(() => {
                    card.classList.add('show');
                }, i * 150);
            });
        });
    </script>
    <script>
        document.getElementById('showImageBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah link default dari berpindah halaman
            var image = document.getElementById('postImage');
            image.style.display = 'block'; // Menampilkan gambar ketika link diklik
        });
    </script>
@endsection
