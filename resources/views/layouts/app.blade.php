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
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables-bs4.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="bg-light">
        <nav id="main-nav" class="navbar navbar-expand-lg navbar-dark @yield('bg-nav', 'bg-gradient-secondary')">
            <div class="container">
                <button class="navbar-toggler p-0 border-0 text-light" type="button" data-toggle="offcanvas">
                    <span class="fas fa-th-list"></span>
                </button>
                <a class="navbar-brand p-0 py-md-2 px-md-3 m-0 mr-md-3" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler p-0 border-0 text-light" type="button" data-toggle="search">
                    <span class="fas fa-search"></span>
                </button>

                <div class="navbar-collapse search-collapse p-2" id="navbarSearch">
                    <form class="form-inline d-inline w-100" action="/action_page.php">
                        <div class="input-group">
                            <input class="form-control rounded-0 p-1" type="text" placeholder="Cari project, campaign, atau pertanyaan" autocomplete="true">
                            <span class="input-group-btn">
                                <button class="btn btn-primary rounded-0" type="submit">Cari</button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="navbar-collapse offcanvas-collapse d-block d-lg-none bg-light" id="navbarMenu">
                    <div class="card bg-gradient-secondary p-3 border-0 rounded-0">
                        @guest
                            <p class="card-text text-light">Ayo bantu majukan pendidikan di Indonesia.</p>
                            <div class="d-flex flex-row justify-content-start">
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light mr-2">Masuk</a>
                                <a href="{{ route('register') }}" class="btn btn-sm btn-outline-light mr-2">Daftar</a>
                            </div>
                        @else
                            <div class="card-body media p-0">
                                <div class="media-body">
                                  <p class="my-0 text-light lead">{{ Auth::user()->profile->name }}</p>
                                  <p class="my-0 text-light">{{ Auth::user()->email }}</p>
                                  <a class="mt-3 btn btn-sm btn-primary" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                                <img class="d-flex ml-3 rounded-0 img-fluid" src="{{ asset('storage/'.Auth::user()->profile->profile_picture ?? 'profile_pictures/dummy.svg') }}" alt="Image Icon" style="width: 100px;">
                            </div>
                        @endguest
                    </div>
                    <div class="">
                        <ul class="navbar-nav mr-auto px-1 py-2 border-bottom border-secondary">
                          <li class="px-2 nav-item active">
                            <a class="nav-link text-secondary" href="#"><span class="fas fa-home w-8"></span> Home</a>
                          </li>
                          <li class="px-2 nav-item">
                            <a class="nav-link text-secondary" href="#"><span class="fas fa-money-bill-alt w-8"></span> Investasi</a>
                          </li>
                          <li class="px-2 nav-item">
                            <a class="nav-link text-secondary" href="#"><span class="fas fa-puzzle-piece w-8"></span> Menjadi Negeri</a>
                          </li>
                          <li class="px-2 nav-item">
                            <a class="nav-link text-secondary" href="#"><span class="fas fa-bullhorn w-8"></span> Menjadi Sudut</a>
                          </li>
                          <li class="px-2 nav-item">
                            <a class="nav-link text-secondary" href="#"><span class="fas fa-building w-8"></span> For Corporation / CSR</a>
                          </li>
                          <li class="px-2 nav-item">
                            <a class="nav-link text-secondary" href="#"><span class="fas fa-handshake w-8"></span> For Nonprofit Organization / NGO</a>
                          </li>
                        </ul>
                        <ul class="navbar-nav mr-auto px-1 py-2">
                          <li class="px-2 nav-item">
                            <a class="nav-link text-secondary" href="#"><span class="fas fa-file-alt w-8"></span> Syarat dan Ketentuan</a>
                          </li>
                          <li class="px-2 nav-item">
                            <a class="nav-link text-secondary" href="#"><span class="fas fa-unlock-alt w-8"></span> Kebijakan Privasi</a>
                          </li>
                          <li class="px-2 nav-item">
                            <a class="nav-link text-secondary" href="#"><span class="fas fa-question-circle w-8"></span> FAQ</a>
                          </li>
                        </ul>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="desktopNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li>
                            <form class="form-inline d-inline" action="/action_page.php">
                                <div class="input-group">
                                    <input class="form-control rounded-0 py-2 px-3 text-light" type="text" placeholder="Cari project, campaign, atau pertanyaan" autocomplete="true">
                                    <span class="input-group-btn p-1">
                                        <button class="btn btn-secondary rounded-circle py-1 px-2 text-light" type="submit"><i class="fas fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li><a class="btn btn-sm btn-danger" href="{{ route('login') }}">{{ __('Masuk') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->profile->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main id="main-content">
            @yield('content')
        </main>

        <footer class="bg-gradient-secondary mt-lg-3">
            <div class="container d-none d-lg-block">
                <div class="row">
                    <div class="col-lg-2 pt-3">
                        <h5 class="font-weight-bold  text-light">Bidang Pendidikan</h5>
                        <ul class="list-unstyled">
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Pengembangan Karakter Anak</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Kewirausahaan</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Kesehatan dan Lingkungan</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Keterampilan</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Edukasi Science Dasar</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Pendidikan Perempuan</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Wawasan Umum</small>
                            </a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 pt-3">
                        <h5 class="font-weight-bold  text-light">Pelajari Lebih</h5>
                        <ul class="list-unstyled">
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Apa itu SudutNegeri ?</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>FAQ (Pertanyaan Populer)</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Pelajari Sudut</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Pelajari Negeri</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Syarat dan Ketentuan</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Kebijakan Privasi</small>
                            </a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 pt-3">
                        <h5 class="font-weight-bold  text-light">Dukungan</h5>
                        <ul class="list-unstyled">
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Tips Project</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Transaksi</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Kontak Kami</small>
                            </a></li>
                            <li><a href="" class="p-0 btn btn-link text-light">
                                <small>Kepercayaan dan Keamanan</small>
                            </a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 pt-3">
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
                    </div>
                    <div class="col-lg-4 pt-3 text-justify">
                        <h5 class="font-weight-bold text-light">
                            <a class="btn-link" href="{{ url('/') }}">SudutNegeri</a>
                            <small> adalah platform yang mempertemukan antara Volunteer dan Donatur dengan bagian Indonesia yang membutuhkan bantuan pendidikan</small>
                        </h5>
                        <h5 class="font-weight-bold text-light">Didukung Oleh :</h5>
                        <ul class="list-inline">
                            @foreach (Storage::files('public/sponsors_logo') as $item)
                                <li class="list-inline-item">
                                    <img src="{{ asset(Storage::url('public/sponsors_logo/').File::basename($item)) }}" class="img-fluid">
                                </li>
                            @endforeach
                        </ul>
                    </div>
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
            </div>
            <nav class="navbar navbar-dark d-block">
                <div class="container p-0">
                    <ul class="mr-sm-auto my-0 list-inline">
                        <li class="list-inline-item"><a href="" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fab fa-facebook-f rounded-circle social-icon fb"></i></a></li>
                        <li class="list-inline-item"><a href="" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Google Plus"><i class="fab fa-google-plus-g rounded-circle social-icon g-plus"></i></a></li>
                        <li class="list-inline-item"><a href="" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fab fa-youtube rounded-circle social-icon youtube"></i></a></li>
                        <li class="list-inline-item"><a href="" class="nav-link p-0" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fab fa-instagram rounded-circle social-icon ig"></i></a></li>
                    </ul>

                    <ul class="ml-sm-auto my-2 my-sm-0 list-inline d-none d-md-block">
                        <li class="list-inline-item"><small class="text-light">&copy; {{date('Y')}} | All Right Reserved</small></li>
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
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        @yield('script')
    </script>
</body>
</html>
