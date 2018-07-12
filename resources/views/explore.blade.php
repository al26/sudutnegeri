@extends('layouts.app')

@section('content')
     <div class="section-headline text-secondary">
        <nav id="filter-nav" class="navbar bg-light navbar-light">
            <div class="container">
                <div>
                    <h5 class="d-none d-md-block">Ada 4220 Project Membutuhkan Bantuanmu</h5>
                    <h5 class="d-block d-md-none">Menampilkan 4220 Project</h5>
                </div>
                <button class="btn btn-sm btn-danger" type="button" data-toggle="collapse" data-target="#n" aria-controls="n" aria-expanded="false" aria-label="Toggle navigation">
                    Filter <i class="fas fa-filter"></i>
                </button>
                <div class="collapse navbar-collapse" id="n">
                    <div class="mt-2 row">
                        <div class="col-12 col-md-6">
                            <select class="selectpicker show-tick" data-live-search="true" multiple data-actions-box="true" data-style="btn-primary" title="Pilih Bidang">
                                {{-- <option value="1">Semua Bidang</option> --}}
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
                                {{-- <option value="1">Semua Lokasi</option> --}}
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
                                {{-- <option value="1">Semua Jenis</option> --}}
                                <option value="2" data-tokens="Project Dana">Project Dana</option>
                                <option value="3" data-tokens="Project Pengabdian">Project Pengabdian</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
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
    <div class="section-deadline">

    </div>
    <div class="container clearfix">
        <div class="row section-content">
            @foreach ($projects as $key => $project)    
                @php
                    $progressDana = round(($project->funding_progress / $project->funding_target) * 100);
                    $progressRelawan = round(($project->volunteer_applied / $project->volunteer_spot) * 100);

                    date_default_timezone_set('Asia/Jakarta');

                    $today = new DateTime('now');
                    $deadline = new DateTime($project->deadline);
                    $remainingDays = $today->diff($deadline)->format('%d hari'); 
                    $remainingHours = $today->diff($deadline)->format('%h jam'); 

                    if($remainingDays <= 0) {
                        $remainingDays = $remainingHours;
                    }
                    if($remainingDays <= 0 && $remainingHours < 0) {
                        $remainingDays = "Proyek berakhir";
                    }
                @endphp
                <div class="d-campaigns col-12 col-sm-6 col-lg-4 col-xl-3 card-deck">
                    <div class="card m-0 mb-3">
                        <img class="card-img-top rounded-0" src="http://via.placeholder.com/600x400" alt="Card image cap">
                        <div class="media campaigner">
                            <img class="mr-3" src="http://via.placeholder.com/200x200" alt="Generic placeholder image">
                            <div class="media-body">
                                {{$project->user->profile->name}}
                            </div>
                        </div>
                        <div class="card-body py-0 px-3">
                            <a href="" class="card-link text-danger"><h5 class="card-title">{{$project->project_name}}</h5></a>
                            {{-- <p class="card-text">{!! $project->description !!}</p> --}}
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
                            </ul>
                        </div>
                        <div class="card-footer px-3">
                            <div class="row">
                                <div class="col-6 text-left">
                                    <p class="mb-0"><small>Lokasi</small></p>
                                    <p class="mb-0">{{$project->location}}</p>
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
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row section-content float-right p-0 px-3">
            {{ $projects->links() }}
        </div>
    </div>
@endsection