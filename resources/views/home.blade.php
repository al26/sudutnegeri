@extends('layouts.app')
@section('bg-nav', 'bg-change')
@section('content')
    <section id="banner" class="text-center ">
        <div id="img-banner" class="carousel slide carousel-fade d-flex flex-column" data-ride="carousel">
            <div class="carousel-inner">
                @foreach (Storage::files('public/homepage_carousel') as $item)
                    <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                        <img src="{{ asset(Storage::url('public/homepage_carousel/').File::basename($item) ) }}" alt="First Image" class="img-fluid">
                    </div>
                @endforeach
            </div>
            <div id="caption-banner" class="container carousel-caption">
                {{-- <div id="left-board" class="col-12 col-lg-7 float-lg-left">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="card-board p-3">
                            <h5 class="text-capitalize cb-title">Ikut Peduli Majukan Pendidikan Indonesia</h5>
                            <h6 class="cb-desc d-none d-sm-block"><small>SudutNegeri mempertemukan antara Volunteer dan Donatur dengan bagian Indonesia yang membutuhkan bantuan pendidikan</small></h6>
                            <a href="" class="btn btn-md btn-secondary mt-3">Ikut Peduli</a>
                            <a href="" class="btn btn-md btn-light mt-3">Pelajari Lebih</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <section id="" class="bg-white py-5">
        {{-- <div class="card container p-0 border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="info-box bg-white zoom">
                            <div class="info-box-inner">
                                <h3 class="">Jadi Sudut</h3>
                                <p class="">Ceritakan masalah pendidikan di sekitarmu. Beri tahu kebutuhan masalah tersebut. Bergembiralah karena permasalahan itu akan terselesaikan dengan dukungan materi dan tenaga dari Si Negeri.</p>
                            </div>
                            <div class="info-box-icon">
                                <i class="fas fa-cubes"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-box bg-white zoom">
                            <div class="info-box-inner">
                                <h3 class="">Jadi Negeri</h3>
                                <p class="">Bantu Si Sudut menyelesaikan masalah pendidikannya dengan memberikan bantuan materi maupun tenaga.</p>
                            </div>
                            <div class="info-box-icon">
                                <i class="fas fa-cubes"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <div class="section-headline px-3 mb-5">
                        <h1 class="section-title text-center text-capitalize font-weight-bold">Bantu kami bersama {{$member->count()}} member SudutNegeri untuk majukan pendidikan di Indonesia</h1>
                        {{-- <h1 class="section-title text-center text-capitalize font-weight-bold">Peduli Pendidikan Bersama SudutNegeri</h1>
                        <h3 class="section-subtitle text-center">Bantu kami dan lebih dari 3000 orang lain untuk majukan pendidikan di Indonesia</h3> --}}
                    </div>
                    <div class="card-deck">
                        <div class="card border-0 zoom">
                            <a href="{{route('dashboard', ['menu' => 'sudut'])}}" class="decoration-none text-secondary-black">
                                <div class="card-body">
                                    <div class="mb-3 text-center">
                                        <i class="fas fw fa-lightbulb fa-7x"></i>
                                    </div>
                                    <h3 class="text-center font-weight-bold">Jadi Sudut</h3>
                                    <p class="text-center">Publikasikan proyek pendidikanmu dan dapatkan dukungan dari investor dan relawan.</p>
                                </div>
                            </a>
                        </div>
                        <div class="card border-0 zoom">
                            <a href="{{route('dashboard', ['menu' => 'negeri'])}}" class="decoration-none text-secondary-black">
                                <div class="card-body">
                                    <div class="mb-3 text-center">
                                        <i class="fas fw fa-heartbeat fa-7x"></i>
                                    </div>
                                    <h3 class="text-center font-weight-bold">Jadi Negeri</h3>
                                    <p class="text-center">Dukung proyek pendidikan Si Sudut dengan jadi investor atau relawan.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- <section id="people" class="bg-white py-3">
        <div class="section-headline px-3">
            <h1 class="section-title text-center text-capitalize font-weight-bold">Ikuti Jejak Kami</h1>
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
    </section> --}}
    <section id="info" class="py-4">
        <div class="container py-5">
            {{-- <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="info-box bg-white">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">1224</h3>
                            <p class="text-secondary">Campaign Peduli</p>
                        </div>
                        <div class="info-box-icon">
                            <i class="fas fa-cubes"></i>
                        </div>
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
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-12 col-md-4 text-center text-white">
                    {{-- <div class="d-flex justify-content-beetwen align-items-center text-white">
                        <div class="text-center mr-4">
                            <i class="fas fa-users fa-5x fw"></i>
                        </div>
                        <div class="text-left">
                            <h2 >1224</h2>
                            <p class="m-0">Si Negeri Peduli</p>
                        </div>
                    </div> --}}
                    {{-- <div class="media text-white">
                        <img class="img-fluid mr-3" src="https://via.placeholder.com/100x100" alt="Generic placeholder image" width="64" height="64">
                        <i class="fas fa-users fa-5x fw mr-4"></i>
                        <div class="media-body">
                            <h2 >1224</h2>
                            <p class="m-0">Si Negeri Peduli</p>
                        </div>
                    </div> --}}
                    <h2>1224</h2>
                    <p class="m-0">Si Negeri Peduli</p>
                </div>
                <div class="col-12 col-md-4 text-center text-white">
                    {{-- <div class="d-flex justify-content-beetwen align-items-center text-white">
                        <div class="text-center mr-4">
                            <i class="fas fa-calendar-check fa-5x fw"></i>
                        </div>
                        <div class="text-left">
                            <h2 >1224</h2>
                            <p class="m-0">Proyek Terlaksana</p>
                        </div>
                    </div> --}}
                    {{-- <div class="media text-white">
                        <img class="img-fluid mr-3" src="https://via.placeholder.com/100x100" alt="Generic placeholder image" width="64" height="64">
                        <i class="fas fa-calendar-check fa-5x fw mr-4"></i>
                        <div class="media-body">
                            <h2 >1224</h2>
                            <p class="m-0">Proyek Terlaksana</p>
                        </div>
                    </div> --}}
                    <h2 >1224</h2>
                    <p class="m-0">Proyek Terlaksana</p>
                </div>
                <div class="col-12 col-md-4 text-center text-white">
                    {{-- <div class="d-flex justify-content-beetwen align-items-center text-white">
                        <div class="text-center mr-4">
                            <i class="fas fa-angle-double-up fa-5x fw"></i>
                        </div>
                        <div class="text-left">
                            <h2 >1224</h2>
                            <p class="m-0">Investasi Berdampak</p>
                        </div>
                    </div> --}}

                    {{-- <div class="media text-white">
                        <img class="img-fluid mr-3" src="https://via.placeholder.com/100x100" alt="Generic placeholder image" width="64" height="64">
                        <i class="fas fa-angle-double-up fw" data-fa-transform="grow-100 down-25"></i>
                        <div class="media-body">
                            <h2 >1224</h2>
                            <p class="m-0">Investasi Berdampak</p>
                        </div>
                    </div> --}}
                    <h2 >1224</h2>
                    <p class="m-0">Investasi Berdampak</p>
                </div>
            </div>
        </div>
    </section>
    <section id="project" class="bg-light py-5">
        <div class="container">
            <div class="section-headline px-3 text-secondary-black">
                <h1 class="section-title text-center text-capitalize font-weight-bold">Proyek Populer</h1>
                <h3 class="section-subtitle text-center text-capitalize">Jadi volunteer atau salurkan investasi anda</h3>
            </div>
            <div class="section-content">
                <div class="owl-carousel">
                    @foreach ($projects as $project)    
                        @php
                            $progressDana = round(($project->collected_funds / $project->funding_target) * 100);
                            $progressRelawan = round(($project->registered_volunteer / $project->volunteer_quota) * 100);

                            // date_default_timezone_set('Asia/Jakarta');

                            // $today = new DateTime('now');
                            // $deadline = new DateTime($project->project_deadline);
                            // $remainingDays = $today->diff($deadline)->format('%d hari'); 
                            // $remainingHours = $today->diff($deadline)->format('%h jam'); 

                            // if($remainingDays <= 0) {
                            //     $remainingDays = $remainingHours;
                            // }
                            // if($remainingDays <= 0 && $remainingHours < 0) {
                            //     $remainingDays = "Proyek berakhir";
                            // }
                        @endphp
                        <div class="card card-shadow m-0 border-0" style="min-height:485px">
                            <div class="category-flag">
                                <p>{{$project->category->category}}</p>
                            </div>
                            <img class="card-img-top" src="{{asset($project->project_banner)}}" alt="Card image cap">
                            <div class="media campaigner">
                                <img class="mr-3" src="{{asset($project->user->profile->profile_picture)}}" alt="Profile Picture">
                                <div class="media-body">
                                    {{$project->user->profile->name}}
                                </div>
                            </div>
                            <div class="card-header bg-white font-weight-bold">
                                <a href="{{route('project.show', ['slug' => $project->project_slug])}}" class="card-link"><h5 class="card-title m-0">{{$project->project_name}}</h5></a>
                            </div>
                            <div class="card-body pb-0 pt-4 _project-info" id="info-{{$project->project_slug}}">
                                <div class="row m-0">
                                    <span class="col-12 --text p-0">Lokasi</span>
                                    <span class="col-12 --text p-0 mb-2 font-weight-bold">{{ucwords(strtolower($project->location->name))}}</span>
                                    
                                    <span class="col-12 --text p-0">Batas Pendaftaran Relawan</span>
                                    <span class="col-12 --text p-0 mb-2 font-weight-bold">{{Idnme::print_date($project->close_reg, true)}}</span>
                                    
                                    <span class="col-12 --text p-0">Batas Penerimaan Investasi</span>
                                    <span class="col-12 --text p-0 m-0 font-weight-bold">{{Idnme::print_date($project->close_donation, true)}}</span>
                                </div>
                            </div>
                            <div class="card-body pb-0 pt-4 _project-progress hidden" id="progress-{{$project->project_slug}}">
                                <div class="info-donasi">
                                    <span class="--text text-capitalize">investasi terkumpul {{$progressDana}}%</span>
                                    <span class="--text font-weight-bold text-capitalize">{{Idnme::print_rupiah($project->collected_funds, false, true)}}</span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{$progressDana}}%"></div>
                                    </div>
                                    <span class="--text text-capitalize">target {{Idnme::print_rupiah($project->funding_target)}}</span>
                                </div>
                                <hr class="mt-1 mb-2">
                                <div class="info-relawan">
                                    <span class="--text "><b>{{empty($project->registered_volunteer) ? "0" : $project->registered_volunteer}}</b> relawan tergabung dari target <b>{{$project->volunteer_quota}}</b> relawan</span>
                                </div>
                            </div>
                            <div class="card-footer bg-lighten">
                                <button class="btn btn-link text-secondary-black decoration-none w-100 p-0" onclick="javascript:showAndHide(this, '#info-{{$project->project_slug}}', '#progress-{{$project->project_slug}}', 'Lihat Detail Proyek', 'Lihat Progress');" data-action="hide">Lihat Progresss</button>
                            </div>
                            {{-- <div class="card-body">
                                <ul class="nav nav-pills" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                                </div>
                            </div> --}}
                            
                            {{-- <div class="project-needs">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <p class="mb-0"><i class="fas fw fa-map-marker-alt mr-2"></i><small>{{$project->project_location}}</small></p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Dana
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{$progressDana}}%;" aria-valuenow="{{$progressDana}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            <small class="progress-capt">{{$progressDana}} %</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Relawan
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{$progressRelawan}}%;" aria-valuenow="{{$progressRelawan}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            <small class="progress-capt">{{$progressRelawan}}%</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <p class="mb-0"><i class="fas fw fa-calendar-times mr-1"></i> <small>{{$remainingDays}} lagi</small></p>
                                    </li>
                                </ul>
                            </div> --}}
                            {{-- <div class="card-footer px-3">
                                <div class="row">
                                    <div class="col-6 text-left">
                                        <p class="mb-0"><small>Lokasi</small></p>
                                        <p class="mb-0">{{$project->project_location}}</p>
                                    </div>
                                    <div class="col-6 text-right">
                                        <p class="mb-0"><small>Sisa Waktu</small></p>
                                        <p class="mb-0" id="remainingTime">{{$remainingDays}}</p>
                                    </div>
                                </div>				      	
                            </div> --}}
                            {{-- <a class="cml text-white" href="{{route('project.show', ['slug' => $project->project_slug])}}">
                                <span>
                                    <i class="fas fa-external-link-alt fa-2x"></i><br>
                                    Lihat <br>Project
                                </span>
                            </a> --}}
                        </div>
                    @endforeach
                    {{-- @foreach ($projects as $project)    
                        @php
                            $progressDana = round(($project->funding_progress / $project->funding_target) * 100);
                            $progressRelawan = round(($project->registered_volunteer / $project->volunteer_quota) * 100);

                            date_default_timezone_set('Asia/Jakarta');

                            $today = new DateTime('now');
                            $deadline = new DateTime($project->project_deadline);
                            $remainingDays = $today->diff($deadline)->format('%d hari'); 
                            $remainingHours = $today->diff($deadline)->format('%h jam'); 

                            if($remainingDays <= 0) {
                                $remainingDays = $remainingHours;
                            }
                            if($remainingDays <= 0 && $remainingHours < 0) {
                                $remainingDays = "Proyek berakhir";
                            }
                        @endphp
                        <div class="d-campaigns col-12 col-sm-6 col-lg-4 card-deck">
                            <div class="card m-0 mb-3 border">
                                <img class="card-img-top rounded-0" src="https://via.placeholder.com/600x400" alt="Card image cap">
                                <div class="card-body py-0 px-3 pt-3" style="top:0">
                                    <h5 class="card-title text-danger">{{$project->project_name}}</h5>
                                    <p class="card-text">{!!$project->project_description!!}</p>
                                </div>
                                <div class="project-needs">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Dana
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{$progressDana}}%;" aria-valuenow="{{$progressDana}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                <small class="progress-capt">{{$progressDana}} %</small>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Relawan
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{$progressRelawan}}%;" aria-valuenow="{{$progressRelawan}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                <small class="progress-capt">{{$progressRelawan}}%</small>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer px-3">
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <p class="mb-0"><small>Lokasi</small></p>
                                            <p class="mb-0">{{$project->project_location}}</p>
                                        </div>
                                        <div class="col-6 text-right">
                                            <p class="mb-0"><small>Sisa Waktu</small></p>
                                            <p class="mb-0" id="remainingTime">{{$remainingDays}}</p>
                                        </div>
                                    </div>				      	
                                </div>
                                <a class="cml text-white" data-toggle="pjax" data-pjax="main-content" href="{{route('project.manage', ['slug' => $project->project_slug])}}" onclick="javascript:$(this).setBackUrl();">
                                    <span>
                                        <i class="fas fa-cogs fa-2x"></i><br>
                                        Kelola <br>Project
                                    </span>
                                </a>        
                            </div>
                        </div>
                    @endforeach --}}
                </div>
                <div class="customNavigation mt-3">
                    <a class="btn btn-md oc-prev text-white btn-primary d-xl-none"><i class="fas fa-chevron-left" data-fa-transform="grow-10"></i></a>
                    <a href="{{ route('project.browse', ['category' => 'all']) }}" class="btn btn-md btn-primary mx-1">Lihat Semua Proyek</a>
                    <a class="btn btn-md oc-next text-white btn-primary d-xl-none"><i class="fas fa-chevron-right" data-fa-transform="grow-10"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section id="" class="">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body p-0">
                    <a href="">
                        <img src="https://via.placeholder.com/1024x500" class="img-fluid" alt="Responsive image" style="width: 100%;">
                    </a>
                </div>
            </div>
        </div>
    </section>
    
@endsection
@section('script')
<script>
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
                    items: 4,
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
        
        
        // accordion.init({
        //     id: 'accordion'
        // });        
    });
</script>
@endsection