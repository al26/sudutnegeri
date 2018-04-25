@extends('layouts.app')
@section('bg-nav', 'bg-change')
@section('content')
    <section id="banner" class="text-center ">
        <div id="img-banner" class="carousel slide d-flex flex-column" data-ride="carousel">
            <div class="carousel-inner">
                @foreach (Storage::files('public/homepage_carousel') as $item)
                    <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                        <img src="{{ asset(Storage::url('public/homepage_carousel/').File::basename($item) ) }}" alt="First Image" class="img-fluid">
                    </div>
                @endforeach
            </div>
            <div id="caption-banner" class="container carousel-caption">
                <div id="left-board" class="col-12 col-lg-7 float-lg-left">
                    <div class="card bg-transparent border-0">
                        <div class="card-body p-0">
                            <h5 id="" class="card-title text-uppercase">Ikut Peduli Majukan Pendidikan Indonesia</h5>
                            <p id="" class="card-text d-none d-sm-block">SudutNegeri mempertemukan antara Volunteer dan Donatur dengan bagian Indonesia yang membutuhkan bantuan pendidikan</p>
                            <a href="{{ route('project.browse', ['category' => 'all']) }}" class="btn btn-sm btn-primary mt-2">Ikut Peduli</a>
                        </div>
                    </div>
                </div>
                <div id="right-board" class="col-lg-5 float-lg-right d-none d-md-block">
                    <div class="card bg-transparent border-0">
                        <div class="card-body p-0">
                            {{-- <ul class="list-unstyled m-0 p-0">
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
                            </ul> --}}
                            <div class="row">
                                <div class="col-md-6 col-12 px-1 info-box-parent">
                                    <div class="info-box">
                                        <div class="info-box-inner">
                                            <h3 class="text-secondary">1224</h3>
                                            <p class="text-secondary">Campaign Peduli</p>
                                        </div>
                                        <div class="info-box-icon">
                                            <i class="fas fa-cubes"></i>
                                        </div>
                                        {{-- <a href="#" class="small-box-footer">
                                        More info <i class="fa fa-arrow-circle-right"></i>
                                        </a> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 px-1 info-box-parent">
                                    <div class="info-box">
                                        <div class="info-box-inner">
                                            <h3 class="text-secondary">1224</h3>
                                            <p class="text-secondary">Project Terlaksana</p>
                                        </div>
                                        <div class="info-box-icon">
                                            <i class="fas fa-cubes"></i>
                                        </div>
                                        {{-- <a href="#" class="small-box-footer">
                                        More info <i class="fa fa-arrow-circle-right"></i>
                                        </a> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 px-1 info-box-parent">
                                    <div class="info-box">
                                        <div class="info-box-inner">
                                            <h3 class="text-secondary">122478</h3>
                                            <p class="text-secondary">Si Negeri Peduli</p>
                                        </div>
                                        <div class="info-box-icon">
                                            <i class="fas fa-cubes"></i>
                                        </div>
                                        {{-- <a href="#" class="small-box-footer">
                                        More info <i class="fa fa-arrow-circle-right"></i>
                                        </a> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 px-1 info-box-parent">
                                    <div class="info-box">
                                        <div class="info-box-inner">
                                            <h3 class="text-secondary">1224</h3>
                                            <p class="text-secondary">Investasi Berdampak</p>
                                        </div>
                                        <div class="info-box-icon">
                                            <i class="fas fa-cubes"></i>
                                        </div>
                                        {{-- <a href="#" class="small-box-footer">
                                        More info <i class="fa fa-arrow-circle-right"></i>
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- <h5 id="cb-title" class="text-capitalize">Ikut Peduli Majukan Pendidikan Indonesia</h5>
                <h6 id="cb-desc" class="d-none d-sm-block"><small>SudutNegeri mempertemukan antara Volunteer dan Donatur dengan bagian Indonesia yang membutuhkan bantuan pendidikan</small></h6>
                <a href="" class="btn btn-md btn-outline-white mt-3">Ikut Peduli</a> --}}
            </div>
        </div>
    </section>
    <section id="project" class="text-secondary py-3">
        <div class="container">
            <div class="section-headline px-3">
                <h1 class="section-title text-center text-uppercase font-weight-bold">Project Populer</h1>
                <h3 class="section-subtitle text-center text-capitalize">Jadi volunteer atau salurkan investasi anda</h3>
            </div>
            <div class="section-content">
                <div class="owl-carousel">
                    @for ($i = 0; $i < 8; $i++)
                        <div class="card m-0 border-0">
                            <img class="card-img-top" src="http://via.placeholder.com/600x400" alt="Card image cap">
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
                            <div class="card-footer px-3 py-1 border-top">
                                {{-- <div class="btn-group btn-group-sm w-100 rounded-0" role="group">
                                    <a href="" class="btn btn-sm btn-danger w-50 rounded-0">Jadi Volunteer</a>
                                    <a href="" class="btn btn-sm btn-primary w-50 rounded-0">Mulai Investasi</a>
                                </div> --}}
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
                    @endfor
                </div>
                <div class="customNavigation">
                    <a class="btn oc-prev"><i class="fas fa-caret-left fa-2x"></i></a>
                    <a href="{{ route('project.browse', ['category' => 'all']) }}" class="btn btn-sm btn-secondary">Semua Project</a>
                    <a class="btn oc-next"><i class="fas fa-caret-right fa-2x"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section id="info" class="d-block d-md-none pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="info-box bg-white">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">1224</h3>
                            <p class="text-secondary">Campaign Peduli</p>
                        </div>
                        <div class="info-box-icon">
                            <i class="fas fa-cubes"></i>
                        </div>
                        {{-- <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                        </a> --}}
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="info-box bg-white">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">1224</h3>
                            <p class="text-secondary">Project Terlaksana</p>
                        </div>
                        <div class="info-box-icon">
                            <i class="fas fa-cubes"></i>
                        </div>
                        {{-- <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                        </a> --}}
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="info-box bg-white">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">122478</h3>
                            <p class="text-secondary">Si Negeri Peduli</p>
                        </div>
                        <div class="info-box-icon">
                            <i class="fas fa-cubes"></i>
                        </div>
                        {{-- <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                        </a> --}}
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="info-box bg-white">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">1224</h3>
                            <p class="text-secondary">Investasi Berdampak</p>
                        </div>
                        <div class="info-box-icon">
                            <i class="fas fa-cubes"></i>
                        </div>
                        {{-- <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="people" class="bg-white py-3">
        <div class="section-headline px-3 text-secondary">
            <h1 class="section-title text-center text-uppercase font-weight-bold">Ikuti Jejak Kami</h1>
            <h3 class="section-subtitle text-center text-capitalize">Bantu kami dan lebih dari 3000 orang lain untuk majukan pendidikan di Indonesia</h3>
        </div>
        <div class="accordion container">
            <ul>
              @foreach (Storage::files('public/profile_pictures') as $item)
                <li style="background-image: url({{ asset(Storage::url('public/profile_pictures/').File::basename($item)) }});">
                    <div><a href=""><h2>Title x</h2><p>Content x</p></a></div>
                </li>
              @endforeach
            </ul>
        </div>
    </section>
@endsection
@section('script')
    $(document).ready(function(){
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            margin: 5,
            dots: false,
            loop: false,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:2,
                },            
                900:{
                    items:3,
                },
                1200:{
                    items: 4,
                },
                2000:{
                    items: 5,
                }
            }, 
        });

        // Custom Navigation Events
        $(".oc-next").click(function(){
            owl.trigger('next.owl.carousel');
        });
        $(".oc-prev").click(function(){
            owl.trigger('prev.owl.carousel');
        });
        
        
        accordion.init({
            id: 'accordion'
        });        
    });
@endsection