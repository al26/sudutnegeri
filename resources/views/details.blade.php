@extends('layouts.app')

@section('content')
    {{-- <section class="project-header mb-3 d-none d-lg-block">
        <div class="container py-3 bg-white">
            <div class="row">
                <div class="col-12">
                    <h1 class="project-title text-capitalize">Judul Project</h1>
                    <ul class="list-inline mt-3 mb-0">
                        <li class="list-inline-item pr-3 mr-3 border-right">
                            <div class="media">
                                <img class="mr-3" src="http://via.placeholder.com/64x64" alt="Generic placeholder image" width="50">
                                <div class="media-body">
                                    <p class="mb-2">Campaigner</p>
                                    <h5 class="mb-0">Nama Campaigner</h5>
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item pr-3 border-right">
                            <p class="mb-2">Bidang Pendidikan</p>
                            <h5 class="mb-0">Pendidikan Karakter Anak</h5>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}

    <div class="container mt-lg-3">
        {{-- <div class="row">
            <div class="col-12 px-0 d-none d-lg-block">
                <section class="project-header p-3 bg-white mb-3">
                    <span class="--text _head text-capitalize">Judul Project</span>
                    <ul class="list-inline mt-3 mb-0">
                        <li class="list-inline-item pr-3 mr-3 border-right">
                            <div class="media">
                                <img class="mr-3" src="http://via.placeholder.com/64x64" alt="Generic placeholder image" width="50">
                                <div class="media-body">
                                    <p class="mb-2">Campaigner</p>
                                    <h5 class="mb-0">Nama Campaigner</h5>
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item pr-3 border-right">
                            <p class="mb-2">Bidang Pendidikan</p>
                            <h5 class="mb-0">Pendidikan Karakter Anak</h5>
                        </li>
                    </ul>
                </section>
            </div>
        </div> --}}
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
        <div class="row">
            <div class="col-12 col-lg-4 sticky-side-info --container --left order-2 order-lg-1">
                <div id="sticky--">
                    <section class="card --content mb-lg-3 info-donasi">
                        <div class="card-body">
                            <span class="--text text-capitalize">terkumpul {{$progressDana}}%</span>
                            <span class="--text _head text-capitalize">{{$project->funding_progress}}</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{$progressDana}}%"></div>
                            </div>
                            <span class="--text text-capitalize">target {{$project->funding_target}}</span>                            
                        </div>
                        <div class="card-footer d-none d-lg-block">
                            <a href="" class="btn btn-small btn-secondary text-capitalize w-100">Mulai Investasi</a>
                        </div>
                    </section>
                    <section class="card --content mb-lg-3 info-relawan">
                        <div class="card-body">
                            <span class="--text text-capitalize">{{$project->volunteer_applied}} relawan</span>
                            <div id="volunteer-carousel" class="owl-carousel owl-theme my-2">
                                @for ($i = 1; $i < 9; $i++)
                                    <div class="item">                                            
                                        <img class="" src="{{ asset('storage/profile_pictures/'.$i.'.jpg') }}" alt="Generic placeholder image">
                                    </div>
                                @endfor
                            </div>
                            <span class="--text text-capitalize">target {{$project->volunteer_spot}}</span>                            
                        </div>
                        <div class="card-footer d-none d-lg-block">
                            <a href="" class="btn btn-small btn-danger text-capitalize w-100">Jadi Relawan</a>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-12 col-lg-8 featured --container --right order-1 order-lg-2">
                <section class="card --content mb-lg-3">
                    <div class="--img">
                        <img src="http://via.placeholder.com/800x500" alt="Project Image" class="img-thumbnail img-fluid">
                    </div>
                    <div class="--headline">
                        <span class="--text _head">{{$project->project_name}}</span>
                    </div>
                    <div class="--author">
                        <div class="media">
                            <img class="mr-3" src="{{asset('storage/profile_pictures/'.$project->user->profile->profile_picture)}}" alt="Generic placeholder image" width="50">
                            <div class="media-body">
                                <p class="mb-2">Campaigner</p>
                                <h5 class="mb-0">{{$project->user->profile->name}}</h5>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4"></div>
            <div class="col-12 col-lg-8 --container --right details">
                <section class="card --content">
                    {{-- <nav id="h-project-nav" class="navbar navbar-expand-sm bg-white navbar-dark p-0 m-0">
                        <ul class="nav nav-tabs w-100 nav-fill" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="detil-tab" data-toggle="tab" href="#detil" role="tab" aria-controls="detil" aria-selected="true">Detil</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" id="updates-tab" data-toggle="tab" href="#updates" role="tab" aria-controls="updates" aria-selected="true">Data Historis</a>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sinegeri-tab" data-toggle="tab" href="#sinegeri" role="tab" aria-controls="sinegeri" aria-selected="false">Si Negeri Peduli</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="faq-tab" data-toggle="tab" href="#faq" role="tab" aria-controls="faq" aria-selected="false">F A Q</a>
                            </li>
                        </ul>
                    </nav> --}}
                    {{-- <nav id="h-project-nav" class="navbar navbar-expand-sm bg-white navbar-dark p-0 m-0">
                        <div class="nav nav-tabs" id="myTab" role="tablist">
                                <a class="nav-item nav-link active" id="detil-tab" data-toggle="tab" href="#detil" role="tab" aria-controls="detil" aria-selected="true">Detil</a>
                            
                                <a class="nav-item nav-link" id="updates-tab" data-toggle="tab" href="#updates" role="tab" aria-controls="updates" aria-selected="true">Data Historis</a>
                            
                                <a class="nav-item nav-link" id="sinegeri-tab" data-toggle="tab" href="#sinegeri" role="tab" aria-controls="sinegeri" aria-selected="false">Si Negeri Peduli</a>
                            
                                <a class="nav-item nav-link" id="faq-tab" data-toggle="tab" href="#faq" role="tab" aria-controls="faq" aria-selected="false">F A Q</a>
                        </div>
                    </nav> --}}
                    <div class="nav nav-tabs nav-fill w-100" id="h-project-nav">
                        <a id="hpn-detail" class="nav-item nav-link p-3 active" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'detail'])}}">Detail</a>
                        <a id="hpn-history" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'history'])}}">Data Historis</a>
                        <a id="hpn-sinegeri" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'sinegeri'])}}">Si Negeri Peduli</a>
                        <a id="hpn-faq" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'faq'])}}">FAQ</a>
                    </div>
                </section>
                <section class="card --content" id="hpn-content" data-pjax-container>
                    {{-- <div class="tab-content clearfix p-3 pt-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="detil" role="tabpanel" aria-labelledby="detil-tab">
                            {!! $project->description !!}
                        </div>
                        <div class="tab-pane fade" id="updates" role="tabpanel" aria-labelledby="updates-tab">
                            <div class="timeline">
                                <div class="line text-muted"></div>
                                <div class="" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="card card-default">
                                        <div class="card-heading" role="tab" id="heading1">
                                            <div class=" icon"><i class="far fa-dot-circle"></i><span class="sr-only">Expand/Collapse</i></div>
                                            <p class="card-text"><span class="badge badge-secondary">24 April 2019</span></p>
                                        </div>
                                        <div class="card-body p-0 pt-2">
                                            <div class="timeline-article">
                                                <h5 class="card-title"><a class="text-default decoration-none" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">Update #1</a></h5>
                                                <div id="collapse2" class="card-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                                    <img src="http://placehold.it/800x400" />
                                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua
                                                        put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                                </div>
                                            </div>
                                            <div class="timeline-article">
                                                <h5 class="card-title"><a class="text-default decoration-none" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">Update #4</a></h5>
                                                <div id="collapse4" class="card-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                                    <img src="http://placehold.it/800x400" />
                                                    <p> 444 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua
                                                        put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-default">
                                        <div class="card-heading" role="tab" id="heading1">
                                            <div class=" icon"><i class="far fa-dot-circle"></i></div>
                                            <p class="card-text text-capitalize"><span class="badge badge-secondary">24 April 2019</span></p>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title m-0">Project Dipublikasikan</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sinegeri" role="tabpanel" aria-labelledby="donatur-tab">
                            <div class="list-relawan">
                                <span class="--text text-uppercase mb-2 border-bottom"><a class="text-default decoration-none" role="button" data-toggle="collapse" data-parent=".list-relawan" href="#lr" aria-expanded="true" aria-controls="lr">Relawan</a></span>
                                <div id="lr" class="collapse show mb-2">
                                    <div class="row">
                                        @for ($i = 0; $i < 10; $i++)
                                            <div class="col-12 col-md-6 col-xl-4">
                                                <div class="media mb-2">
                                                    <img class="mr-3" src="http://via.placeholder.com/50x50" alt="Generic placeholder image" width="50">
                                                    <div class="media-body">
                                                        <span class="mb-2 --text">Nama Relawan</span>
                                                        <span class="mb-0 --text _sub">Profesi Relawan</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="list-donatur">
                                <span class="--text text-uppercase mb-2 border-bottom"><a class="text-default decoration-none" role="button" data-toggle="collapse" data-parent=".list-donatur" href="#ld" aria-expanded="true" aria-controls="ld">Donatur</a></span>
                                <div id="ld" class="collapse show mb-2">
                                    <div class="row">
                                        @for ($i = 0; $i < 10; $i++)
                                            <div class="col-12 col-md-6 col-xl-4">
                                                <div class="media mb-2">
                                                    <img class="mr-3" src="http://via.placeholder.com/50x50" alt="Generic placeholder image" width="50">
                                                    <div class="media-body">
                                                        <span class="mb-2 --text">Nama Donatur</span>
                                                        <span class="mb-0 --text _sub">Profesi Donatur</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                            <div id="faq-accordion">
                                @for ($i = 1; $i < 6; $i++)
                                    <div class="card">
                                    <div class="card-header collapsed" role="button" data-toggle="collapse" data-target="#faq{{$i}}" aria-expanded="false" aria-controls="collapse{{$i}}" id="q{{$i}}">
                                            <h5 class="mb-0"> Question {{$i}}
                                                <i class="more-less fas fa-chevron-up float-right" aria-hidden="true"></i>
                                            </h5>
                                        </div>
                                    
                                        <div id="faq{{$i}}" class="collapse" data-parent="#faq-accordion" aria-labelledby="q{{$i}}">
                                            <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div> --}}
                    @php
                        if (empty($menu)) $menu = "detail";
                        $data['project'] = $project;
                    @endphp
                    <div class="card-body">
                        @include("guest.partials.project_$menu", $data)
                    </div>
                </section>
            </div>
        </div>
    </div>
    

    {{-- <section class="project-body pt-3 py-lg-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12 order-2 order-lg-1">
                    <div class="card" id="sticky--">
                        <div class="card-body p-md-0 row">
                            <div class="info-donasi col-12 col-md-6 col-lg-12 bg-white">
                                <div class="info-donasi-content mb-2 py-3 px-0">
                                    <span class="info-donasi-text">terkumpul 70%</span>
                                    <span class="info-donasi-number">Rp 490.000.000</span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                    <span class="info-donasi-text">target Rp 700.000.000</span>
                                    <a href="" class="btn btn-small btn-secondary text-capitalize w-100 mt-2">Mulai Investasi</a>
                                </div>
                            </div>
                            <div class="info-relawan col-12 col-md-6 col-lg-12 bg-white">
                                <div class="info-relawan-content mb-2 py-3 px-0">
                                    <span class="info-relawan-text">10 Relawan</span>
                                    <div id="volunteer-carousel" class="owl-carousel owl-theme">
                                        @for ($i = 1; $i < 11; $i++)
                                            <div class="item">                                            
                                                <img class="" src="{{ asset('storage/profile_pictures/'.$i.'.jpg') }}" alt="Generic placeholder image">
                                            </div>
                                        @endfor
                                    </div>
                                    <a href="" class="btn btn-small btn-danger text-capitalize w-100 mt-2">Jadi Relawan</a>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-lg-8 col-12 order-1 order-lg-2 pr-lg-0">
                    <div class="container-fluid bg-white py-3">
                        <div class="project-img py-md-3">
                            <img src="http://via.placeholder.com/800x500" alt="Project Image" class="img-thumbnail img-fluid">
                        </div>
                        <div class="project-desc">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste nisi incidunt ab, provident unde officia soluta voluptas quos! Recusandae, nulla? Ipsum itaque ullam a accusantium, quisquam enim est facilis obcaecati.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <section class="project-detail">
        <div class="container p-0">
            <div class="row">
                <div class="col-lg-4 d-lg-block d-none">
                </div>                
                <div class="col-lg-8 col-12 inner-fill bg-white">
                    <div id="detail-container" class="mt-3">
                        <div class="container p-md-0">
                            <nav id="h-project-nav" class="navbar navbar-expand-sm bg-white navbar-dark p-0 m-0">
                                <ul class="nav nav-tabs w-100 nav-fill" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="updates-tab" data-toggle="tab" href="#updates" role="tab" aria-controls="updates" aria-selected="true">Data Historis</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="sinegeri-tab" data-toggle="tab" href="#sinegeri" role="tab" aria-controls="sinegeri" aria-selected="false">Si Negeri Peduli</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="faq-tab" data-toggle="tab" href="#faq" role="tab" aria-controls="faq" aria-selected="false">F A Q</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="tab-content clearfix p-3 pt-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="updates" role="tabpanel" aria-labelledby="updates-tab">
                            <div class="container p-0">
                                <h2 class="custom-divider text-secondary border-secondary w-50"><span>2019</span></h2>
                                <div class="timeline">
                                    <div class="line text-muted"></div>
                                    <div class="" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="card card-default">
                                            <div class="card-heading" role="tab" id="heading1">
                                                <div class=" icon"><i class="fas fa-square-full"></i><span class="sr-only">Expand/Collapse</i></div>
                                                <p class="card-text"><span class="badge badge-secondary">24 April 2019</span></p>
                                            </div>
                                            <div class="card-body p-0 pt-2">
                                                <div class="timeline-article">
                                                    <h5 class="card-title"><a class="text-default decoration-none" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">Update #1</a></h5>
                                                    <div id="collapse2" class="card-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                                        <img src="http://placehold.it/800x400" />
                                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua
                                                            put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                                            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                                    </div>
                                                </div>
                                                <div class="timeline-article">
                                                    <h5 class="card-title"><a class="text-default decoration-none" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">Update #4</a></h5>
                                                    <div id="collapse4" class="card-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                                        <img src="http://placehold.it/800x400" />
                                                        <p> 444 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua
                                                            put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                                            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sinegeri" role="tabpanel" aria-labelledby="donatur-tab">
                            <div class="container p-0">
                                2
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta, sunt. Voluptatibus quae odio reprehenderit excepturi voluptate. At vel, consequuntur eos unde recusandae autem quam voluptates, animi debitis quis placeat. Amet.
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, laborum! Sunt minus error molestiae doloribus perferendis, soluta veniam dolor sequi maiores facere perspiciatis incidunt itaque assumenda accusantium ducimus, voluptas totam!
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt labore ipsam voluptatum sapiente suscipit quaerat, ab dolor dignissimos consequuntur cumque minus numquam, quas aliquam, exercitationem quis quidem est rerum libero!
                            </div>
                        </div>
                        <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                            <div class="container p-0">
                                3
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta, sunt. Voluptatibus quae odio reprehenderit excepturi voluptate. At vel, consequuntur eos unde recusandae autem quam voluptates, animi debitis quis placeat. Amet.
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, laborum! Sunt minus error molestiae doloribus perferendis, soluta veniam dolor sequi maiores facere perspiciatis incidunt itaque assumenda accusantium ducimus, voluptas totam!
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt labore ipsam voluptatum sapiente suscipit quaerat, ab dolor dignissimos consequuntur cumque minus numquam, quas aliquam, exercitationem quis quidem est rerum libero!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@section('script')
<script>
    $(document).ready(function(){
        toggleActiveMenuTab();
        
        $(window).scroll(function(){
            var tab_offset = $('.details').offset().top;
            var sticky_offset = $('.sticky-side-info').offset().top;
            var tab = $('#h-project-nav');
            var content_width = tab.innerWidth();
            var side_info = $('#sticky--');
            var si_width = side_info.width();
            {{-- var footer_pos = $('footer').offset().top; --}}

            if ($(this).scrollTop() >= sticky_offset) {  
                side_info.addClass('fixed');
                side_info.width(si_width);
            } else {
                side_info.removeClass('fixed');
            }

            if ($(this).scrollTop() >= tab_offset) {
                tab.addClass('fixed'); 
                tab.width(content_width);
            } else {
                if (tab.hasClass('fixed')) {
                    tab.removeClass('fixed');
                }
            }

            if (screen.width < 992 ) {
                side_info.width('auto');
                tab.width('100%');
            }
            
            {{-- if (footer_pos < $(this).scrollTop()) --}}

            console.log( "scrolltop :" + $(this).scrollTop() );
            console.log( "tab offset :" + tab_offset );
            console.log( "tab pos :" + tab.offset().top );
            {{-- console.log( "footer :" + footer_pos ); --}}
            console.log( "innerHeight :" + $(this).innerHeight() );
            {{-- console.log( "content innerHeight :" + $('#myTabContent').innerHeight() ); --}}
        });

        $('#volunteer-carousel').owlCarousel({
            margin:2,
            nav:false,
            dots:false,
            autoWidth:true,
            autoplay:true,
            autoplayTimeout:1000,
            autoplayHoverPause:true,
            onInitialized: callback,
        });

        $('#faq-accordion > .card').on('hidden.bs.collapse', toggleIcon);
            $('#faq-accordion > .card').on('shown.bs.collapse', toggleIcon);
    });

    function callback(event) {
        var items = event.item.count;
        
        this.options.items = items;
        if (items <= 6) {
            this.options.loop = false;
        } else {
            this.options.loop = true;
        }
    }

    function toggleIcon(e) {
        $(e.target)
            .prev('.card-header')
            .find(".more-less")
            .toggleClass('fa-chevron-up fa-chevron-down');
    }

    $(document).pjax('a[data-pjax=hpn-menu]', '#hpn-content', {scrollTo:false});

    $('#hpn-content').on('pjax:send', function() {
        toggleActiveMenuTab();
    });

    function toggleActiveMenuTab() {
        var path = document.location.pathname,
            menu = path.split("/");
        $('#h-project-nav a').each(function() {
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
        });
        $('#hpn-'+menu[4]).addClass('active');
    }
</script>
@endsection