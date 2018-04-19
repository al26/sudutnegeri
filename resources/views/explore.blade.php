@extends('layouts.app')

@section('content')
    <div class="section-headline mb-5 text-secondary">
        <div class="container">
            <h1 class="text-uppercase">project</h1>
        </div>
        <nav id="filter-nav" class="navbar navbar-expand-sm bg-light navbar-dark">
            <div class="container">
                <h3>Ada 1244 Project Membutuhkan Bantuanmu</h3>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <select class="custom-select" id="inputGroupSelect01">
                            <option value="1">Semua Bidang</option>
                            <option value="2">Pengembangan Karakter Anak</option>
                            <option value="3">Kewirausahaan</option>
                            <option value="4">Kesehatan dan Lingkungan</option>
                            <option value="5">Keterampilan</option>
                            <option value="6">Edukasi Science Dasar</option>
                            <option value="7">Pendidikan Perempuan</option>
                            <option value="8">Wawasan Umum</option>
                        </select>
                    </li>
                    <li class="nav-item">
                        <select class="custom-select" id="inputGroupSelect01">
                            <option value="1">Semua Lokasi</option>
                            <option value="2">Pengembangan Karakter Anak</option>
                            <option value="3">Kewirausahaan</option>
                            <option value="4">Kesehatan dan Lingkungan</option>
                            <option value="5">Keterampilan</option>
                            <option value="6">Edukasi Science Dasar</option>
                            <option value="7">Pendidikan Perempuan</option>
                            <option value="8">Wawasan Umum</option>
                        </select>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="section-content">
            <div class="row">
                @for ($i = 0; $i < 10; $i++)    
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <div class="card m-0 mb-3">
                            <img class="card-img-top rounded-0" src="http://via.placeholder.com/600x400" alt="Card image cap">
                            <div class="media campaigner">
                                <img class="mr-3" src="http://via.placeholder.com/200x200" alt="Generic placeholder image">
                                <div class="media-body">
                                    Nama Campaigner
                                </div>
                            </div>
                            <div class="card-body py-0 px-3">
                                <a href="" class="card-link text-danger"><h5 class="card-title">Judul Project</h5></a>
                                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                            </div>
                            <div class="project-needs">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Dana
                                        <div class="progress w-50 position-relative">
                                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            <small class="justify-content-center d-flex position-absolute w-100">25 jt / 100 jt</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Relawan
                                        <div class="progress w-50 position-relative">
                                            <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            <small class="justify-content-center d-flex position-absolute w-100">50 / 100 orang</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Buku
                                        <div class="progress w-50 position-relative">
                                            <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            <small class="justify-content-center d-flex position-absolute w-100">20 / 100 </small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer px-3">
                                <div class="btn-group btn-group-sm w-100 rounded-0" role="group">
                                    <a href="" class="btn btn-sm btn-danger w-50 rounded-0">Jadi Volunteer</a>
                                    <a href="" class="btn btn-sm btn-primary w-50 rounded-0">Mulai Investasi</a>
                                </div>					      	
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            
        </div>
    </div>
@endsection