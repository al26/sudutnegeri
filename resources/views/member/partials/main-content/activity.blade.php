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
    <div class="card-body">
        <div class="row section-content">
            <div class="col-4 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary">0</h3>
                        <p class="text-secondary">Total Aktivitas</p>
                    </div>
                    <div class="info-box-icon">
                        <i class="fas fa-hands"></i>
                    </div>
                </div>
            </div>
            {{-- <div class="col-4 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary"></h3>
                        <p class="text-secondary">Lencana</p>
                    </div>
                    <div class="info-box-icon">
                        <i class="fas fa-hands"></i>
                    </div>
                </div>
            </div>
            <div class="col-4 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary"></h3>
                        <p class="text-secondary">Total Waktu Pengabdian</p>
                    </div>
                    <div class="info-box-icon">
                        <i class="fas fa-hands"></i>
                    </div>
                </div>
            </div> --}}
        </div>
        @if (!empty($current_activity))
            <div class="form-section mt-3">
                <div class="fs-head">
                    <span class="fs-head-text">Aktivitas Saat Ini</span>
                    <a href="{{route('project.manage', ['slug' => $current_activity->project->project_slug])}}" class="btn btn-sm btn-secondary float-right">Kelola Data Historis</a>
                </div>
            </div>
            <div class="row section-content">
                <div class="card col">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <img src="{{asset($current_activity->project->project_banner)}}" class="img-fluid mb-3 mb-md-0" alt="Project Banner">
                        </div>
                        <div class="col-12 col-md-7">
                            <div class="card-block px-2">
                                <a href="{{route('project.show', ['slug' => $current_activity->project->project_slug])}}" class="decoration-none"><h4 class="card-title">{{$current_activity->project->project_name}}</h4></a>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item dv-menu py-2"><i class="fas fw fa-tag mr-2"></i> {{$current_activity->project->category->category}}</li>
                                    <li class="list-group-item dv-menu py-2"><i class="fas fw fa-user mr-2"></i> {{$current_activity->project->user->profile->name}}</li>
                                    <li class="list-group-item dv-menu py-2"><i class="fas fw fa-map-marker-alt mr-2"></i> {{$current_activity->project->location->name}}</li>
                                    <li class="list-group-item dv-menu py-2">Status <span class="badge badge-{{getStatus($current_activity->status)[0]}}">{{getStatus($current_activity->status)[1]}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="form-section mt-3">
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
                                <td>{{$i->project->project_name}}</td>
                                {{-- <td>xx</td> --}}
                                <td>{{getStatus($i->status)[1]}}</td>
                                <td>
                                    <a href="{{route('project.manage', ['slug' => $i->project->project_slug])}}" class="btn btn-sm btn-secondary"> Kelola Data Historis</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>