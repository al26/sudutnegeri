@extends('layouts.app')

@section('content')
    <section class="project-header mb-3 d-none d-lg-block">
        <div class="container px-lg-0 pt-3">
            <h1 class="project-title text-capitalize">Judul Project</h1>
            <ul class="list-inline mt-3">
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
            <hr>
        </div>
    </section>

    <section class="project-body pt-3 py-lg-0">
        <div class="container p-0">
            <div class="row">
                <div class="col-lg-4 col-12 border-lg-right order-2 order-lg-1">
                    <div class="card" id="sticky--">
                        <div class="card-body p-md-0 row">
                            <div class="info-donasi col-12 col-md-6 col-lg-12">
                                <div class="info-donasi-content">
                                    <span class="info-donasi-text">terkumpul 70%</span>
                                    <span class="info-donasi-number">Rp 490.000.000</span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                    <span class="info-donasi-text">target Rp 700.000.000</span>
                                </div>
                                <a href="" class="btn btn-small btn-secondary text-capitalize w-100">Mulai Investasi</a>
                            </div>
                            <div class="info-relawan col-12 col-md-6 col-lg-12">
                                <div class="media py-2">
                                    <div class="media-body">
                                        <h5 class="mt-0 text-capitalized">10 Relawan</h5>
                                        <div id="volunteer-carousel" class="owl-carousel owl-theme">
                                            @for ($i = 0; $i < 10; $i++)
                                                <div class="item">                                            
                                                    <img class="" src="http://via.placeholder.com/50x50" alt="Generic placeholder image">
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                    
                                </div>
                                <a href="" class="btn btn-small btn-danger text-capitalize w-100">Jadi Relawan</a>                                
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-lg-8 col-12 order-1 order-lg-2">
                    <div class="container project-img p-md-0">
                        <img src="http://via.placeholder.com/800x500" alt="Project Image" class="img-thumbnail img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="project-detail">
        <div class="container p-0">
            <div class="row">
                <div class="col-lg-4 d-lg-block d-none border-right">
                </div>                
                <div class="col-lg-8 col-12">
                    <div id="detail-container" class="mt-3">
                        <div class="container p-md-0">
                            <nav id="h-project-nav" class="navbar navbar-expand-sm bg-light navbar-dark p-0 py-3">
                                <ul class="nav nav-tabs w-100" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="updates-tab" data-toggle="tab" href="#updates" role="tab" aria-controls="updates" aria-selected="true">Data Historis</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="donatur-tab" data-toggle="tab" href="#donatur" role="tab" aria-controls="donatur" aria-selected="false">Donatur</a>
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
                                        <div class="card card-default">
                                            <div class="card-heading" role="tab" id="heading1">
                                                <div class=" icon"><i class="fas fa-square-full"></i><span class="sr-only">Expand/Collapse</i></div>
                                                <p class="card-text"><span class="badge badge-secondary">24 Juni 2019</span></p>
                                            </div>
                                            <div class="card-body p-0 pt-2">
                                                <div class="timeline-article">
                                                    <h5 class="card-title"><a class="text-default decoration-none" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse10" aria-expanded="true" aria-controls="collapse10">Update #10</a></h5>
                                                    <div id="collapse10" class="card-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                                        <img src="http://placehold.it/800x400" />
                                                        <p> 101010 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua
                                                            put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                                            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                                    </div>
                                                </div>
                                                <div class="timeline-article">
                                                    <h5 class="card-title"><a class="text-default decoration-none" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">Update #3</a></h5>
                                                    <div id="collapse3" class="card-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                                        <img src="http://placehold.it/800x400" />
                                                        <p> 333 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua
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
                        <div class="tab-pane fade" id="donatur" role="tabpanel" aria-labelledby="donatur-tab">
                            2
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta, sunt. Voluptatibus quae odio reprehenderit excepturi voluptate. At vel, consequuntur eos unde recusandae autem quam voluptates, animi debitis quis placeat. Amet.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, laborum! Sunt minus error molestiae doloribus perferendis, soluta veniam dolor sequi maiores facere perspiciatis incidunt itaque assumenda accusantium ducimus, voluptas totam!
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt labore ipsam voluptatum sapiente suscipit quaerat, ab dolor dignissimos consequuntur cumque minus numquam, quas aliquam, exercitationem quis quidem est rerum libero!
                        </div>
                        <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                            3
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam aspernatur excepturi officiis, harum illum porro sequi impedit. Sequi eos iste incidunt explicabo minus quasi autem porro laudantium impedit. Id, iusto.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde fugiat sint inventore nam eligendi modi quos voluptatem? Asperiores quae necessitatibus neque animi voluptas nam quasi recusandae id molestias, expedita velit!
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas voluptate officiis incidunt quisquam est, ducimus veritatis placeat deleniti, sit possimus ipsa, harum qui. Possimus libero modi sed cupiditate, aspernatur harum?
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

$(document).ready(function(){
    $(window).scroll(function(){
        var tab_offset = $('#detail-container').offset().top;
        var sticky_offset = $('.project-body').offset().top;
        var content_width = $('.tab-content').outerWidth();
        var tab = $('#h-project-nav');
        var side_info = $('#sticky--');
        var si_width = side_info.width();

        if ($(this).scrollTop() >= sticky_offset) {  
            side_info.addClass('fixed');
            side_info.width(si_width);
        } else {
            side_info.removeClass('fixed');
        }
        
        if ($(this).scrollTop() >= tab_offset-30) {
            tab.addClass('fixed'); 
            tab.width(content_width);
            isPositionFixed = true;
        } else {
            tab.removeClass('fixed');
        }
    });

    $('#volunteer-carousel').owlCarousel({
        loop:true,
        items:8,
        margin:2,
        nav:false,
        dots:false,
        autoWidth:true,
        autoplay:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
    })
})
@endsection