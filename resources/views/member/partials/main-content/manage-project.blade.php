<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0 float-left col-11 p-0">Kelola Proyek {{$project->project_name}}</h4>
        <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right col-auto" onclick="javascript:$(this).redireload($(this).getBackUrl()); return false;"><i class="fas fa-times"></i></a>
    </div>
    <div class="card-body">
        <div class="row section-content">
            <div class="col-4 px-2 info-box-parent">
                <a class="btn-box" href="{{route('project.edit', ['id' => encrypt($project->id)])}}" data-toggle="pjax" data-pjax="main-content">
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
                <a class="btn-box" href="{{route('project.show', ['slug' => $project->project_slug])}}" target="_blank">
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
                <a class="btn-box" href="" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Hapus Proyek","text":"Hapus proyek {{$project->project_name}} ?", "actionUrl":"{{route('project.destroy', ["id" => encrypt($project->id)])}}","delete":"Hapus Proyek", "cancel":"Batalkan","redirectAfter":"{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}","pjax-container":"#mr"}'>
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
        <div class="form-section clearfix mt-3">
            <div class="fs-head">
                <span class="fs-head-text">Data Historis {{$project->project_name}}</span>
                <a href="{{route('history.create', ['slug' => $project->project_slug])}}" class="btn btn-sm btn-secondary float-right my-1" data-toggle="pjax" data-pjax="main-content"><i class="fas fw fa-pencil-alt"></i> Tulis Update</a>
            </div>      
        </div>
        <div class="row section-content">
            @include('member.partials.historis-table', ['menu' => 'sudut'])
        </div>
    </div>
</div>