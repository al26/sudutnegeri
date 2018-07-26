@extends('layouts.app')

@section('content')
    <div class="container mt-lg-3">
        @php
            $progressDana = round(($project->funding_progress / $project->funding_target) * 100);
            $progressRelawan = round(($project->registered_volunteer / $project->volunteer_quota) * 100);

            date_default_timezone_set('Asia/Jakarta');

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
                            <a id="donation-btn" class="btn btn-small btn-secondary text-capitalize w-100" href="{{route('donation.create', ['slug' => $project->project_slug])}}">Mulai Investasi</a>
                        </div>
                    </section>
                    <section class="card --content mb-lg-3 info-relawan">
                        <div class="card-body">
                            <span class="--text text-capitalize">{{empty($project->registered_volunteer) ? "0" : $project->registered_volunteer}} relawan</span>
                            <div id="volunteer-carousel" class="owl-carousel owl-theme my-2">
                                @for ($i = 1; $i < 9; $i++)
                                    <div class="item">                                            
                                        <img class="" src="{{ asset('storage/profile_pictures/'.$i.'.jpg') }}" alt="Generic placeholder image">
                                    </div>
                                @endfor
                            </div>
                            <span class="--text text-capitalize">target {{$project->volunteer_quota}}</span>                            
                        </div>
                        <div class="card-footer d-none d-lg-block">
                            <a class="btn btn-small btn-danger text-capitalize w-100" href="">Jadi Relawan</a>
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
                            <img class="mr-3" src="{{asset($project->user->profile->profile_picture)}}" alt="Generic placeholder image" width="50">
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
            <div class="col-12 col-lg-8 ml-auto --container --right details">
                <section class="card --content" id="hpn-menu">
                    <div class="nav nav-tabs nav-fill w-100">
                        <a id="hpn-detail" class="nav-item nav-link p-3 active" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'detail'])}}">Detail</a>
                        <a id="hpn-history" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'history'])}}">Data Historis</a>
                        <a id="hpn-sinegeri" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'sinegeri'])}}">Si Negeri Peduli</a>
                        <a id="hpn-faq" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'faq'])}}">FAQ</a>
                    </div>
                </section>
                <section class="card --content" id="hpn-content" data-pjax-container>
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
    @include('components.modal')
@endsection

@section('script')
<script>
    $(document).ready(function(){
        toggleActiveMenuTab();
        $(document).loadModal();
        // $(document).activeteSelectPicker();

        $('#donation-btn').on('click', function(e){
            // e.preventDefault();
            var isAuth = "{{Auth::check()}}";
            
            if(!isAuth) {
                return false;
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Anda belum Login. Silahkan Login terlebih dahulu !',
                    showConfirmButton: false,
                    footer: '<a href="{{route('login')}}" class="btn btn-secondary btn-sm">Login</a>'
                });
            } else {
                return true;
            }
        });


        $(window).scroll(function(){
            var tab_offset = $('.details').offset().top,
                tab_content = $('#hpn-content'),
                tab = $('#hpn-menu'),
                tab_height = tab.outerHeight(),
                tab_width = tab.innerWidth(),
                sticky_offset = $('.sticky-side-info').offset().top,
                side_info = $('#sticky--'),
                edge = $('footer').offset().top - side_info.outerHeight(),
                topPadding = 16;

            if ($(this).scrollTop() > sticky_offset) {
                side_info.stop().animate({
                    marginTop: topPadding + $(this).scrollTop() - sticky_offset
                });
            } else {
                side_info.stop().animate({
                    marginTop: 0
                });
            }

            if ($(this).scrollTop() > edge) {
                side_info.stop();
            }

            if ($(this).scrollTop() >= tab_offset) {
                tab.addClass('fixed');
                tab.width(tab_width);
            } else {
                tab.removeClass('fixed');
            }

            if (tab.hasClass('fixed')) {
                tab_content.stop().animate({
                    'margin-top' : tab_height
                });
            } else {
                tab_content.stop().animate({
                    'margin-top' : '0'
                });
            }

            console.log( "scrolltop :" + $(this).scrollTop());
            // console.log( "tab offset :" + tab_offset );
            // console.log( "tab pos :" + tab.offset().top );
            console.log( "edge :" + edge );
            console.log( "outerHeight :" + tab.outerHeight() );
            // console.log( "content innerHeight :" + $('#myTabContent').innerHeight() );
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

    $(document).pjax('a[data-pjax=hpn-menu]', '#hpn-content', {scrollTo:$('.details').offset().top});

    $('#hpn-content').on('pjax:send', function() {
        toggleActiveMenuTab();
    });

    function toggleActiveMenuTab() {
        var path = document.location.pathname,
            menu = path.split("/");
        $('#hpn-menu a').each(function() {
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
        });
        $('#hpn-'+menu[4]).addClass('active');
    }
</script>
@endsection