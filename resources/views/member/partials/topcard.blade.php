<div class="card border-0 d-none d-lg-block">
    <img id="p-cover" class="card-img-top" src="{{asset('storage/profile_pictures/cover_default.jpg')}}" alt="Cover Photo">
    {{-- <div id="p-cover-overlay">
        <i class="fas fw fa-camera-retro"></i> Perbarui Foto Sampul</a>
    </div> --}}
    <div class="card-body p-0">
        <div class="nav nav-pills nav-fill w-100" id="h-menu">
            <a id="m-overview" class="nav-item nav-link p-3 dh-menu" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/overview')}}">Overview</a>
            <a id="m-setting" class="nav-item nav-link p-3 dh-menu" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/setting')}}">Pengaturan</a>
            <a id="m-sudut" class="nav-item nav-link p-3 dh-menu" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/sudut')}}">Jadi Sudut</a>
            <a id="m-negeri" class="nav-item nav-link p-3 dh-menu" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/negeri')}}">Jadi Negeri</a>
        </div>
    </div>
    <div class="card-img-overlay d-flex justify-content-center p-0" style="bottom:4rem">
        <div id="p-pic-container" class="text-center mr-5 mt-5">
            <img id="p-pic" class="img-thumbnail pchange" src="{{asset(Auth::user()->profile->profile_picture)}}" alt="Profile Picture">
            <a id="p-pic-overlay" class="text-white decoration-none" href="{{route('avatar.edit', ['id' => encrypt(Auth::user()->profile->id)])}}" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Perbarui Foto Profil","edit":"Simpan Perubahan", "lg":true, "cancel":"Batal", "actionUrl":"{{route('avatar.update', ['id' => encrypt(Auth::user()->profile->id)])}}", "pjax-reload":false, "pchange":true, "pchange-url":"{{route('pchange', ['id' => encrypt(Auth::user()->profile->id)])}}"}'><i class="fas fw fa-camera-retro"></i> Perbarui Foto Profil</a>
        </div>
        <div id="p-data" class="mt-5">
            <div class="">
                <span class="--text _head">{{Auth::user()->profile->name}}
                    <small>
                        <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" data-toggle="pjax" data-pjax="menu" class="p-0 text-white"><i class="fas fa-edit"></i></a>
                    </small>
                </span>
            </div>

            <ul class="list-inline">
                <li class="list-inline-item mr-5">
                    <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" data-toggle="pjax" data-pjax="menu" class="text-white decoration-none">
                        <span class="--text">Proyek</span>
                        <span class="--text _head">{{Auth::user()->projects->count()}}</span>
                    </a>
                </li>
                <li class="list-inline-item mr-5">
                    <a data-toggle="pjax" data-pjax="menu" href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}" class="text-white decoration-none">
                        <span class="--text">Aktivitas</span>
                        <span class="--text _head">{{Auth::user()->volunteers()->where('status', 'accepted')->orWhere('status', 'finished')->count()}}</span>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a data-toggle="pjax" data-pjax="menu" href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'donations'])}}" class="text-white decoration-none">
                        <span class="--text">Investasi</span>
                        <span class="--text _head">{{Auth::user()->donations()->where('status', 'verified')->count()}}</span>
                    </a>
                </li>
            </ul>

            <span class="--text">
                @if(!is_null(Auth::user()->profile->verification))
                    @if (Auth::user()->profile->verification->status === 'verified')
                        <span class="badge badge-info align-self-center">
                            <i class="mr-1 far fw fa-check-square" data-fa-transform="grow-3"></i>
                            Pengguna terverifikasi
                        </span><br>
                    @endif
                @endif
                <span class="--text _sub mt-1">Tergabung sejak : {{Idnme::print_date(Auth::user()->created_at, false)}}</span>
            </span>
        </div>
    </div>
</div>
<div class="card border-0 d-block d-lg-none">
    <div class="card-body p-0">
        <div class="nav nav-pills nav-fill w-100" id="mh-menu">
            @switch($menu)
                @case('sudut')
                    <a class="nav-item nav-link p-1 py-2 dh-menu {{$section === 'projects' ? 'active' : ''}}" id="mobile-sudut-projects" data-toggle="pjax" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}"><small><i class="fas fw fa-project-diagram mr-2"></i>Proyek</small></a>
                    <a class="nav-item nav-link p-1 py-2 dh-menu {{$section === 'volunteer' ? 'active' : ''}}" id="mobile-sudut-volunteer" data-toggle="pjax" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'volunteer'])}}"><small><i class="fas fw fa-people-carry mr-2"></i>Relawan</small></a>
                    @if (Auth::user()->profile->verification->status !== 'verified')
                        <a class="nav-item nav-link p-1 py-2 dh-menu {{$section === 'verify' ? 'active' : ''}}" id="mobile-sudut-verify" data-toggle="pjax" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'verify'])}}"><small><i class="fas fw fa-user-check mr-2"></i>Verifikasi Akun</small></a>
                    @endif   
                    @if (Auth::user()->projects()->where('project_status', '!=', 'submitted')->count() > 0)
                        <a class="nav-item nav-link p-1 py-2 dh-menu {{$section === 'withdrawal' ? 'active' : ''}}" id="mobile-sudut-withdrawal" data-toggle="pjax" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'withdrawal'])}}"><small><i class="fas fw fa-money-bill-wave mr-2"></i>Pencairan Dana</small></a>
                    @endif
                    @break
                @case('negeri')
                    <a class="nav-item nav-link p-1 py-2 dh-menu {{$section === 'donations' ? 'active' : ''}}" id="mobile-negeri-donations" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'donations'])}}"><small><i class="fas fw fa-coins mr-2"></i>Investasi Saya</small></a>
                    <a class="nav-item nav-link p-1 py-2 dh-menu {{$section === 'activity' ? 'active' : ''}}" id="mobile-negeri-activity" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}"><small><i class="fas fw fa-hand-holding-heart mr-2"></i>Aktivitas Saya</small></a>
                    <a class="nav-item nav-link p-1 py-2 dh-menu {{$section === 'cv' ? 'active' : ''}}" id="mobile-negeri-cv" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'cv'])}}"><small><i class="fas fw fa-id-card mr-2"></i>Buat CV Saya</small></a>
                    @break
                @case('setting')
                    <a class="nav-item nav-link p-1 py-2 dh-menu {{$section === 'profile' ? 'active' : ''}}" id="mobile-setting-profile" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}"><small><i class="fas fw fa-user-edit mr-2"></i>Edit Profil</small></a>
                    <a class="nav-item nav-link p-1 py-2 dh-menu {{$section === 'account' ? 'active' : ''}}" id="mobile-setting-account" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'setting', 'section' => 'account'])}}"><small><i class="fas fw fa-user-shield mr-2"></i>Akun</small></a>
                    @break
                @default
                    
            @endswitch
            {{-- <a id="m-overview" class="nav-item nav-link p-3 dh-menu" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/overview')}}">Overview</a>
            <a id="m-setting" class="nav-item nav-link p-3 dh-menu" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/setting')}}">Pengaturan</a>
            <a id="m-sudut" class="nav-item nav-link p-3 dh-menu" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/sudut')}}">Jadi Sudut</a>
            <a id="m-negeri" class="nav-item nav-link p-3 dh-menu" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/negeri')}}">Jadi Negeri</a> --}}
        </div>
    </div>
</div>