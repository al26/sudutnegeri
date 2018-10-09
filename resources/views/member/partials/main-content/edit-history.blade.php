<div class="card">
    @if ($menu === 'sudut')
        <div class="card-header text-left border-bottom bg-lighten">
            <h4 class="m-0 float-left col-11 p-0">Kelola Proyek {{$history->project->project_name}}</h4>
            <a href="{{route('project.manage', ['slug' => $history->project->project_slug])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right col-auto"><i class="fas fa-times"></i></a>
        </div>
    @endif
    @if ($menu === 'negeri')
        <div class="card-header text-left border-bottom bg-lighten">
            <h4 class="m-0 float-left col-11 p-0">Kelola Data Historis</h4>
            <a href="{{route('history.manage', ['slug' => $history->project->project_slug])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right col-auto"><i class="fas fa-times"></i></a>
        </div>
    @endif
    <div class="card-body">
        <div class="form-section clearfix">
            <div class="fs-head">
                <span class="fs-head-text">Ubah Data Historis {{$history->title}}</span>
            </div>      
        </div>
        <div class="row section-content">
            <div class="col">
                <form method="POST" action="{{route('history.update', ['id' => encrypt($history->id)])}}" id="form-update-history">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Judul Update</label>
                        <input type="text" class="form-control" id="title" placeholder="Judul update" name="data[title]" value="{{$history->title}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Detail Update</label>
                        <textarea class="form-control the-summernote" id="body" rows="3" name="data[body]">{{$history->body}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" id="update-history" data-redirectAfter="{{route('project.manage', ['slug' => $history->project->project_slug])}}">Simpan Perubahan</button>
                    @if ($menu === 'sudut')
                        <a href="{{route('project.manage', ['slug' => $history->project->project_slug])}}" class="btn btn-danger" data-toggle="pjax" data-pjax="main-content">Batal</a>
                    @endif
                    @if ($menu === 'negeri')
                        <a href="{{route('history.manage', ['slug' => $history->project->project_slug])}}" class="btn btn-danger" data-toggle="pjax" data-pjax="main-content">Batal</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>