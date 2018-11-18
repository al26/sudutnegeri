@if (($donators->count() <= 0) && ($volunteers->count() <= 0))
    <div class="text-center">
        <div class="my-3 text-secondary">
            <i class="far fa-frown fa-10x"></i>
        </div>
        <span class="font-weight-bold">Belum ada Investor maupun Relawan mendukung.</span><br>
        <span class="font-weight-bold">Ayo jadi yang pertama mendukung proyek {{$project->project_name}} !!</span>
    </div>
@endif
@if ($donators->count() > 0)
    <div class="list-donatur">
        <span class="--text text-uppercase mb-2 border-bottom"><a class="text-default decoration-none" role="button" data-toggle="collapse" data-parent=".list-donatur" href="#ld" aria-expanded="true" aria-controls="ld">Donatur</a></span>
        <div id="ld" class="collapse show mb-2">
            <div class="row">
                @foreach ($donators as $donatur)
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="media mb-2">
                            @if($donatur->anonymouse)
                                <img class="mr-3" src="{{asset('storage/profile_pictures/avatar.jpg')}}" alt="Generic placeholder image" width="50">
                                <div class="media-body">
                                    <span class="mb-2 --text">Anonim</span>
                                    <span class="mb-0 --text _sub">{{Idnme::print_rupiah($donatur->amount, false, true)}}</span>
                                </div>
                            @else
                                <img class="mr-3" src="{{asset($donatur->user->profile->profile_picture)}}" alt="Generic placeholder image" width="50">
                                <div class="media-body">
                                    <span class="mb-2 --text">{{$donatur->user->profile->name}}</span>
                                    <span class="mb-0 --text _sub">{{Idnme::print_rupiah($donatur->amount, false, true)}}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@if ($volunteers->count() > 0)
    <div class="list-relawan">
        <span class="--text text-uppercase mb-2 border-bottom"><a class="text-default decoration-none" role="button" data-toggle="collapse" data-parent=".list-relawan" href="#lr" aria-expanded="true" aria-controls="lr">Relawan</a></span>
        <div id="lr" class="collapse show mb-2">
            <div class="row">
                @foreach ($volunteers as $volunteer)
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="media mb-2">
                            <img class="mr-3" src="{{asset($volunteer->user->profile->profile_picture)}}" alt="Foto Profil Relawan" width="50">
                            <div class="media-body">
                                <span class="mb-2 --text">{{$volunteer->user->profile->name}}</span>
                                <span class="mb-0 --text _sub">{{$volunteer->user->profile->profession}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
