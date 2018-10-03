<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Data Calon Relawan</h4>
    </div>
    @if ($user_projects_all->count() <= 0)
        <div class="card-body">    
            <div class="text-center">
                <div class="my-3">
                    <i class="fas fa-search-minus fa-10x" data-fa-transform="shrink-8 down-2 right-2" data-fa-mask="fas fa-file"></i>
                </div>
                <span class="font-weight-bold">Anda belum memiliki proyek !!</span><br>
                <span class="">Ayo mulai <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" data-toggle="pjax" data-pjax="menu">proyek baru</a>  Anda untuk bantu majukan pendidikan Indonesia bersama SudutNegeri.</span>
            </div>
        </div>
    @else
        @if ($volunteers->count() <= 0)
            <div class="card-body">    
                <div class="text-center">
                    <div class="my-3">
                        <i class="far fa-frown fa-10x"></i>
                    </div>
                    <span class="font-weight-bold">Belum ada calon relawan untuk proyek Anda !!</span><br>
                    {{-- <span class="">Silahkan mulai<a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" data-toggle="pjax" data-pjax="menu">proyek baru</a> Anda.</span> --}}
                </div>
            </div>
        @else
            <div class="card-body">
                {{-- <div class="form-section mt-3 clearfix">
                    <div class="fs-head">
                        <span class="fs-head-text">Daftar Calon Relawan</span>
                    </div>      
                </div> --}}
                <div class="row section-content">
                    <div class="col-12">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Pendaftar</th>
                                    <th>Subyek</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($volunteers as $volunteer)
                                    <tr>
                                        <td>{{$volunteer->user->profile->name}}</td>
                                        <td>{{$volunteer->project->project_name}}</td>
                                        <td>{{$volunteer->status}}</td>
                                        <td>
                                            <a href="{{route('volunteer.show', ['id' => $volunteer->id])}}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Tinjau Aplikasi","yes":"Terima", "no":"Tolak", "lg":true, "yesUrl":"{{route('volunteer.update', ['id' => $volunteer->id, 'code' => 'yes'])}}", "noUrl":"{{route('volunteer.update', ['id' => $volunteer->id, 'code' => 'no'])}}", "redirectAfter":"{{route('dashboard', ['menu' => 'sudut', 'section' => 'volunteer'])}}", "pjax-container":"#mr"}'><i class="fas fa-search"></i> Tinjau</a>
                                            <a class="btn btn-sm btn-danger" href="" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Hapus Calon Relawan","text":"Yakin, Anda akan menghapus {{$volunteer->user->profile->name}} dari daftar calon relawan untuk proyek {{$volunteer->project->project_name}} ?", "actionUrl":"","delete":"Hapus", "cancel":"Batalkan","redirectAfter":"","pjax-container":"#mr"}'><i class="far fw fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>