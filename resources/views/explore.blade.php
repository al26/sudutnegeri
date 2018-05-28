@extends('layouts.app')

@section('content')
     <div class="section-headline text-secondary">
        <nav id="filter-nav" class="navbar bg-light navbar-light">
            <div class="container">
                <div>
                    <h5 class="d-none d-md-block">Ada 4220 Project Membutuhkan Bantuanmu</h5>
                    <h5 class="d-block d-md-none">Menampilkan 4220 Project</h5>
                </div>
                <button class="btn btn-sm btn-danger" type="button" data-toggle="collapse" data-target="#n" aria-controls="n" aria-expanded="false" aria-label="Toggle navigation">
                    Filter <i class="fas fa-filter"></i>
                </button>
                <div class="collapse navbar-collapse" id="n">
                    <div class="mt-2 row">
                        <div class="col-12 col-md-6">
                            <select class="selectpicker show-tick" data-live-search="true" multiple data-actions-box="true" data-style="btn-primary" title="Pilih Bidang">
                                {{-- <option value="1">Semua Bidang</option> --}}
                                <option value="2" data-tokens="Pengembangan Karakter Anak">Pengembangan Karakter Anak</option>
                                <option value="3" data-tokens="Kewirausahaan">Kewirausahaan</option>
                                <option value="4" data-tokens="Kesehatan dan Lingkungan">Kesehatan dan Lingkungan</option>
                                <option value="5" data-tokens="Keterampilan">Keterampilan</option>
                                <option value="6" data-tokens="Edukasi Science Dasar">Edukasi Science Dasar</option>
                                <option value="7" data-tokens="Pendidikan Perempuan">Pendidikan Perempuan</option>
                                <option value="8" data-tokens="Wawasan Umum">Wawasan Umum</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="selectpicker show-tick" data-live-search="true" multiple data-actions-box="true" data-style="btn-primary" title="Pilih Lokasi">
                                {{-- <option value="1">Semua Lokasi</option> --}}
                                <option value="2" data-tokens="Jakarta">Jakarta</option>
                                <option value="3" data-tokens="Palembang">Palembang</option>
                                <option value="4" data-tokens="Bandung">Bandung</option>
                                <option value="5" data-tokens="Semarang">Semarang</option>
                                <option value="6" data-tokens="Surabaya">Surabaya</option>
                                <option value="7" data-tokens="Bali">Bali</option>
                                <option value="8" data-tokens="Jayapura">Jayapura</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="selectpicker show-tick" data-live-search="false" multiple data-actions-box="true" data-style="btn-primary" title="Pilih Jenis Project">
                                {{-- <option value="1">Semua Jenis</option> --}}
                                <option value="2" data-tokens="Project Dana">Project Dana</option>
                                <option value="3" data-tokens="Project Pengabdian">Project Pengabdian</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        {{-- <div class="container my-3">
            <h3>Ada 1244 Project Membutuhkan Bantuanmu</h3>
        </div> --}}
    </div> 
    {{-- <div class="section-deadline">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <select class="selectpicker" multiple title="Choose one of the following...">
                        <option>Mustard</option>
                        <option>Ketchup</option>
                        <option>Relish</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="selectpicker" multiple title="Choose one of the following...">
                        <option>Mustard</option>
                        <option>Ketchup</option>
                        <option>Relish</option>
                    </select>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="section-deadline">

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
                                    {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Buku
                                        <div class="progress w-50 position-relative">
                                            <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            <small class="justify-content-center d-flex position-absolute w-100">20 / 100 </small>
                                        </div>
                                    </li> --}}
                                </ul>
                            </div>
                            <div class="card-footer px-3">
                                {{-- <div class="btn-group btn-group-sm w-100 rounded-0" role="group">
                                    <a href="" class="btn btn-sm btn-danger w-50 rounded-0">Jadi Volunteer</a>
                                    <a href="" class="btn btn-sm btn-primary w-50 rounded-0">Mulai Investasi</a>
                                </div>	 --}}
                                <div class="row">
                                    <div class="col-6 text-left">
                                        <p class="mb-0"><small>Lokasi</small></p>
                                        <p class="mb-0">DKI Jakarta</p>
                                    </div>
                                    <div class="col-6 text-right">
                                        <p class="mb-0"><small>Sisa Hari</small></p>
                                        <p class="mb-0">20</p>
                                    </div>
                                </div>				      	
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            
        </div>
    </div>
@endsection
@section('script')
    $(function() {
        $('.selectpicker').selectpicker({
            width: auto,
            mobile: true
        });
    });
@endsection