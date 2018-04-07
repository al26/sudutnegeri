@extends('layouts.app')

@section('content')
    <section id="banner" class="text-center ">
        <div id="img-banner" class="carousel slide d-flex flex-column" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($carousel_img as $item)
                    <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                        <img src="{{ asset($carousel_url.File::basename($item) ) }}" alt="First Image" class="img-fluid">
                    </div>
                @endforeach
            </div>
            <div id="caption-banner" class="container carousel-caption">
                <div id="left-board" class="col-12 col-lg-7 float-lg-left">
                    <div class="card bg-transparent border-0">
                        <div class="card-body text-left p-0">
                            <h5 id="" class="card-title text-uppercase">Ikut Peduli Majukan Pendidikan Indonesia</h5>
                            <p id="" class="card-text">SudutNegeri mempertemukan antara Volunteer dan Donatur dengan bagian Indonesia yang membutuhkan bantuan pendidikan</p>
                            <a href="" class="btn btn-md btn-primary mt-3">Ikut Peduli</a>
                        </div>
                    </div>
                </div>
                <div id="right-board" class="col-lg-5 float-lg-right">
                    <div class="card bg-transparent border-0" style="min-height: 100px">
                        <div class="card-body p-0">
                            <ul class="list-unstyled m-0 p-0">
                                <li class="content px-3 py-5">
                                    <h3 class="text-danger m-0">1.244</h3>
                                    <p class="text-black m-0">Campaign Peduli</p>
                                </li>
                                <li class="content px-3 py-5">
                                    <h3 class="text-danger m-0">1.244</h3>
                                    <p class="text-black m-0">Project Terlaksana</p>
                                </li>
                                <li class="content px-3 py-5">
                                    <h3 class="text-danger m-0">1.244</h3>
                                    <p class="text-black m-0">Si Negeri Peduli</p>
                                </li>
                                <li class="content px-3 py-5">
                                    <h3 class="text-danger m-0">1.244</h3>
                                    <p class="text-black m-0">Investasi Berdampak</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                {{-- <h5 id="cb-title" class="text-capitalize">Ikut Peduli Majukan Pendidikan Indonesia</h5>
                <h6 id="cb-desc" class="d-none d-sm-block"><small>SudutNegeri mempertemukan antara Volunteer dan Donatur dengan bagian Indonesia yang membutuhkan bantuan pendidikan</small></h6>
                <a href="" class="btn btn-md btn-outline-white mt-3">Ikut Peduli</a> --}}
            </div>
        </div>
    </section>
    <section id="project" class="text-secondary">
        <div class="container py-3">
            <div class="section-headline mb-5">
                <h1 class="section-title text-center text-uppercase font-weight-bold">Project Populer</h1>
                <h3 class="section-subtitle text-center text-capitalize">Jadi volunteer atau salurkan investasi anda</h3>
            </div>
            <div class="section-content">
                <div class="owl-carousel">
                    <div class="card m-0 border-0 rounded-0">
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
                                    Uang
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
                    <div class="card m-0 border-0 rounded-0">
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
                                    Uang
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
                    <div class="card m-0 border-0 rounded-0">
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
                                    Uang
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
                    <div class="card m-0 border-0 rounded-0">
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
                                    Uang
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
            </div>
        </div>
    </section>
@endsection
