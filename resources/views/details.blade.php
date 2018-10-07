@extends('layouts.app')

@section('content')
    <div class="container my-lg-3">
        @php
            $progressDana = round(($project->collected_funds / $project->funding_target) * 100);
            $progressRelawan = round(($project->registered_volunteer / $project->volunteer_quota) * 100);

            // date_default_timezone_set('Asia/Jakarta');

            // $today = new DateTime('now');
            // $deadline = new DateTime($project->project_deadline);
            // $remainingDays = $today->diff($deadline)->format('%d hari'); 
            // $remainingHours = $today->diff($deadline)->format('%h jam'); 

            // if($remainingDays <= 0) {
            //     $remainingDays = $remainingHours;
            // }
            // if($remainingDays <= 0 && $remainingHours < 0) {
            //     $remainingDays = "Proyek berakhir";
            // }
        @endphp
        <div class="row">
            <div class="col-12 col-lg-4 sticky-side-info --container --left order-2 order-lg-1">
                <div id="sticky--">
                    <section class="card --content mb-lg-3 info-donasi">                        
                        <div class="card-body">
                            <div class="row m-0">
                                <div class="col-lg-3 d-none px-0 d-lg-flex flex-row">
                                    <i class="fas fa-coins fa-5x align-self-center"></i>
                                </div>
                                <div class="col-12 col-lg-8 offset-lg-1 offset-xl-0 px-0">
                                    <span class="--text text-capitalize">terkumpul {{$progressDana}}%</span>
                                    <h4 class="m-0">{{Idnme::print_rupiah($project->collected_funds, false, true) }}</h4>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{$progressDana}}%"></div>
                                    </div>
                                    <span class="--text text-capitalize">target {{Idnme::print_rupiah($project->funding_target, false, true)}}</span>                            
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-none d-lg-block">
                            @auth
                                @if ($project->user_id === Auth::user()->id)
                                    <span class="btn btn-small btn-secondary text-capitalize w-100 disabled">Mulai Investasi</span>
                                @else
                                    <a id="donation-btn" class="btn btn-small btn-secondary text-capitalize w-100" href="{{route('donation.create', ['slug' => $project->project_slug]) }}">Mulai Investasi</a>
                                @endif
                            @else
                                <a id="donation-btn" class="btn btn-small btn-secondary text-capitalize w-100" href="{{route('donation.create', ['slug' => $project->project_slug]) }}">Mulai Investasi</a>
                            @endauth

                        </div>
                    </section>
                    <section class="card --content mb-lg-3 info-relawan">
                        <div class="card-body">
                            <span class="--text text-capitalize">{{empty($project->registered_volunteer) ? "0" : $project->registered_volunteer}} relawan</span>
                            @if ($project->registered_volunteer > 0)
                                @php
                                    $registered_volunteer = $project->volunteers()->where('status', 'accepted')->get();
                                @endphp
                                <div id="volunteer-carousel" class="owl-carousel owl-theme my-2">
                                    @foreach ($registered_volunteer as $volunteer)
                                        <div class="item">                                   
                                            <img class="" src="{{ asset($volunteer->user->profile->profile_picture) }}" alt="Foto Profil Relawan" title="{{$volunteer->user->profile->name}}" data-toggle="tooltip" data-placement="top">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <span class="--text text-capitalize">target {{$project->volunteer_quota}} relawan</span>                            
                        </div>
                        <div class="card-footer d-none d-lg-block">
                            @auth
                                @if ($project->user_id === Auth::user()->id)
                                    <span class="btn btn-small btn-danger text-capitalize w-100 disabled">Jadi Relawan</span>
                                @else
                                    <a id="volunteer-btn" class="btn btn-small btn-danger text-capitalize w-100" href="{{route('volunteer.create', ['slug' => $project->project_slug])}}">Jadi Relawan</a>
                                @endif
                            @else
                                <a id="volunteer-btn" class="btn btn-small btn-danger text-capitalize w-100" href="{{route('volunteer.create', ['slug' => $project->project_slug])}}">Jadi Relawan</a>
                            @endauth
                        </div>
                    </section>
                    {{-- <section class="card --content">
                        <div class="card-body">
                            <span>Proyek ini mencurigrakan ? <a href="" class="card-link"> Laporkan</a></span>
                        </div>
                    </section> --}}
                    {{-- <section class="card --content">
                        <div class="card-body">
                            <div class="fb-share-button" data-href="{{URL::current()}}" data-layout="button_count"></div>
                        </div>
                    </section> --}}
                </div>
            </div>
            <div class="col-12 col-lg-8 featured --container --right order-1 order-lg-2">
                <section class="card --content mb-lg-3">
                    <div class="--img">
                        <img src="{{asset($project->project_banner)}}" alt="Project Image" class="img-thumbnail img-fluid">
                    </div>
                    <div class="--headline">
                        <span class="--text _head">{{$project->project_name}}</span>
                    </div>
                    <div class="px-3 py-1">
                        <span class="--text _sub"><i class="fas fa-tag fw mr-2"></i> {{$project->category->category}} <span class="mx-1">|</span> <i class="fas fa-map-marker-alt fw mr-2"></i> {{ucwords(strtolower($project->location->name))}}</span>
                    </div>
                    <div class="--author">
                        <div class="media">
                            <img class="mr-3" src="{{asset($project->user->profile->profile_picture)}}" alt="Generic placeholder image" width="50">
                            <div class="media-body">
                                <p class="mb-2">Si Sudut</p>
                                <h5 class="mb-0">{{$project->user->profile->name}}</h5>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8 ml-auto --container --right details">
                {{-- <div id="hpn-menu-hidden">
                    <div class="nav nav-tabs nav-fill w-100">
                        <a id="hpn-detail" class="nav-item nav-link p-3 active" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'detail'])}}">Detail</a>
                        <a id="hpn-history" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'history'])}}">Data Historis</a>
                        <a id="hpn-sinegeri" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'sinegeri'])}}">Si Negeri Peduli</a>
                    </div>
                </div> --}}
                <section class="card --content" id="hpn-menu">
                    <div class="nav nav-tabs nav-fill w-100">
                        <a id="hpn-detail" class="nav-item nav-link p-3 active" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'detail'])}}">Detail</a>
                        <a id="hpn-history" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'history'])}}">Data Historis</a>
                        <a id="hpn-sinegeri" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'sinegeri'])}}">Si Negeri Peduli</a>
                        {{-- <a id="hpn-faq" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="hpn-menu" href="{{route('project.show', ['slug' => $slug, 'menu' => 'faq'])}}">FAQ</a> --}}
                    </div>
                </section>
                <section class="card --content" id="hpn-content" data-pjax-container style="min-height:100vh">
                    @php
                        if (empty($menu)) $menu = "detail";
                        $data['project'] = $project;
                        $data['donators'] = $project->donations()->where('status', 'verified')->get();
                        $data['volunteers'] = $project->volunteers()->where('status', 'accepted')->get();
                    @endphp
                    <div class="card-body">
                        @include("guest.partials.project_$menu", $data)
                    </div>
                </section>
            </div>
        </div>
        <div class="row d-flex flex-row justify-content-between align-items-center btn-bottom d-lg-none">
            @auth
                @if ($project->user_id === Auth::user()->id)
                    {{-- <span class="btn btn-small btn-secondary text-capitalize w-50 disabled">Mulai Investasi</span>
                    <span class="btn btn-small btn-danger text-capitalize w-50 disabled">Jadi Relawan</span> --}}
                @else
                    <a id="donation-btn" class="btn btn-md btn-secondary text-capitalize py-3 w-50" href="{{route('donation.create', ['slug' => $project->project_slug]) }}">Mulai Investasi</a>
                    <a id="volunteer-btn" class="btn btn-md btn-danger text-capitalize py-3 w-50" href="{{route('volunteer.create', ['slug' => $project->project_slug])}}">Jadi Relawan</a>
                @endif
            @else
                <a id="donation-btn" class="btn btn-md btn-secondary text-capitalize py-3 w-50" href="{{route('donation.create', ['slug' => $project->project_slug]) }}">Mulai Investasi</a>
                <a id="volunteer-btn" class="btn btn-md btn-danger text-capitalize py-3 w-50" href="{{route('volunteer.create', ['slug' => $project->project_slug])}}">Jadi Relawan</a>
            @endauth
        </div>
    </div>
    @include('components.modal')
@endsection

@section('script')
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script>
    $(document).ready(function(){
        toggleActiveMenuTab();
        $(document).loadModal();
        // $(document).activeteSelectPicker();

        $('#donation-btn').on('click', function(e){
            var isAuth = "{{Auth::check()}}";
            // var continue = 
            var url = "/login?continue=" + encodeURIComponent(window.btoa($(this).attr('href')));
            if(!isAuth) {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Anda belum Login. Silahkan Login terlebih dahulu untuk melanjutkan donasi!',
                    showConfirmButton: false,
                    footer: '<a href="' + url + '" class="btn btn-secondary btn-sm">Login di sini</a>'
                });
                return false;
            } else {
                return true;
            }
        });

        $('#volunteer-btn').on('click', function(e){
            var isAuth = "{{Auth::check()}}";
            // var continue = 
            var url = "/login?continue=" + encodeURIComponent(window.btoa($(this).attr('href')));
            if(!isAuth) {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Anda belum Login. Silahkan Login terlebih dahulu untuk melanjutkan pendaftaran sebagai relawan!',
                    showConfirmButton: false,
                    footer: '<a href="' + url + '" class="btn btn-secondary btn-sm">Login di sini</a>'
                });
                return false;
            } else {
                return true;
            }
        });

        // tab.width(tab_content.innerWidth());


        $(window).on('resize', function(){
            var tab_content = $('#hpn-content'),
                tab = $('#hpn-menu');
            
            tab.width(tab_content.innerWidth());
            // tab.offset({left : tab_content.offset().left});
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
                // tab.offset({left : tab_content.offset().left});

            if((window.innerWidth >= 768 && window.innerWidth < window.innerHeight) || (window.innerWidth >= 992 && window.innerWidth > window.innerHeight) ) {
                if ($(this).scrollTop() > sticky_offset) {
                    side_info.stop().animate({
                        marginTop: topPadding + $(this).scrollTop() - sticky_offset
                    });
                } else {
                    side_info.stop().animate({
                        marginTop: 0
                    });
                }
    
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

            // if(window.innerWidth < 768 && window.innerHeight > window.innerWidth) {
            //     if ($(this).scrollTop() >= tab_offset) {
            //         tab.addClass('fixed');
            //         tab.width(tab_width);
            //         // tab.offset({left : tab_content.offset().left});
            //     } else {
            //         tab.removeClass('fixed');
            //         // tab.offset({left : tab_content.offset().left});
            //     }
            // }
            

            // if (tab.hasClass('fixed')) {
            //     tab_content.stop().animate({
            //         'margin-top' : tab_height
            //     });
            // } else {
            //     tab_content.stop().animate({
            //         'margin-top' : '0'
            //     });
            // }

            // console.log( "scrolltop :" + $(this).scrollTop());
            // console.log( "tab offset :" + tab_offset );
            // console.log( "tab pos :" + tab.offset().top );
            // console.log( "edge :" + edge );
            // console.log( "outerHeight :" + tab.outerHeight() );
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

        activateTogglingIcon();
    });

    function activateTogglingIcon() {
        $('#faq-accordion > .card').on('hidden.bs.collapse', toggleIcon);
        $('#faq-accordion > .card').on('shown.bs.collapse', toggleIcon);
    }

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
        activateTogglingIcon();
    });

    $('#hpn-content').on('pjax:complete', function() {
        activateTogglingIcon();
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