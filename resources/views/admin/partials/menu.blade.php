<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
    
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/"><i class="fab fa-staylinked"></i>&nbsp;{{ config('app.name', 'Laravel') }}</a>
                <a class="navbar-brand hidden" href="/"><i class="fab fa-staylinked"></i></a>
            </div>
    
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav" id="am-menu">
                    <li class="active">
                        <a id="am-overview" href="{{route('admin.dashboard', ['menu' => 'overview'])}}" data-toggle="pjax" data-pjax="adm-menu"><i class="fas fw fa-tachometer-alt menu-icon"></i> Dashboard </a>
                    </li>
                    {{-- <h3 class="menu-title">Menu Verifikasi</h3> --}}
                    <li class="">
                        <a id="am-projects" href="{{route('admin.dashboard', ['menu' => 'projects'])}}"  data-toggle="pjax" data-pjax="adm-menu"> <i class="menu-icon fas fw fa-project-diagram"></i>Verifikasi Proyek</a>
                    </li>
                    <li class="">
                        <a id="am-users" href="{{route('admin.dashboard', ['menu' => 'users'])}}"  data-toggle="pjax" data-pjax="adm-menu"> <i class="menu-icon fas fw fa-users-cog"></i>Verifikasi Pengguna</a>
                    </li>
                    <li class="">
                        <a id="am-donations" href="{{route('admin.dashboard', ['menu' => 'donations'])}}"  data-toggle="pjax" data-pjax="adm-menu"> <i class="menu-icon fas fw fa-coins"></i>Verifikasi Donasi</a>
                    </li>
                    {{-- <h3 class="menu-title">Menu Kostumisasi</h3> --}}
                    <li class="">
                        <a id="am-withdrawal" href="{{route('admin.dashboard', ['menu' => 'withdrawal'])}}"  data-toggle="pjax" data-pjax="adm-menu"> <i class="menu-icon fas fw fa-money-bill-wave"></i>Pencairan Dana</a>
                    </li>
                    <li class="">
                        <a id="am-category" href="{{route('admin.dashboard', ['menu' => 'category'])}}"  data-toggle="pjax" data-pjax="adm-menu"> <i class="fas fw fa-sitemap menu-icon"></i>Kategori Proyek</a>
                    </li>
                    <li class="">
                        <a id="am-banks" href="{{route('admin.dashboard', ['menu' => 'banks'])}}"  data-toggle="pjax" data-pjax="adm-menu"> <i class="menu-icon fas fw fa-university"></i>Daftar Bank</a>
                    </li>
                    <li class="">
                        <a id="am-bank-accounts" href="{{route('admin.dashboard', ['menu' => 'bank-accounts'])}}"  data-toggle="pjax" data-pjax="adm-menu"> <i class="menu-icon fas fw fa-money-check"></i>Daftar Akun Bank</a>
                    </li>
                    <div class="d-block d-md-none">
                        {{-- <h3 class="menu-title">Akun Saya</h3> --}}
                        <li class="">
                            <a id="am-logout" href="{{route('admin.logout')}}"><i class="menu-icon fw fas fa-sign-out-alt"></i>Keluar</a>
                        </li>
                    </div>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->