<div class="card border-0">
    <img id="p-cover" class="card-img-top" src="{{asset('storage/profile_pictures/cover_default.jpg')}}" alt="Cover Photo">
    {{-- <div id="p-cover-overlay">
        <i class="fas fw fa-camera-retro"></i> Perbarui Foto Sampul</a>
    </div> --}}
    <div class="card-body p-0">
        <div class="nav nav-pills nav-fill w-100" id="h-menu">
            <a id="m-overview" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/overview')}}">Overview</a>
            <a id="m-setting" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/setting')}}">Pengaturan</a>
            <a id="m-sudut" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/sudut')}}">Jadi Sudut</a>
            <a id="m-negeri" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/negeri')}}">Jadi Negeri</a>
        </div>
    </div>
    <div class="card-img-overlay d-flex justify-content-center p-0" style="bottom:4rem">
        <div id="p-pic-container" class="text-center mr-5 mt-5">
            <img id="p-pic" class="img-thumbnail pchange" src="{{asset($user_profile->profile_picture)}}" alt="Profile Picture">
            <a id="p-pic-overlay" class="text-white decoration-none" href="{{route('avatar.edit', ['id' => $user_profile->id])}}" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Perbarui Foto Profil","edit":"Simpan Perubahan", "lg":true, "cancel":"Batal", "actionUrl":"{{route('avatar.update', ['id' => $user_profile->id])}}", "pjax-reload":false, "pchange":true, "pchange-url":"{{route('pchange', ['id' => $user_profile->id])}}"}'><i class="fas fw fa-camera-retro"></i> Perbarui Foto Profil</a>
        </div>
        <div id="p-data" class="mt-5">
            <div class="">
                <span class="--text _head">{{$user_profile->name}}
                    <small>
                        <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" data-toggle="pjax" data-pjax="menu" class="p-0 text-white"><i class="fas fa-edit"></i></a>
                    </small>
                </span>
            </div>

            <ul class="list-inline">
                <li class="list-inline-item mr-5">
                    <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" data-toggle="pjax" data-pjax="menu" class="text-white decoration-none">
                        <span class="--text">Proyek</span>
                        <span class="--text _head">1000</span>
                    </a>
                </li>
                <li class="list-inline-item mr-5">
                    <a data-toggle="pjax" data-pjax="menu" href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}" class="text-white decoration-none">
                        <span class="--text">Aktifitas</span>
                        <span class="--text _head">10</span>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a data-toggle="pjax" data-pjax="menu" href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'donations'])}}" class="text-white decoration-none">
                        <span class="--text">Investasi</span>
                        <span class="--text _head">20</span>
                    </a>
                </li>
            </ul>

            <span class="--text">
                @if(!empty(Auth::user()->verify->id))
                    <span class="badge badge-info align-self-center"><i class="mr-1 far fw fa-check-square" data-fa-transform="grow-3"></i>Pengguna terverifikasi</span><br>
                @endif
                <span class="--text _sub mt-1">Tergabung sejak : {{Idnme::print_date(Auth::user()->created_at, false)}}</span>
            </span>
        </div>
    </div>
</div>