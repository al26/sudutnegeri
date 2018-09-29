@extends('layouts.app')

@section('content')
     <div class="section-headline text-secondary">
        {{-- <nav id="filter-nav" class="navbar bg-light navbar-light">
            <div class="container">
                <div>
                    <h5 class="d-none d-md-block">Ada {{count($projects)}} Project Membutuhkan Bantuanmu</h5>
                    <h5 class="d-block d-md-none">Menampilkan 4220 Project</h5>
                </div>
                <button class="btn btn-sm btn-danger" type="button" data-toggle="collapse" data-target="#n" aria-controls="n" aria-expanded="false" aria-label="Toggle navigation">
                    Filter <i class="fas fa-filter"></i>
                </button>
                <div class="collapse navbar-collapse" id="n">
                    <div class="mt-2 row">
                        <div class="col-12 col-md-6">
                            <select class="selectpicker show-tick" data-live-search="true" multiple data-actions-box="true" data-style="btn-primary" title="Pilih Bidang">
                                <option value="2" data-tokens="Pengembangan Karakter Anak">Pengembangan Karakter Anak</option>
                                <option value="3" data-tokens="Kewirausahaan">Kewirausahaan</option>
                                <option value="4" data-tokens="Kesehatan dan Lingkungan">Kesehatan dan Lingkungan</option>
                                <option value="5" data-tokens="Keterampilan">Keterampilan</option>
                                <option value="6" data-tokens="Edukasi Science Dasar">Edukasi Science Dasar</option>
                                <option value="7" data-tokens="Pendidikan Perempuan">Pendidikan Perempuan</option>
                                <option value="8" data-tokens="Wawasan Umum">Wawasan Umum</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="selectpicker show-tick" data-live-search="true" multiple data-actions-box="true" data-style="btn-primary" title="Pilih Lokasi">
                                <option value="2" data-tokens="Jakarta">Jakarta</option>
                                <option value="3" data-tokens="Palembang">Palembang</option>
                                <option value="4" data-tokens="Bandung">Bandung</option>
                                <option value="5" data-tokens="Semarang">Semarang</option>
                                <option value="6" data-tokens="Surabaya">Surabaya</option>
                                <option value="7" data-tokens="Bali">Bali</option>
                                <option value="8" data-tokens="Jayapura">Jayapura</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="selectpicker show-tick" data-live-search="false" multiple data-actions-box="true" data-style="btn-primary" title="Pilih Jenis Project">
                                <option value="2" data-tokens="Project Dana">Project Dana</option>
                                <option value="3" data-tokens="Project Pengabdian">Project Pengabdian</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </nav> --}}
        <nav class="navbar navbar-expand navbar-light bg-light justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Kategori</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Lokasi</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Disabled</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown08">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li>
            </ul>
        </nav>
        {{-- <div class="container my-3">
            <h3>Ada 1244 Project Membutuhkan Bantuanmu</h3>
        </div> --}}
    </div> 
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
    <div class="container clearfix">
        <div class="row section-content">
            @foreach ($projects as $key => $project)    
                @php
                    $progressDana = round(($project->funding_progress / $project->funding_target) * 100);
                    $progressRelawan = round(($project->registered_volunteer / $project->volunteer_quota) * 100);

                    // date_default_timezone_set('Asia/Jakarta');

                    $today = new DateTime('now');
                    $deadline = new DateTime($project->project_deadline);
                    $remainingDays = $today->diff($deadline)->format('%d hari'); 
                    $remainingHours = $today->diff($deadline)->format('%h jam'); 

                    if($remainingDays <= 0) {
                        $remainingDays = $remainingHours;
                    }
                    if($remainingDays <= 0 && $remainingHours < 0) {
                        $remainingDays = "Proyek berakhir";
                    }
                @endphp
                <div class="d-campaigns col-12 col-sm-6 col-lg-4 col-xl-3 card-deck px-1">
                    <div class="card card-shadow m-0 border-0 mb-3" style="min-height:485px">
                        <div class="category-flag">
                            <p>{{$project->category->category}}</p>
                        </div>
                        <img class="card-img-top" src="{{asset($project->project_banner)}}" alt="Card image cap">
                        <div class="media campaigner">
                            <img class="mr-3" src="{{asset($project->user->profile->profile_picture)}}" alt="Profile Picture">
                            <div class="media-body">
                                {{$project->user->profile->name}}
                            </div>
                        </div>
                        <div class="card-header bg-white font-weight-bold">
                            <a href="{{route('project.show', ['slug' => $project->project_slug])}}" class="card-link"><h5 class="card-title m-0">{{$project->project_name}}</h5></a>
                        </div>
                        <div class="card-body pb-0 pt-4 _project-info" id="info-{{$project->project_slug}}">
                            <div class="row m-0">
                                <span class="col-12 --text p-0">Lokasi</span>
                                <span class="col-12 --text p-0 mb-2 font-weight-bold">{{$project->project_location}}</span>
                                
                                <span class="col-12 --text p-0">Batas Pendaftaran Relawan</span>
                                <span class="col-12 --text p-0 mb-2 font-weight-bold">{{$project->close_reg}}</span>
                                
                                <span class="col-12 --text p-0">Batas Penerimaan Investasi</span>
                                <span class="col-12 --text p-0 m-0 font-weight-bold">{{$project->close_donation}}</span>
                            </div>
                        </div>
                        <div class="card-body pb-0 pt-4 _project-progress hidden" id="progress-{{$project->project_slug}}">
                            <div class="info-donasi">
                                <span class="--text text-capitalize">investasi terkumpul {{$progressDana}}%</span>
                                <span class="--text font-weight-bold text-capitalize">{{empty($project->funding_progress) ? Idnme::print_rupiah('0') : Idnme::print_rupiah($project->funding_progress)}}</span>
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
                            <button class="btn btn-link text-secondary-black decoration-none w-100 p-0" onclick="javascript:showAndHide(this, '#info-{{$project->project_slug}}', '#progress-{{$project->project_slug}}', 'Lihat Detail Proyek', 'Lihat Progress');" data-action="hide">Lihat Progresss</button>
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
                            <img class="mr-3" src="{{asset($project->user->profile->profile_picture)}}" alt="Generic placeholder image">
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
            {{ $projects->links() }}
        </div>
    </div>
@endsection