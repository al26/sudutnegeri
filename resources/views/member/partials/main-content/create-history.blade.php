<div class="card">
    @if ($menu === 'sudut')
        <div class="card-header text-left border-bottom bg-lighten">
            <h4 class="m-0 float-left col-11 p-0">Kelola Proyek {{$project->project_name}}</h4>
            <a href="{{route('project.manage', ['slug' => $project->project_slug])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right col-auto"><i class="fas fa-times"></i></a>
        </div>
    @endif
    @if ($menu === 'negeri')
        <div class="card-header text-left border-bottom bg-lighten">
            <h4 class="m-0 float-left col-11 p-0">Kelola Data Historis</h4>
            <a href="{{route('history.manage', ['slug' => $project->project_slug])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right col-auto"><i class="fas fa-times"></i></a>
        </div>
    @endif
    <div class="card-body">
        <div class="form-section clearfix">
            @if ($menu === 'sudut')
                <div class="fs-head">
                    <span class="fs-head-text">Tulis Data Historis Baru</span>
                </div>
            @endif
            @if ($menu === 'negeri')
                <div class="fs-head">
                    <span class="fs-head-text">Tulis Data Historis {{$project->project_name}}</span>
                </div>      
            @endif
        </div>
        <div class="row section-content">
            <div class="col">
                <form method="POST" action="{{route('history.store')}}" id="form-create-history">
                    @csrf
                    <input type="hidden" class="form-control" id="user_id" name="data[user_id]" value="{{encrypt(Auth::user()->id)}}">
                    <input type="hidden" class="form-control" id="project_id" name="data[project_id]" value="{{encrypt($project->id)}}">
                    <div class="form-group">
                        <label for="title">Judul Update</label>
                        <input type="text" class="form-control" id="title" placeholder="Judul update" name="data[title]">
                    </div>
                    <div class="form-group">
                        <label for="description">Detail Update</label>
                        <textarea class="form-control the-summernote" id="body" rows="3" name="data[body]"></textarea>
                    </div>

                    @if ($menu === 'sudut')
                        <button type="submit" class="btn btn-primary" id="create-history" data-redirectAfter="{{route('project.manage', ['slug' => $project->project_slug])}}">Simpan</button>
                        <a href="{{route('project.manage', ['slug' => $project->project_slug])}}" class="btn btn-danger" data-toggle="pjax" data-pjax="main-content">Batal</a>
                    @endif
                    @if ($menu === 'negeri')
                        <button type="submit" class="btn btn-primary" id="create-history" data-redirectAfter="{{route('history.manage', ['slug' => $project->project_slug])}}">Simpan</button>
                        <a href="{{route('history.manage', ['slug' => $project->project_slug])}}" class="btn btn-danger" data-toggle="pjax" data-pjax="main-content">Batal</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>