@section('title', 'Ikhtisar')
@php
    use Carbon\Carbon;
    $project_count = [
        'new' => $projects->where('created_at', Carbon::today())->count(),
        'total' => $projects->count(),
        'submitted' => $projects->where('project_status', 'submitted')->count(),
        'published' => $projects->where('project_status', 'published')->count(),
        'rejected' => $projects->where('project_status', 'rejected')->count(),
        'finished' => $projects->where('project_status', 'finished')->count(),
    ];
    $member_count = [
        'new' => $members->where('created_at', Carbon::today())->count(),
        'total' => $members->count(),
        'verified' => $members->where('status', 'verified')->count(),
        'unverified' => $members->where('status', 'unverified')->count(),
        'pending' => $members->where('status', 'pending')->count(),
        // 'finished' => $members->where('project_status', 'finished')->count(),
    ];
    $donation_count = [
        'new' => $donations->where('created_at', Carbon::today())->count(),
        'total' => $donations->count(),
        'verified' => $donations->where('status', 'verified')->count(),
        'unverified' => $donations->where('status', 'unverified')->count(),
        'pending' => $donations->where('status', 'pending')->count(),
        // 'finished' => $donations->where('project_status', 'finished')->count(),
    ];
@endphp

<div class="col-12">
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
        Selamat datang kembali, {{Auth::user()->profile->name}}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="col-lg-4 col-md-6 px-md-0">
        <section class="card">
            <div class="card-header user-header alt bg-dark">
                <div class="media">
                    {{-- <a href="#"> --}}
                        {{-- <img class="align-self-center rounded-circle mr-3" data-cfstyle="width:85px; height:85px;" alt="" data-cfsrc="images/admin.jpg" style="width:85px; height:85px;" src="https://colorlib.com/polygon/sufee/images/admin.jpg"> --}}
                        <i class="fas fw fa-project-diagram mr-2 fa-5x"></i>
                    {{-- </a> --}}
                    <div class="media-body">
                        <h2 class="text-light display-6">{{$project_count['new']}}</h2>
                        <p class="mt-3">Proyek Baru</p>
                    </div>
                </div>
            </div>


            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Total Proyek <span class="badge badge-primary float-right">{{$project_count['total']}}</span>
                </li>
                <li class="list-group-item">
                    Proyek Diajukan <span class="badge badge-primary float-right">{{$project_count['submitted']}}</span>
                </li>
                <li class="list-group-item">
                    Proyek Aktif <span class="badge badge-primary float-right">{{$project_count['published']}}</span>
                </li>
                <li class="list-group-item">
                    Proyek Ditolak <span class="badge badge-primary float-right">{{$project_count['rejected']}}</span>
                </li>
                <li class="list-group-item">
                    Proyek Selesai <span class="badge badge-primary float-right">{{$project_count['finished']}}</span>
                </li>
            </ul>

        </section>
    </div>
    <div class="col-lg-4 col-md-6 px-md-0">
        <section class="card">
            <div class="card-header user-header alt bg-dark">
                <div class="media">
                    {{-- <a href="#"> --}}
                        {{-- <img class="align-self-center rounded-circle mr-3" data-cfstyle="width:85px; height:85px;" alt="" data-cfsrc="images/admin.jpg" style="width:85px; height:85px;" src="https://colorlib.com/polygon/sufee/images/admin.jpg"> --}}
                        <i class="fas fa-user-friends fw mr-2 fa-5x text-white"></i>
                    {{-- </a> --}}
                    <div class="media-body">
                        <h2 class="text-light display-6">{{$member_count['new']}}</h2>
                        <p class="mt-3 text-white">Member Baru</p>
                    </div>
                </div>
            </div>


            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Total Member <span class="badge badge-primary float-right">{{$member_count['total']}}</span>
                </li>
                <li class="list-group-item">
                    Member Terverifikasi <span class="badge badge-primary float-right">{{$member_count['verified']}}</span>
                </li>
                <li class="list-group-item">
                    Member Belum Terverifikasi <span class="badge badge-primary float-right">{{$member_count['pending']}}</span>
                </li>
                <li class="list-group-item">
                    Member Tidak Terferifikasi <span class="badge badge-primary float-right">{{$member_count['unverified']}}</span>
                </li>
                {{-- <li class="list-group-item">
                    Proyek Selesai <span class="badge badge-primary float-right">10</span>
                </li> --}}
            </ul>

        </section>
    </div>
    <div class="col-lg-4 col-md-6 px-md-0">
        <section class="card">
            <div class="card-header user-header alt bg-dark">
                <div class="media">
                    {{-- <a href="#"> --}}
                        {{-- <img class="align-self-center rounded-circle mr-3" data-cfstyle="width:85px; height:85px;" alt="" data-cfsrc="images/admin.jpg" style="width:85px; height:85px;" src="https://colorlib.com/polygon/sufee/images/admin.jpg"> --}}
                        <i class="fas fw fa-coins mr-2 fa-5x text-white"></i>
                    {{-- </a> --}}
                    <div class="media-body">
                        <h2 class="text-light display-6">{{$donation_count['new']}}</h2>
                        <p class="mt-3 text-white">Investasi Baru</p>
                    </div>
                </div>
            </div>


            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Total investasi <span class="badge badge-primary float-right">{{$donation_count['total']}}</span>
                </li>
                <li class="list-group-item">
                    Investasi Terverifikasi <span class="badge badge-primary float-right">{{$donation_count['verified']}}</span>
                </li>
                <li class="list-group-item">
                    Investasi Belum Terverifikasi <span class="badge badge-primary float-right">{{$donation_count['pending']}}</span>
                </li>
                <li class="list-group-item">
                    Investasi Tidak Terferifikasi <span class="badge badge-primary float-right">{{$donation_count['unverified']}}</span>
                </li>
                {{-- <li class="list-group-item">
                    Proyek Selesai <span class="badge badge-primary float-right">10</span>
                </li> --}}
            </ul>

        </section>
    </div>
</div>