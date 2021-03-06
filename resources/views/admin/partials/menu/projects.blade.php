<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-left border-bottom bg-lighten clearfix d-flex flex-row justify-content-between align-items-center">
                <h4 class="m-0 p-0">Daftar Proyek</h4>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered" data-order='{"col":6, "sort":"asc"}'>
                    <thead>
                        <tr>
                            <th>Judul Proyek</th>
                            <th>Si Sudut</th>
                            <th>Lokasi</th>
                            <th>Target Dana</th>
                            <th>Target Relawan</th>
                            <th>Dokumen Verifikasi</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            @php
                                $docs = json_decode($project->attachments);
                                switch ($project->project_status) {
                                    case 'submitted':
                                        $status = 'Diajukan';
                                        $badge = 'warning';
                                        break;
                                    case 'published':
                                        $status = 'Dipublikasikan';
                                        $badge = 'success';
                                        break;
                                    case 'finished':
                                        $status = 'Selesai';
                                        $badge = 'secondary';
                                        break;
                                    case 'rejected':
                                        $status = 'Ditolak';
                                        $badge = 'danger';
                                        break;
                                    case 'freeze':
                                        $status = 'Dibekukan';
                                        $badge = 'primary';
                                        break;
                                    default:
                                        $status = 'Diajukan';
                                        $badge = 'warning';
                                        break;
                                }
                            @endphp    
                            <tr>
                                <td><a href="{{route('project.show', ['slug' => $project->project_slug, 'menu' => 'detail'])}}" class="btn-link text-primary" target="_blank">{{$project->project_name}}</a></td>
                                <td>{{$project->user->profile->name}}</td>
                                <td>{{ucwords(strtolower($project->location->name))}}</td>
                                <td>{{Idnme::print_rupiah($project->funding_target, false, true)}}</td>
                                <td>{{$project->volunteer_quota}}</td>
                                <td>
                                    @foreach ($docs as $key => $item)
                                        <a href="{{route('file.view', ['path' => $item])}}" target="_blank" class="badge badge-secondary text-white" target="_blank"><i class="fas fa-receipt"></i> Dokumen {{$key+1}}</a><br>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge badge-{{$badge}}">{{$status}}</span>
                                </td>
                                <td>
                                    @if ($project->project_status !== 'submitted')
                                        <span class="btn btn-sm btn-light disabled">Tak ada opsi</span>
                                    @else
                                        {{-- @if ($project->project_status === 'published')
                                            <a id="project-freeze" href="{{route('project.verify', ['id' => encrypt($project->id), 'action' => 'freeze'])}}" class="btn btn-sm btn-primary text-white my-1" data-data='{"redirectAfter":"{{route('admin.dashboard', ['menu' => 'projects'])}}", "pjax-container":"#ac"}'><i class="far fa-check-circle"></i> Bekukan</a>
                                        @else     --}}
                                            <a id="project-verify" href="{{route('project.verify', ['id' => encrypt($project->id), 'action' => 'verify'])}}" class="btn btn-sm btn-success text-white my-1" data-data='{"redirectAfter":"{{route('admin.dashboard', ['menu' => 'projects'])}}", "pjax-container":"#ac"}'><i class="far fa-check-circle"></i> Publikasikan</a>

                                            <a id="project-reject" href="{{route('project.verify', ['id' => encrypt($project->id), 'action' => 'reject'])}}" class="btn btn-sm btn-danger text-white my-1" data-data='{"redirectAfter":"{{route('admin.dashboard', ['menu' => 'projects'])}}", "pjax-container":"#ac"}'><i class="far fa-times-circle"></i> Tolak</a>
                                        {{-- @endif --}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>