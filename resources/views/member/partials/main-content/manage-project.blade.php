<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0 float-left col-11 p-0">Kelola Proyek {{$project->project_name}}</h4>
        <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right col-auto" onclick="javascript:$(this).redireload($(this).getBackUrl()); return false;"><i class="fas fa-times"></i></a>
    </div>
    <div class="card-body">
        <div class="row section-content">
            <div class="col-4 px-2 info-box-parent">
                @if ($project->project_status === 'finished')
                    <span class="btn-box">
                        <div class="info-box shadow disabled">
                            <div class="info-box-inner">
                                <h3 class="text-secondary t">Ubah</h3>
                                <p class="text-secondary st">Proyek</p>
                            </div>
                            <div class="info-box-icon">
                                <i class="far fa-edit"></i>
                            </div>
                        </div>  
                    </span>
                @else
                    <a class="btn-box" href="{{route('project.edit', ['id' => encrypt($project->id)])}}" data-toggle="pjax" data-pjax="main-content">
                        <div class="info-box shadow">
                            <div class="info-box-inner">
                                <h3 class="text-secondary t">Ubah</h3>
                                <p class="text-secondary st">Proyek</p>
                            </div>
                            <div class="info-box-icon">
                                <i class="far fa-edit"></i>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
            <div class="col-4 px-2 info-box-parent">
                @if ($project->project_status === 'finished')
                    <span class="btn-box">
                        <div class="info-box shadow disabled">
                            <div class="info-box-inner">
                                <h3 class="text-secondary t">Lihat</h3>
                                <p class="text-secondary st">Proyek</p>
                            </div>
                            <div class="info-box-icon">
                                <i class="fas fa-external-link-alt"></i>
                            </div>
                        </div>  
                    </span>
                @else
                    <a class="btn-box" href="{{route('project.show', ['slug' => $project->project_slug])}}" target="_blank">
                        <div class="info-box shadow">
                            <div class="info-box-inner">
                                <h3 class="text-secondary t">Lihat</h3>
                                <p class="text-secondary st">Proyek</p>
                            </div>
                            <div class="info-box-icon">
                                <i class="fas fa-external-link-alt"></i>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
            <div class="col-4 px-2 info-box-parent">
                @if ($project->project_status === 'finished')
                    <span class="btn-box">
                        <div class="info-box shadow disabled">
                            <div class="info-box-inner">
                                <h3 class="text-secondary t">Hapus</h3>
                                <p class="text-secondary st">Proyek</p>
                            </div>
                            <div class="info-box-icon">
                                <i class="far fa-trash-alt"></i>
                            </div>
                        </div>  
                    </span>
                @else
                    <a class="btn-box" href="" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Hapus Proyek","text":"Hapus proyek {{$project->project_name}} ?", "actionUrl":"{{route('project.destroy', ["id" => encrypt($project->id)])}}","delete":"Hapus Proyek", "cancel":"Batalkan","redirectAfter":"{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}","pjax-container":"#mr"}'>
                        <div class="info-box shadow">
                            <div class="info-box-inner">
                                <h3 class="text-secondary t">Hapus</h3>
                                <p class="text-secondary st">Proyek</p>
                            </div>
                            <div class="info-box-icon">
                                <i class="far fa-trash-alt"></i>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
            {{-- <div class="col-3 px-2 info-box-parent">
                <a class="btn-box" href="" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Akhiri Proyek","text":"Akhiri proyek {{$project->project_name}} ?", "yesUrl":"{{route('project.finish', ["id" => encrypt($project->id)])}}","yes":"Akhiri Proyek", "cancel":"Batalkan","redirectAfter":"{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}","pjax-container":"#mr"}'>
                    <div class="info-box shadow">
                        <div class="info-box-inner">
                            <h3 class="text-secondary t">Akhiri</h3>
                            <p class="text-secondary st">Proyek</p>
                        </div>
                        <div class="info-box-icon">
                            <i class="fas fa-power-off"></i>
                        </div>
                    </div>
                </a>
            </div> --}}
        </div>
        <div class="form-section clearfix mt-3">
            <div class="fs-head">
                <span class="fs-head-text">Data Historis {{$project->project_name}}</span>
                {{-- <a href="{{route('history.create', ['slug' => $project->project_slug])}}" class="btn btn-sm btn-secondary float-right my-1 d-none d-md-block" data-toggle="pjax" data-pjax="main-content"><i class="fas fw fa-pencil-alt"></i> Tulis Update</a> --}}
            </div>      
            @if ($project->project_status !== 'published')
                <span class="btn btn-md btn-secondary w-100 disabled"><i class="fas fw fa-pencil-alt"></i> Tulis Data Historis Baru</span>
            @else
                <a href="{{route('history.create', ['slug' => $project->project_slug])}}" class="btn btn-md btn-secondary w-100 " data-toggle="pjax" data-pjax="main-content"><i class="fas fw fa-pencil-alt"></i> Tulis Data Historis Baru</a>
            @endif
        </div>
        <div class="row section-content">
            @include('member.partials.historis-table', ['menu' => 'sudut'])
        </div>
    </div>
</div>