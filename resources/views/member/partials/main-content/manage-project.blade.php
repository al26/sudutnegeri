<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0 float-left">Kelola Proyek {{$data['project_name']}}</h4>
        <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right d-none d-lg-block" onclick="javascript:$(this).redireload($(this).getBackUrl()); return false;"><i class="far fa-window-close"></i> Kembali</a>
    </div>
    <div class="card-body">
        @if ($data->user->id === Auth::user()->id)
            <div class="row section-content">
                <div class="col-4 px-2 info-box-parent">
                    <a class="btn-box" href="{{route('project.edit', ['id' => $data['id']])}}" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Ubah Data Proyek","actionUrl":"{{route('project.update', ["id" => $data['id']])}}","edit":"Simpan Perubahan","lg":true,"cancel":"Batal"}'>
                        <div class="info-box">
                            <div class="info-box-inner">
                                <h3 class="text-secondary">Ubah</h3>
                                <p class="text-secondary">Proyek</p>
                            </div>
                            <div class="info-box-icon">
                                <i class="far fa-edit"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-4 px-2 info-box-parent">
                    <a class="btn-box" href="{{route('project.show', ['slug' => $data['project_slug']])}}" target="_blank">
                        <div class="info-box">
                            <div class="info-box-inner">
                                <h3 class="text-secondary">Lihat</h3>
                                <p class="text-secondary">Proyek</p>
                            </div>
                            <div class="info-box-icon">
                                <i class="fas fa-external-link-alt"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-4 px-2 info-box-parent">
                    <a class="btn-box" href="" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Hapus Proyek","text":"Hapus proyek {{$data['name']}} ?", "actionUrl":"{{route('project.delete', ["id" => $data['id']])}}","delete":"Hapus Proyek", "cancel":"Batalkan","redirectAfter":"{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}","pjax-container":"#mr"}'>
                        <div class="info-box">
                            <div class="info-box-inner">
                                <h3 class="text-secondary">Hapus</h3>
                                <p class="text-secondary">Proyek</p>
                            </div>
                            <div class="info-box-icon">
                                <i class="far fa-trash-alt"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif
        <div class="form-section clearfix">
            <div class="fs-head">
                <span class="fs-head-text">Data Historis {{$data['name']}}</span>
                <a href="{{route('history.create', ['projectId' => $data['id']])}}" class="btn btn-sm btn-secondary float-right" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Tulis Update Proyek {{$data['name']}}","actionUrl":"{{route('history.store')}}","add":"Post Update", "lg":true, "cancel":"Batal"}'><i class="fas fw fa-pencil-alt"></i> Tulis Update</a>
            </div>      
        </div>
        <div class="row section-content">
            <div class="col table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Judul Update</th>
                            <th>Penulis</th>
                            <th>Dibuat</th>
                            <th>Diperbarui</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historis as $history)
                            @php
                                $created_at = new DateTime($history->created_at);
                                $created_at->setTimezone(new DateTimeZone('Asia/Jakarta'));
                                $updated_at = new DateTime($history->updated_at);
                                $updated_at->setTimezone(new DateTimeZone('Asia/Jakarta'));
                            @endphp
                            <tr>
                                <td>{{$history->title}}</td>
                                <td>{{$history->user->profile->name}}</td>
                                {{-- <td>{{$created_at->format('d-m-Y, H:i')}}</td>
                                <td>{{$updated_at->format('d-m-Y, H:i')}}</td> --}}
                                <td>{{Idnme::print_date($history->created_at)}}</td>
                                <td>{{Idnme::print_date($history->updated_at)}}</td>
                                <td>
                                    @if ($history->user->id === Auth::user()->id)
                                        <a href="{{route('history.edit', ['id' => $history->id])}}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Ubah History {{$history->title}}","actionUrl":"{{route('history.update', ['id' => $history->id])}}","edit":"Ubah Histori", "lg":true, "cancel":"Batal"}'><i class="far fw fa-edit"></i> Edit</a>
                                        <a class="btn btn-sm btn-danger" href="" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Hapus History","text":"Hapus proyek {{$history->title}} ?", "actionUrl":"{{route('history.destroy', ["id" => $history->id])}}","delete":"Hapus History", "cancel":"Batalkan","redirectAfter":"{{route('project.manage', ['slug' => $history->project->project_slug])}}","pjax-container":"#mr"}'><i class="far fw fa-trash-alt"></i> Hapus</a>
                                    @else
                                        <span class="btn btn-sm btn-primary" disabled><i class="far fw fa-edit"></i> Edit</span>
                                        <span class="btn btn-sm btn-danger" disabled><i class="far fw fa-trash-alt"></i> Hapus</span>
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