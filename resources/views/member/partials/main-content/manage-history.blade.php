<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0 float-left p-0 col-11">Kelola Data Historis</h4>
        <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right col-auto" onclick="javascript:$(this).redireload($(this).getBackUrl()); return false;"><i class="fas fa-times"></i></a>
    </div>
    @if ($historis->count() <= 0)
        <div class="card-body text-center">
            <div class="my-3">
                <i class="fas fa-comment-alt fa-10x"></i>
            </div>
            <span class="font-weight-bold">Belum ada data historis untuk proyek {{$project->project_name}} !</span><br>
            <span class=""><a href="{{route('activity.history.create', ['slug' => $project->project_slug])}}" data-toggle="pjax" data-pjax="menu">Tulis Data Historis</a></span>
        </div>
    @else
        <div class="card-body">
            <div class="form-section clearfix">
                <div class="fs-head">
                    <span class="fs-head-text">Data Historis {{$project->project_name}}</span>
                    <a href="{{route('activity.history.create', ['slug' => $project->project_slug])}}" class="btn btn-sm btn-secondary float-lg-right" data-toggle="pjax" data-pjax="main-content"><i class="fas fw fa-pencil-alt"></i> Tulis Historis</a>
                </div>      
            </div>
            <div class="row section-content">
                @include('member.partials.historis-table', ['menu' => 'negeri'])
            </div>
        </div>
    @endif
</div>