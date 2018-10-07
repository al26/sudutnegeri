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
                <tr>
                    <td><a href="{{route('project.show', ['slug' => $history->project->project_slug, 'menu' => 'history'])}}" class="decoration-none">{{$history->title}}</a></td>
                    <td>{{$history->user->profile->name}}</td>
                    <td>{{Idnme::print_date($history->created_at)}}</td>
                    <td>{{Idnme::print_date($history->updated_at)}}</td>
                    <td>
                        @if ($history->user->id === Auth::user()->id)
                            @php
                                if($menu === 'sudut') {
                                    $route = 'history.edit';
                                    $redirect = route('project.manage', ['slug' => $history->project->project_slug]);
                                } 
                                if($menu === 'negeri') {
                                    $route = 'activity.history.edit';
                                    $redirect = route('history.manage', ['slug' => $history->project->project_slug]);
                                }
                            @endphp
                            <a href="{{route($route, ['slug' => $history->project->project_slug,'id' => encrypt($history->id)])}}" class="btn btn-sm btn-primary my-1" data-toggle="pjax" data-pjax="main-content"><i class="far fw fa-edit"></i> Edit</a>
                            <a class="btn btn-sm btn-danger my-1" href="" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Hapus History","text":"Hapus data historis {{$history->title}} ?", "actionUrl":"{{route('history.destroy', ["id" => encrypt($history->id)])}}","delete":"Hapus History", "cancel":"Batalkan","redirectAfter":"{{$redirect}}","pjax-container":"#mr"}'><i class="far fw fa-trash-alt"></i> Hapus</a>
                        @else
                            <span class="btn btn-sm btn-primary disabled"><i class="far fw fa-edit"></i> Edit</span>
                            <span class="btn btn-sm btn-danger disabled"><i class="far fw fa-trash-alt"></i> Hapus</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>