<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0 float-left">Kelola Data Historis</h4>
        <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right" onclick="javascript:$(this).redireload($(this).getBackUrl()); return false;"><i class="fas fa-times"></i></a>
    </div>
    <div class="card-body">
        <div class="form-section clearfix">
            <div class="fs-head">
                <span class="fs-head-text">Ubah Data Historis {{$history->title}}</span>
            </div>      
        </div>
        <div class="row section-content">
            <div class="col">
                <form method="POST" action="{{route('history.update', ['id' => encrypt($history->id)])}}" id="form-activity-update-history">
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

                    <button type="submit" class="btn btn-primary" id="activity-update-history" data-redirectAfter="{{route('history.manage', ['slug' => $history->project->project_slug])}}">Simpan Perubahan</button>
                    <a href="{{route('history.manage', ['slug' => $history->project->project_slug])}}" class="btn btn-danger" data-toggle="pjax" data-pjax="main-content">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>