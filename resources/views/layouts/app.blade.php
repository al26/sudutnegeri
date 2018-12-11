<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <!-- owl carousel plugin -->
    {{-- <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/dataTables-bs4.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/summernote-bs4.css') }}"> --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body class="@yield('body-bg')">
        {{-- @yield('bg-nav', 'bg-gradient-secondary') --}}
    <div id="app">
        <nav id="main-nav" class="navbar navbar-expand-lg navbar-dark @yield('bg-nav', 'bg-gradient-secondary')" style="height:3rem">
            <div class="container">
                <button class="navbar-toggler p-0 border-0 text-light" type="button" data-toggle="search">
                    <span class="fas fa-search"></span>
                </button>
                <a class="navbar-brand p-0" href="{{ url('/') }}">
                    {{-- <img class="" src="{{asset('storage/app_logo/logo.png')}}" alt="{{ config('app.name', 'SudutNegeri') }}"> --}}
                    <i class="fab fw fa-staylinked text-white" data-fa-transform="grow-5"></i>
                    {{ config('app.name', 'SudutNegeri') }}
                </a>
                <button class="navbar-toggler p-0 border-0 text-light" type="button" data-toggle="offcanvas">
                    <span class="fas fa-th-list"></span>
                </button>

                <div class="navbar-collapse search-collapse d-block d-lg-none" id="navbarSearch">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-row justify-content-between align-items-center">
                                    <h4 class="card-title m-0">Cari Proyek</h4> 
                                    <button class="navbar-toggler p-0 border-0 text-secondary-black" type="button" data-toggle="search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="text" name="search" placeholder="Cari judul atau lokasi proyek" id="mobile-project-search" onkeyup="javascript:getSearcResult(this, '#mobile-project-search-result');">
                                <span id="mobile-project-search-result"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="navbar-collapse offcanvas-collapse d-block d-lg-none bg-white" id="navbarMenu">
                    <div class="card p-0 border-0 rounded-0">
                        @guest
                            <div class="card-body bg-gradient-secondary">
                                <p class="card-text text-light">Ayo bantu majukan pendidikan di Indonesia.</p>
                                <div class="d-flex flex-row justify-content-start">
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light mr-2"><i class="fas fa-sign-in-alt fw"></i> Masuk</a>
                                    <a href="{{ route('register') }}" class="btn btn-sm btn-outline-light mr-2"><i class="fas fa-user-plus fw"></i> Daftar</a>
                                </div>
                            </div>
                        @else
                            <div class="card-body bg-gradient-secondary media">
                                <div class="media-body">
                                    <p class="my-0 text-light lead">{{ Auth::user()->profile->name }}
                                        <small>
                                            <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" class="p-0 text-white"><i class="fas fa-edit"></i></a>
                                        </small>
                                    </p>
                                    <p class="my-0 text-light">{{ Auth::user()->email }}</p>
                                    <span class="--text text-white">
                                        @if(!is_null(Auth::user()->profile->verification))
                                            @if (Auth::user()->profile->verification->status === 'verified')
                                                <span class="badge badge-info align-self-center">
                                                    <i class="mr-1 far fw fa-check-square" data-fa-transform="grow-3"></i>
                                                    Pengguna terverifikasi
                                                </span><br>
                                            @endif
                                            @if (Auth::user()->profile->verification->status === 'pending')
                                                <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'verify'])}}" class="badge badge-warning align-self-center">
                                                    <i class="mr-1 fas fw fa-pause" data-fa-transform="grow-3"></i>
                                                    Belum terverifikasi
                                                </a><br>
                                            @endif
                                            @if (Auth::user()->profile->verification->status === 'unverified')
                                                <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'verify'])}}" class="badge badge-danger align-self-center">
                                                    <i class="mr-1 far fw fa-window-close" data-fa-transform="grow-3"></i>
                                                    Tidak terverifikasi
                                                </a><br>
                                            @endif
                                        @endif
                                        <span class="--text _sub mt-1">Tergabung sejak : {{Idnme::print_date(Auth::user()->created_at, false)}}</span>
                                    </span>
                                </div>
                                <a href="{{route('avatar.edit', ['id' => encrypt(Auth::user()->profile->id)])}}" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Perbarui Foto Profil","edit":"Simpan Perubahan", "lg":true, "cancel":"Batal", "actionUrl":"{{route('avatar.update', ['id' => encrypt(Auth::user()->profile->id)])}}", "pjax-reload":false, "pchange":true, "pchange-url":"{{route('pchange', ['id' => encrypt(Auth::user()->profile->id)])}}"}'>
                                    <img class="d-flex ml-3 rounded-0 img-fluid img-thumbnail pchange" src="{{ asset(Auth::user()->profile->profile_picture) }}" alt="Image Icon" style="width: 100px;">
                                </a>
                            </div>
                            <ul class="list-inline m-0 py-1 px-3 bg-secondary d-flex flex-row justify-content-around">
                                <li class="list-inline-item mr-5 text-center">
                                    <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" class="text-white decoration-none">
                                        <span class="--text"><i class="fas fw fa-project-diagram mr-2"></i>Proyek</span>
                                        <span class="--text">{{Auth::user()->projects->count()}}</span>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-5 text-center">
                                    <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}" class="text-white decoration-none">
                                        <span class="--text"><i class="fas fw fa-hand-holding-heart mr-2"></i>Aktivitas</span>
                                        <span class="--text">{{Auth::user()->volunteers()->where('status', 'accepted')->orWhere('status', 'finished')->count()}}</span>
                                    </a>
                                </li>
                                <li class="list-inline-item text-center">
                                    <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'donations'])}}" class="text-white decoration-none">
                                        <span class="--text"><i class="fas fw fa-coins mr-2"></i>Investasi</span>
                                        <span class="--text">{{Auth::user()->donations()->where('status', 'verified')->count()}}</span>
                                    </a>
                                </li>
                            </ul>
                        @endguest
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="{{url('/')}}" class="list-group-item list-group-item-action dv-menu {{empty(Request::segment(1)) ? 'active' : ''}}"><i class="fas fw fa-home mr-2"></i> Beranda</a>

                                @guest
                                    <a href="{{route('login', ['continue' => urlencode(base64_encode(route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])))])}}" class="list-group-item list-group-item-action dv-menu"><i class="fas fw fa-lightbulb mr-2"></i> Jadi Sudut</a>

                                    <a href="{{route('login', ['continue' => urlencode(base64_encode(route('dashboard', ['menu' => 'negeri', 'section' => 'donations'])))])}}" class="list-group-item list-group-item-action dv-menu"><i class="fas fw fa-heartbeat mr-2"></i> Jadi Negeri</a>
                                @endguest

                                @auth  
                                    <a href="{{route('dashboard', ['menu' => 'overview'])}}" class="list-group-item list-group-item-action dv-menu {{!empty(Request::segment(2)) && Request::segment(2) === 'overview' ? 'active' : ''}}"><i class="fas fw fa-tachometer-alt mr-2"></i> Dasbor</a>

                                    <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" class="list-group-item list-group-item-action dv-menu {{!empty(Request::segment(2)) && Request::segment(2) === 'sudut' ? 'active' : ''}}"><i class="fas fw fa-lightbulb mr-2"></i> Jadi Sudut</a>

                                    <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'donations'])}}" class="list-group-item list-group-item-action dv-menu {{!empty(Request::segment(2)) && Request::segment(2) === 'negeri' ? 'active' : ''}}"><i class="fas fw fa-heartbeat mr-2"></i> Jadi Negeri</a>

                                    <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'account'])}}" class="list-group-item list-group-item-action dv-menu {{!empty(Request::segment(2)) && Request::segment(2) === 'setting' ? 'active' : ''}}"><i class="fas fw fa-user-cog mr-2"></i> Pengaturan</a>
                                    
                                    {{-- <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" class="list-group-item list-group-item-action dv-menu"><i class="fas fw fa-project-diagram mr-2"></i> Proyek Saya</a>
        
                                    <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'donations'])}}" class="list-group-item list-group-item-action dv-menu"><i class="fas fw fa-coins mr-2"></i> Investasi Saya</a>
        
                                    <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}" class="list-group-item list-group-item-action dv-menu"><i class="fas fw fa-hand-holding-heart mr-2"></i> Aktivitas Saya</a> --}}
        
                                    {{-- <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'volunteer'])}}" class="list-group-item list-group-item-action dv-menu"><i class="fas fw fa-people-carry mr-2"></i> Daftar Calon Relawan</a> --}}
        
                                    @php
                                        $prop = Auth::user()->profile->toArray();
                                        $check = in_array(null, $prop);
                                    @endphp
        
                                    <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" class="list-group-item list-group-item-action dv-menu {{(!empty(Request::segment(2)) && Request::segment(2) === 'setting') && (!empty(Request::segment(3)) && Request::segment(3) === 'profile') ? 'active' : ''}}"><i class="fas fw fa-user-edit mr-2"></i> <?= $check ? 'Lengkapi' : 'Edit'?> Profil </a>

                                    {{-- <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" class="list-group-item list-group-item-action dv-menu">{!!$check ? '<i class="fas fw fa-user-edit mr-2"></i> Lengkapi Profil' : '<i class="fas fw fa-user-alt mr-2"></i> Profil Saya'!!}</a> --}}
        
                                    {{-- <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'cv'])}}" class="list-group-item list-group-item-action dv-menu"><i class="fas fw fa-id-card mr-2"></i> Buat CV</a>
        
                                    @if (Auth::user()->profile->verification->status !== 'verified')
                                        <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'verify'])}}" class="list-group-item list-group-item-action dv-menu "><i class="fas fw fa-user-check mr-2"></i> Verifikasi Akun</a>
                                    @endif --}}
                                    
                                    @if(empty(Auth::user()->password))
                                        <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'account'])}}" class="list-group-item list-group-item-action dv-menu" {{(!empty(Request::segment(2)) && Request::segment(2) === 'setting') && (!empty(Request::segment(3)) && Request::segment(3) === 'account') ? 'active' : ''}}><i class="fas fw fa-user-lock mr-2"></i> Buat Password</a>
                                    @endif
                                @endauth
                                <a href="" class="list-group-item list-group-item-action dv-menu"><i class="fas fw fa-file-signature mr-2"></i> Syarat dan Ketentuan</a>
    
                                <a href="" class="list-group-item list-group-item-action dv-menu"><i class="fas fw fa-unlock mr-2" data-fa-transform="shrink-10 down-2 right-2" data-fa-mask="fas fa-file"></i> Kebijakan Privasi</a>
    
                                <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}" class="list-group-item list-group-item-action dv-menu"><i class="fas fw fa-question-circle mr-2"></i> Pusat Bantuan</a>
                                @auth
                                    <a class="list-group-item list-group-item-action dv-menu" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i class="fas fw fa-sign-out-alt mr-2"></i> {{ __('Keluar') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endauth
                            </div>
                        </div>
                        {{-- <hr> --}}
                        {{-- <div class="card-body p-0">
                            <div class="list-group">
                                <a href="" class="list-group-item list-group-item-action border-0 text-secondary"><i class="fas fw fa-lightbulb mr-2"></i> Syarat dan Ketentuan</a>
    
                                <a href="" class="list-group-item list-group-item-action border-0 text-secondary"><i class="fas fw fa-heartbeat mr-2"></i>Kebijakan Privasi</a>
    
                                <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}" class="list-group-item list-group-item-action border-0 text-secondary"><i class="fas fw fa-heartbeat mr-2"></i>Pusat Bantuan</a>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="desktopNavbar">
                    {{-- <ul class="navbar-nav mr-auto">
                        <li> --}}
                            {{-- <form class="form-inline d-inline" action="/action_page.php">
                                <div class="input-group">
                                    <input class="form-control rounded-0 py-2 px-3 text-light" type="text" placeholder="Cari project" autocomplete="false">
                                    <span class="input-group-btn p-1">
                                        <button class="btn btn-secondary rounded-circle py-1 px-2 text-light" type="submit"><i class="fas fa-search"></i></button>
                                    </span>
                                </div>
                            </form> --}}
                            <div class="row mx-auto">
                                <div class="col-12 p-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="search" placeholder="Cari judul atau lokasi proyek" id="project-search" onkeyup="javascript:getSearcResult(this, '#project-search-result');">
                                        <span id="project-search-result"></span>
                                    </div>
                                </div>
                            </div>
                        {{-- </li>
                    </ul> --}}

                </div>
                <ul class="navbar-nav ml-auto d-none d-lg-block">
                    @guest
                        <li class="nav-item">
                            <div class="d-flex justify-content between align-items-center">
                                <a class="btn btn-md main-auth-btn text-capitalize mr-2" href="{{ route('login') }}"><i class="fas fa-sign-in-alt fw"></i> masuk</a>
                                <a class="btn btn-md main-auth-btn text-capitalize" href="{{ route('register') }}"><i class="fas fa-user-plus fw"></i> daftar</a>
                            </div>
                        </li>
                        {{-- <li class="nav-item"><a class="btn btn-md main-auth-btn text-capitalize" href="{{ route('login') }}">masuk <i class="fas fa-sign-in-alt fw"></i></a></li>
                        <li class="nav-item"><a class="btn btn-md main-auth-btn text-capitalize" href="{{ route('register') }}">daftar <i class="fas fa-user-plus fw"></i></a></li> --}}
                    @else
                        <li class="nav-item d-flex flex-row align-items-center">
                            {{-- <a href="{{route('dashboard', ['menu' => 'overview'])}}" class="btn d-flex flex-row align-items-center" data-toggle="tooltip" data-placement="bottom" title="Dashboard">
                                <img src="{{asset(Auth::user()->profile->profile_picture)}}" alt="user_profile_picture" class="avatar"> 
                                <span class="ml-2 text-white">{{Auth::user()->profile->name}}</span>
                            </a> --}}

                            {{-- <a class="text-white decoration-none ml-3" data-toggle="tooltip" data-placement="bottom" title="Keluar"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('ds-logout-form').submit();"><i class="fas fw fa-sign-out-alt" data-fa-transform ="grow-10"></i>
                            </a>

                            <form id="ds-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form> --}}

                            <a class="d-md-flex flex-row align-items-center text-white decoration-none" id="user-desktop-menu">
                                <img src="{{asset(Auth::user()->profile->profile_picture)}}" alt="user_profile_picture" class="avatar pchange mr-3"> 
                                {{-- @php
                                    $name = explode(" ", Auth::user()->profile->name);    
                                @endphp
                                {{ $name[0] }} --}}
                            </a>
                            
                            <div id="user-desktop-menu-content" class="border-0" style="display:none">
                                <div class="card border-0 p-0">
                                    <div class="card-body border-bottom px-3 py-2">
                                        <h4 class="mb-2"><b>{{Auth::user()->profile->name}}</b></h4>
                                        <p class="m-0">{{Auth::user()->email}}</p>
                                    </div>
                                </div>
                                <div class="list-group border-0" style="min-width:200px">
                                    <a href="{{route('dashboard', ['menu' => 'overview'])}}" class="list-group-item list-group-item-action border-0"><i class="fas fw fa-tachometer-alt mr-2"></i> Dashboard</a>

                                    <a href="{{route('dashboard', ['menu' => 'sudut'])}}" class="list-group-item list-group-item-action border-0"><i class="fas fw fa-lightbulb mr-2"></i> &nbsp;&nbsp;Jadi Sudut</a>
                                    
                                    <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'donations'])}}" class="list-group-item list-group-item-action border-0"><i class="fas fw fa-heartbeat mr-2"></i> &nbsp;Jadi Negeri</a>
                                    
                                    @php
                                        $prop = Auth::user()->profile->toArray();
                                        $check = in_array(null, $prop);
                                    @endphp

                                    <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" class="list-group-item list-group-item-action border-0"><i class="fas fw fa-user-edit mr-2"></i> <?= $check ? 'Lengkapi' : 'Edit'?> Profil</a>
                                    
                                    @if(empty(Auth::user()->password))
                                        <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'account'])}}" class="list-group-item list-group-item-action border-0"><i class="fas fw fa-key mr-2"></i>  &nbsp;Buat Password</a>
                                    @endif
                                    
                                    <a class="list-group-item list-group-item-action border-top-0 border-left-0 border-right-0 dv-menu" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('ds-logout-form').submit();"><i class="fas fw fa-sign-out-alt mr-2"></i> Keluar 
                                    </a>

                                    <form id="ds-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main id="main-content" data-pjax-container>
            @include('layouts.partials._alert')
            @yield('content')
        </main>
        
        @include('components.modal')
        
        <footer class="footer bg-white">
            <div class="row line-col">
                <div class="col-2 bg-primary"></div>
                <div class="col-2 bg-dark"></div>
                <div class="col-2 bg-danger"></div>
                <div class="col-2 bg-success"></div>
                <div class="col-2 bg-warning"></div>
                <div class="col-2 bg-info"></div>
            </div>
            <div class="container d-none d-lg-block py-3">
                <div class="row">
                    <div class="col-lg-4 pt-3 text-justify">
                        <h5 class="font-weight-bold mb-3">
                            <a class="btn-link text-black" href="{{ url('/') }}">SudutNegeri</a>
                            <small> adalah platform yang mempertemukan antara Volunteer dan Donatur dengan bagian Indonesia yang membutuhkan bantuan pendidikan</small>
                        </h5>
                        <h5 class="font-weight-bold mb-3">
                            <a class="btn-link text-black" href="https://www.google.com/maps/place/Kantin+Anomali/@-7.0602897,110.4412979,19z/data=!4m5!3m4!1s0x2e708f5692f77917:0x100e1550e74adcbe!8m2!3d-7.0603483!4d110.4418451">Jl. Gondang Raya</a><br>
                            <small>Bulusan, Tembalang, Kota Semarang, Jawa Tengah 50275</small>
                        </h5>
                        <ul class="mr-sm-auto my-0 list-inline">
                            <li class="list-inline-item"><a href="#" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fab fa-facebook-f rounded-0 social-icon fb"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Google Plus"><i class="fab fa-google-plus-g rounded-0 social-icon g-plus"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fab fa-youtube rounded-0 social-icon youtube"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fab fa-instagram rounded-0 social-icon ig"></i></a></li>
                        </ul>
                        {{-- <h5 class="font-weight-bold">Didukung Oleh :</h5>
                        <ul class="list-inline">
                            @foreach (Storage::files('public/sponsors_logo') as $item)
                                <li class="list-inline-item">
                                    <img src="{{ asset(Storage::url('public/sponsors_logo/').File::basename($item)) }}" class="img-fluid">
                                </li>
                            @endforeach
                        </ul> --}}
                    </div>
                    <div class="col-lg-3 pt-3">
                        <h5 class="font-weight-bold">Bidang Pendidikan</h5>
                        <ul class="list-group list-group-flush">
                            @php
                                $sectors = App\Category::all();
                            @endphp
                            @foreach ($sectors as $key => $s)
                                <li class="px-0 py-1 list-group-item {{$loop->first ? 'border-top-0' : ''}}"><a href="{{route('project.browse', ['category' => $s->slug])}}" class="decoration-none p-0 btn btn-link text-secondary-black">
                                    <small>{{$s->category}}</small>
                                </a></li>    
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-3 pt-3">
                        <h5 class="font-weight-bold">Pelajari Lebih</h5>
                        <ul class="list-group list-group-flush">
                            <li class="px-0 py-1 list-group-item border-top-0"><a href="#" class="decoration-none p-0 btn btn-link text-secondary-black">
                                <small>Apa itu SudutNegeri ?</small>
                            </a></li>
                            <li class="px-0 py-1 list-group-item"><a href="#" class="decoration-none p-0 btn btn-link text-secondary-black">
                                <small>FAQ (Pertanyaan Populer)</small>
                            </a></li>
                            <li class="px-0 py-1 list-group-item"><a href="#" class="decoration-none p-0 btn btn-link text-secondary-black">
                                <small>Pelajari Sudut</small>
                            </a></li>
                            <li class="px-0 py-1 list-group-item"><a href="#" class="decoration-none p-0 btn btn-link text-secondary-black">
                                <small>Pelajari Negeri</small>
                            </a></li>
                            <li class="px-0 py-1 list-group-item"><a href="#" class="decoration-none p-0 btn btn-link text-secondary-black">
                                <small>Syarat dan Ketentuan</small>
                            </a></li>
                            <li class="px-0 py-1 list-group-item"><a href="#" class="decoration-none p-0 btn btn-link text-secondary-black">
                                <small>Kebijakan Privasi</small>
                            </a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 pt-3">
                        <h5 class="font-weight-bold">Dukungan</h5>
                        <ul class="list-group list-group-flush">
                            {{-- <li class="px-0 py-1 list-group-item border-top-0"><a href="" class="decoration-none p-0 btn btn-link text-secondary-black">
                                <small>Tips Project</small>
                            </a></li> --}}
                            <li class="px-0 py-1 list-group-item border-top-0"><a href="#" class="decoration-none p-0 btn btn-link text-secondary-black">
                                <small>Transaksi</small>
                            </a></li>
                            <li class="px-0 py-1 list-group-item"><a href="#" class="decoration-none p-0 btn btn-link text-secondary-black">
                                <small>Kontak Kami</small>
                            </a></li>
                            <li class="px-0 py-1 list-group-item"><a href="#" class="decoration-none p-0 btn btn-link text-secondary-black">
                                <small>Kepercayaan dan Keamanan</small>
                            </a></li>
                        </ul>
                    </div>
                    {{-- <div class="col-lg-2 pt-3">
                        <h5 class="font-weight-bold  text-light">Ikut Peduli</h5>
                        <ul class="list-unstyled">
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Investasi</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Menjadi Negeri</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Menjadi Sudut</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>For CSR</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>For NGO</small>
                            </a></li>
                        </ul>
                    </div> --}}
                    
                    {{-- <div class="col-12 d-block d-lg-none px-3">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="" class="p-0 text-white"><small>Pelajari Sudut</small></a></li>
                            <li class="list-inline-item"><a href="" class="p-0 text-white"><small>Pelajari Negeri</small></a></li>
                            <li class="list-inline-item"><a href="" class="p-0 text-white"><small>Tips Project</small></a></li>
                            <li class="list-inline-item"><a href="" class="p-0 text-white"><small>Kepercayaan & Keamanan</small></a></li>
                            <li class="list-inline-item"><a href="" class="p-0 text-white"><small>Kontak Kami</small></a></li>
                        </ul>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-12 text-left">
                        <h5 class="font-weight-bold mb-3">Didukung Oleh</h5>
                        <ul class="list-inline">
                            @foreach (Storage::files('sponsors_logo') as $item)
                                <li class="list-inline-item">
                                    <img src="{{ asset(Storage::url('sponsors_logo/').File::basename($item)) }}" class="img-fluid rounded border p-2">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            
            <nav class="navbar navbar-dark d-block bg-secondary">
                <div class="container p-0 py-2">
                    <ul class="mr-sm-auto my-0 list-inline d-block d-lg-none">
                        <li class="list-inline-item"><a href="#" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fab fa-facebook-f rounded-0 social-icon fb"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Google Plus"><i class="fab fa-google-plus-g rounded-0 social-icon g-plus"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fab fa-youtube rounded-0 social-icon youtube"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fab fa-instagram rounded-0 social-icon ig"></i></a></li>
                    </ul>

                    <ul class="mr-lg-auto ml-lg-0 ml-sm-auto my-2 my-sm-0 list-inline d-none d-md-block">
                        <li class="list-inline-item text-white">Copyright &copy; {{date('Y')}} SudutNegeri. All Rights Reserved</li>
                    </ul>
                </div>
            </nav>
            <a id="scroll" href="javascript:void(0);" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left" style="display:none;"><span class="glyphicon glyphicon-chevron-up"></span></a>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        FontAwesomeConfig = { searchPseudoElements: true };
    </script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
    $(function(){
        // Enables popover
        $("#user-desktop-menu").popover({
            container : 'body',
            placement : 'bottom',
            html : true, 
            content: function() {
                return $("#user-desktop-menu-content").html();
            }, 
        });

        $('#user-desktop-menu').on('shown.bs.popover', function () {
            $('.popover-body').css('padding', 0);
        });
    });
    </script>
    <script>
        $(document).ready(function() {
            $(document).loadModal();
        });
    </script>
    @yield('script')
</body>
</html>
