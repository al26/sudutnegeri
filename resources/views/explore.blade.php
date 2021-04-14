@php
    $filter_location = '';
    $location_name = '';
    if(!empty(app('request')->input('location')) && app('request')->input('location') !== 'all') {
        $location_name = \App\Regency::where('id', app('request')->input('location'))->first()->name;
        $filter_location = "di ".ucwords(strtolower($location_name));
    }
@endphp
@extends('layouts.app')

@section('content')
    {{-- <div class="section-deadline">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <select class="selectpicker" multiple title="Choose one of the following...">
                        <option>Mustard</option>
                        <option>Ketchup</option>
                        <option>Relish</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="selectpicker" multiple title="Choose one of the following...">
                        <option>Mustard</option>
                        <option>Ketchup</option>
                        <option>Relish</option>
                    </select>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="navbar-collapse filter-collapse" id="project-filter-content">
        <div class="card bg-transparent">
            <div class="card-header d-flex flex-row justify-content-between align-items-center">
                <h4 class="card-title text-secondary-black m-0">Filter Proyek</h4>
                <button class="navbar-toggler p-0 border-0 text-secondary-black" type="button" data-toggle="filter">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="card-body p-0">
                <form action="{{route('project.browse')}}" method="GET">
                    <div class="form-group row m-0 py-2 w-100 clearfix">
                        <div class="col-12">
                            <label for="category">Kategori Proyek</label>
                            <select id="category" class="form-control col-12 select2" name="category">
                                <option selected value="all">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->slug}}" {{app('request')->input('category') === $category->slug ? 'selected' : '' }}>{{$category->category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="location">Lokasi Proyek</label>
                            <select id="location" class="select2 col-12 w-100 form-control" name="location">
                                @if(!empty(app('request')->input('location')))
                                    <option selected value="{{app('request')->input('location')}}">{{$location_name}}</option>
                                @else
                                    <option selected value="all">Semua Lokasi</option>
                                @endif
                                <option value="all">Semua Lokasi</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="sort">Urutkan</label>
                            <select id="sort" class="form-control col-12" name="sort">
                                <option value="latest" {{app('request')->input('sort') === 'latest' ? 'selected' : '' }}>Urutkan terbaru</option>
                                <option value="oldest" {{app('request')->input('sort') === 'oldest' ? 'selected' : '' }}>Urutkan terlama</option>
                            </select>
                        </div>
                            <button class="btn btn-md btn-secondary" type="submit">Terapkan Filter</button>
                            <a href="{{route('project.browse')}}" class="btn btn-md btn-danger" type="reset">Hapus Filter</a>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="container clearfix my-2">
        <nav class="navbar navbar-light bg-transparent px-0">
            <span class="--text d-none d-md-block">Ada {{$projects->count()}} proyek {{ app('request')->input('category') !== 'all' ? strtolower(str_replace("-", " ", app('request')->input('category'))) : '' }} membutuhkan bantuanmu</span>
            <span class="--text d-block d-md-none">Menampilkan {{$projects->count()}} proyek</span>
            {{-- <button class="navbar-toggler p-0 border-0" type="button" data-toggle="filter">
                <i class="fas fa-filter"></i>
            </button> --}}
            {{-- <a class="btn btn-light btn-sm border-0 " type="button" id="project-filter">
                    <i class="fas fa-filter"></i> Filter
            </a> --}}
            <div class="">
                <a href="#" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modal-filter" data-keyboard="false" data-backdrop="static">
                    <i class="fas fa-filter fw"></i> Filter
                </a>
            </div>

            <div class="modal fade" id="modal-filter" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Filter Proyek</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('project.browse')}}" method="GET">
                            <div class="modal-body">
                                <div class="form-group row m-0">
                                    <div class="col-12 p-0 mb-2">
                                        <label for="category">Kategori Proyek</label>
                                        <select id="category" class="select2 col-12" name="category">
                                            <option value="all">Semua Kategori</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->slug}}" {{app('request')->input('category') === $category->slug ? 'selected' : ''}}>{{$category->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 p-0 mb-2">
                                        <label for="location">Lokasi Proyek</label>
                                        <select id="location" class="select2 col-12" name="location">
                                            @if ($location_name !== '')
                                                <option value="{{app('request')->input('location')}}">{{$location_name}}</option>
                                            @else
                                                <option selected value="all">Semua Lokasi</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-12 p-0 mb-2">
                                        <label for="sort">Urutkan</label>
                                        <select id="sort" class="select2 col-12" name="sort">
                                            <option value="latest" {{app('request')->input('sort') === 'latest' ? 'selected' : ''}}>Publikasi Terbaru</option>
                                            <option value="oldest" {{app('request')->input('sort') === 'oldest' ? 'selected' : ''}}>Publikasi Lama</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-md btn-secondary align-self-md-center mx-1 ml-auto" type="submit"><i class="fas fa-check"></i> Terapkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
            {{-- <div class="collapse navbar-collapse p-3 py-4 bg-white" id="project-filter">
                <form action="{{route('project.browse')}}" method="GET">
                    <div class="form-group row m-0">
                            <div class="col-12 col-md-6 col-lg-4 p-0 px-md-1 mb-2">
                                <label for="category">Kategori Proyek</label>
                                <select id="category" class="select2 col-12" name="category">
                                    <option selected value="all">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->slug}}">{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-6 p-0 col-lg-6 px-md-1 mb-2">
                                <label for="location">Lokasi Proyek</label>
                                <select id="location" class="select2 col-12" name="location">
                                    <option selected value="all">Semua Lokasi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 p-0 col-lg-2 px-md-1 mb-2 mb-md-0">
                                <label for="sort">Urutkan</label>
                                <select id="sort" class="select2 col-12" name="sort">
                                    <option value="latest" selected>Publikasi Terbaru</option>
                                    <option value="oldest">Publikasi Lama</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 col-lg-auto p-0 px-md-1 mt-2 mt-md-0 d-flex flex-row ml-auto">
                                <button class="btn btn-md btn-secondary align-self-md-center mx-1 ml-auto" type="submit"><i class="fas fa-check"></i> Terapkan</button>
                                <a href="{{route('project.browse')}}" class="btn btn-md btn-danger align-self-md-center ml-1" type="reset"><i class="fas fa-undo-alt"></i> Hapus Filter</a>
                            </div>
                    </div>
                </form>
            </div> --}}
        </nav>
        {{-- <span class="btn-btn-"></span> --}}
        {{-- <div class="row section-content d-none d-md-block">
            <div class="col-12 p-0 border-bottom border-secondary-black" id="project-filter" style="">
                <form action="{{route('project.browse')}}" method="GET">
                    <div class="form-group row m-0 py-3 w-100 clearfix">
                        <div class="col-12 col-md-9 d-flex flex-row justify-content-around align-items-center p-0">
                            <div class="col-12 col-md-4 p-0">
                                <label for="category">Kategori Proyek</label>
                                <select id="category" class="form-control col-12 select2" name="category">
                                    <option selected value="all">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->slug}}" {{app('request')->input('category') === $category->slug ? 'selected' : '' }}>{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-4 p-0 px-md-3">
                                <label for="location">Lokasi Proyek</label>
                                <select id="location" class="select2 col-12 w-100 form-control" name="location">
                                    @if(!empty(app('request')->input('location')))
                                        <option selected value="{{app('request')->input('location')}}">{{$location_name}}</option>
                                    @else
                                        <option selected value="all">Semua Lokasi</option>
                                    @endif
                                    <option value="all">Semua Lokasi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4 p-0">
                                <label for="sort">Urutkan</label>
                                <select id="sort" class="form-control col-12" name="sort">
                                    <option value="latest" {{app('request')->input('sort') === 'latest' ? 'selected' : '' }}>Urutkan terbaru</option>
                                    <option value="oldest" {{app('request')->input('sort') === 'oldest' ? 'selected' : '' }}>Urutkan terlama</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mr-4 d-flex flex-row p-0">
                            <button class="btn btn-md btn-secondary" type="submit">Terapkan Filter</button>
                            <a href="{{route('project.browse')}}" class="btn btn-md btn-danger" type="reset">Hapus Filter</a>
                        </div>
                    </div>
                </form>
            </div>
            <span class="--text d-none d-md-block my-3 px-2">Ada {{$projects->count()}} project {{ app('request')->input('category') !== 'all' ? strtolower(str_replace("-", " ", app('request')->input('category'))) : '' }} {{ $filter_location }} membutuhkan bantuanmu</span>
        </div> --}}
        {{-- <div class="section-headline text-secondary my-3">
            <nav class="nav bg-transparent">
                <span class="--text d-none d-md-block">Ada 1244 project kewirausahaan membutuhkan bantuanmu</span>
                <div class="bg-secondary text-white mega-menu ml-auto">
                    <button class="btn btn-sm btn-secondary"><i class="fas fa-filter fw"></i> Filter</button>
                    <div class="mega-menu-content container">
                        <div class="header bg-secondary text-white">
                            <span class="--text _head text-center"><i class="fas fa-filter fw"></i> Filter</span>
                        </div>
                        <div class="row bg-white">
                            <div class="col-12 col-md-6">
                                <h4 class="text-secondary-black py-3 m-0">Kategori Proyek</h4>
                                <div class="list-group list-group-flush">
                                    @foreach ($categories as $category)
                                        <a href="#" class="list-group-item list-group-item-action px-0">{{$category->category}}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                Urutkan
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div> 
        <hr> --}}
        <div class="row section-content">
            @foreach ($projects as $key => $project)    
                @php
                    $progressDana = round(($project->collected_funds / $project->funding_target) * 100);
                    $progressRelawan = round(($project->registered_volunteer / $project->volunteer_quota) * 100);
                @endphp
                <div class="d-campaigns col-12 col-sm-6 col-lg-4 col-xl-3 card-deck">
                    <div class="card card-shadow m-0 border-0 mb-3" style="min-height:485px">
                        <div class="category-flag">
                            <p>{{$project->category->category}}</p>
                        </div>
                        <img class="card-img-top img-fit" src="{{secure_asset($project->project_banner)}}" alt="Card image cap">
                        <div class="media campaigner">
                            <img class="mr-3" src="{{secure_asset($project->user->profile->profile_picture)}}" alt="Profile Picture">
                            <div class="media-body">
                                {{$project->user->profile->name}}
                            </div>
                        </div>
                        <div class="card-header bg-white font-weight-bold">
                            <a href="{{route('project.show', ['slug' => $project->project_slug])}}" class="card-link"><h5 class="card-title m-0 project-title">{{$project->project_name}}</h5></a>
                        </div>
                        <div class="card-body pb-0 pt-4 _project-info hidden" id="info-{{$project->project_slug}}">
                            <div class="row m-0">
                                <span class="col-12 --text p-0">Lokasi</span>
                                <span class="col-12 --text p-0 mb-2 font-weight-bold">{{ucwords(strtolower($project->location->name))}}</span>
                                
                                <span class="col-12 --text p-0">Batas Pendaftaran Relawan</span>
                                <span class="col-12 --text p-0 mb-2 font-weight-bold">{{Idnme::print_date($project->close_reg)}}</span>
                                
                                <span class="col-12 --text p-0">Batas Penerimaan Investasi</span>
                                <span class="col-12 --text p-0 m-0 font-weight-bold">{{Idnme::print_date($project->close_donation)}}</span>
                            </div>
                        </div>
                        <div class="card-body pb-0 pt-4 _project-progress" id="progress-{{$project->project_slug}}">
                            <div class="info-donasi">
                                <span class="--text text-capitalize">investasi terkumpul {{$progressDana}}%</span>
                                <span class="--text font-weight-bold text-capitalize">{{Idnme::print_rupiah($project->collected_funds, false, true)}}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{$progressDana}}%"></div>
                                </div>
                                <span class="--text text-capitalize">target {{Idnme::print_rupiah($project->funding_target)}}</span>
                            </div>
                            <hr class="mt-1 mb-2">
                            <div class="info-relawan">
                                <span class="--text "><b>{{empty($project->registered_volunteer) ? "0" : $project->registered_volunteer}}</b> relawan tergabung dari target <b>{{$project->volunteer_quota}}</b> relawan</span>
                            </div>
                        </div>
                        <div class="card-footer bg-lighten">
                            <button class="btn btn-link text-secondary-black decoration-none w-100 p-0" onclick="javascript:showAndHide(this, '#progress-{{$project->project_slug}}', '#info-{{$project->project_slug}}', 'Lihat Progress', 'Lihat Detail Proyek');" data-action="hide">Lihat Detail Proyek</button>
                        </div>
                        {{-- <div class="card-body">
                            <ul class="nav nav-pills" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                            </div>
                        </div> --}}
                        
                        {{-- <div class="project-needs">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <p class="mb-0"><i class="fas fw fa-map-marker-alt mr-2"></i><small>{{$project->project_location}}</small></p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Dana
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{$progressDana}}%;" aria-valuenow="{{$progressDana}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        <small class="progress-capt">{{$progressDana}} %</small>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Relawan
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{$progressRelawan}}%;" aria-valuenow="{{$progressRelawan}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        <small class="progress-capt">{{$progressRelawan}}%</small>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <p class="mb-0"><i class="fas fw fa-calendar-times mr-1"></i> <small>{{$remainingDays}} lagi</small></p>
                                </li>
                            </ul>
                        </div> --}}
                        {{-- <div class="card-footer px-3">
                            <div class="row">
                                <div class="col-6 text-left">
                                    <p class="mb-0"><small>Lokasi</small></p>
                                    <p class="mb-0">{{$project->project_location}}</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p class="mb-0"><small>Sisa Waktu</small></p>
                                    <p class="mb-0" id="remainingTime">{{$remainingDays}}</p>
                                </div>
                            </div>				      	
                        </div> --}}
                        {{-- <a class="cml text-white" href="{{route('project.show', ['slug' => $project->project_slug])}}">
                            <span>
                                <i class="fas fa-external-link-alt fa-2x"></i><br>
                                Lihat <br>Project
                            </span>
                        </a> --}}
                    </div>
                    {{-- <div class="card m-0 mb-3">
                        <img class="card-img-top rounded-0" src="http://via.placeholder.com/600x400" alt="Card image cap">
                        <div class="media campaigner">
                            <img class="mr-3" src="{{secure_asset($project->user->profile->profile_picture)}}" alt="Generic placeholder image">
                            <div class="media-body">
                                {{$project->user->profile->name}}
                            </div>
                        </div>
                        <div class="category-flag">
                            <p>Pengembangan Karakter Anak</p>
                        </div>
                        <div class="card-body py-0 px-3">
                            <a href="" class="card-link text-secondary-black"><h5 class="card-title">{{$project->project_name}}</h5></a>
                        </div>
                        <div class="project-needs">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Dana
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{$progressDana}}%;" aria-valuenow="{{$progressDana}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        <small class="progress-capt">{{$progressDana}} %</small>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Relawan
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{$progressRelawan}}%;" aria-valuenow="{{$progressRelawan}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        <small class="progress-capt">{{$progressRelawan}}</small>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <p class="mb-0"><i class="fas fw fa-map-marker-alt mr-2"></i><small>{{$project->project_location}}</small></p>
                                </li>
                                <li class="list-group-item">
                                    <p class="mb-0"><i class="fas fw fa-calendar-times mr-1"></i> <small>{{$remainingDays}} lagi</small></p>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer px-3">
                            <div class="row">
                                <div class="col-6 text-left">
                                    <p class="mb-0"><small>Lokasi</small></p>
                                    <p class="mb-0">{{$project->project_location}}</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p class="mb-0"><small>Sisa Hari</small></p>
                                    <p class="mb-0">{{$remainingDays}}</p>
                                </div>
                            </div>				      	
                        </div>
                        <a class="cml text-white" href="{{route('project.show', ['slug' => $project->project_slug])}}">
                            <span>
                                <i class="fas fa-external-link-alt fa-2x"></i><br>
                                Lihat <br>Project
                            </span>
                        </a>
                    </div> --}}
                </div>
            @endforeach
        </div>
        <div class="row section-content float-right p-0 px-3">
            {{ $projects->appends(['category' => $cat, 'location' => $loc, 'sort' => $sort])->links() }}
        </div>
    </div>
@endsection

@section('script')
<script>
    // $(function(){
    //     // Enables popover
    //     $("#project-filter").popover({
    //         container : 'body',
    //         placement : 'bottom',
    //         html : true, 
    //         content: function() {
    //             return $("#project-filter-content").html();
    //         }, 
    //     });

    //     $('#project-filter').on('shown.bs.popover', function () {
    //         $('.popover-body').css('padding', 0);
    //     });
    // });
    $(document).ready(function(){
        $('.select2').select2({
            theme: "bootstrap4",
            tags: false,
        });
        $(document).ajaxSelect2("location", "{{route('get.location', ['def' => 'true'])}}");
    });
</script>
@endsection