@php
    function getStatus($status) {
        $return = array();
        if ($status === 'pending') {
            $return[0] = 'warning';
            $return[1] = 'Baru Daftar';
        }
        if ($status === 'accepted') {
            $return[0] = 'success';
            $return[1] = 'Diterima / Aktif';
        }  
        if ($status === 'rejected') {
            $return[0] = 'danger';
            $return[1] = 'Tidak Diterima';
        }  
        if ($status === 'finished') {
            $return[0] = 'secondary';
            $return[1] = 'Selesai';
        }

        return $return;
    }
@endphp
<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Aktivitas Saya</h4>
    </div>
    @if (Auth::user()->volunteers->count() <= 0)
    <div class="card-body">
        <div class="text-center p-5 my-auto">
            <div class="my-3">
                <i class="fas fa-hand-holding-heart fa-10x"></i>
            </div>
            <span class="font-weight-bold">Belum ada aktivitas kerelawanan !</span><br>
            <span class=""><a href="{{route('project.browse')}}" data-toggle="pjax" data-pjax="menu">Pilih proyek</a> dan buat aktivitas kerelawanan Anda.</span>
        </div>
    </div>
    @else
        <div class="card-body">
            @if (!empty($current_activity) && $current_activity->status !== 'finished')
                <div class="form-section">
                    <div class="fs-head">
                        <span class="fs-head-text">Aktivitas Saat Ini</span>
                    </div>
                </div>
                <div class="row section-content mb-5">
                    <div class="card col">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <img src="{{asset($current_activity->project->project_banner)}}" class="img-fluid mb-3 mb-md-0 img-thumbnail" alt="Project Banner">
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="card-block px-2">
                                    <a href="{{route('project.show', ['slug' => $current_activity->project->project_slug])}}" class="decoration-none"><h4 class="card-title">{{$current_activity->project->project_name}}</h4></a>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item dv-menu py-2"><i class="fas fw fa-tag mr-2"></i> {{$current_activity->project->category->category}}</li>
                                        <li class="list-group-item dv-menu py-2"><i class="fas fw fa-user mr-2"></i> {{$current_activity->project->user->profile->name}}</li>
                                        <li class="list-group-item dv-menu py-2"><i class="fas fw fa-map-marker-alt mr-2"></i> {{$current_activity->project->location->name}}</li>
                                        <li class="list-group-item dv-menu py-2">
                                            <div class="d-flex flex-row justify-content-between align-items-center">
                                                <p class="m-0">Status <span class="badge badge-{{getStatus($current_activity->status)[0]}}">{{getStatus($current_activity->status)[1]}}</span></p>
                                                @if ($current_activity->status === 'accepted')
                                                    <a href="{{route('history.manage', ['slug' => $current_activity->project->project_slug])}}" class="btn btn-sm btn-secondary float-right" data-toggle="pjax" data-pjax="main-content">Kelola Data Historis</a>
                                                @endif
                                            </div>    
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Semua Aktivitas</span></div>
            </div>
            <div class="row section-content">
                <div class="col table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Proyek</th>
                                {{-- <th>Tanggal Pelaksanaan</th> --}}
                                <th>Status</th>
                                <th>Data Historis</th>
                                {{-- masuk ke list data historis ke proyek terkait, 
                                ada menu edit pake modal --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_activity as $i)
                                <tr>
                                    <td><a href="{{route('project.show', ['slug' => $i->project->project_slug])}}" class="decoration-none">{{$i->project->project_name}}</a></td>
                                    {{-- <td>xx</td> --}}
                                    <td><span class="badge badge-{{getStatus($i->status)[0]}}">{{getStatus($i->status)[1]}}</span></td>
                                    <td>
                                        @if ($i->status === 'accepted' || $i->status === 'finished')
                                            <a href="{{route('history.manage', ['slug' => $i->project->project_slug])}}" class="btn btn-sm btn-secondary" data-toggle="pjax" data-pjax="main-content"> Kelola Data Historis</a>
                                        @else
                                            <span class="btn btn-sm btn-secondary disabled"> Kelola Data Historis</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>