@extends('layouts.app')

@section('content')
    <section class="project-header mb-3">
        <div class="container px-0">
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
    <section class="project-body">
        <div class="container p-0">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="card" id="sticky--">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>                
                <div class="col-md-8">
                    <div class="project-img">
                        <img src="http://via.placeholder.com/800x500" alt="Project Image" class="img-thumbnail img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section id="d" class="mt-3">
        <div class="container p-0">
            <nav id="h-project-nav" class="navbar navbar-expand-sm bg-light navbar-dark">
                <ul class="nav nav-tabs ml-auto" id="myTab" role="tablist">
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
            </nav>
        </div>
    </section> --}}

    <section class="project-detail">
        <div class="container p-0">
            <div class="row">
                <div class="col-md-4 border-right">
                </div>                
                <div class="col-md-8">
                    <div id="detail-container" class="mt-3">
                        <div class="container p-0">
                            <nav id="h-project-nav" class="navbar navbar-expand-sm bg-light navbar-dark p-0 py-3">
                                <ul class="nav nav-tabs w-100" id="myTab" role="tablist">
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
                            </nav>
                        </div>
                    </div>
                    <div class="tab-content clearfix px-3 pt-5 pb-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            1
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi modi eaque iusto ullam iste fuga molestiae quasi expedita culpa animi nihil, magni porro cumque vitae, excepturi suscipit. Maiores, impedit unde.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic fuga delectus numquam? Cupiditate, commodi iusto eveniet voluptatibus rem omnis sed ipsum illum possimus. Modi blanditiis excepturi molestias porro consectetur soluta!
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit neque fuga accusantium saepe ad tenetur, voluptas dolor consequatur unde sequi, minus itaque doloremque debitis eligendi expedita quo quibusdam atque dolores.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ducimus libero eaque, debitis voluptate ullam in similique hic impedit incidunt autem quidem sunt vel, reprehenderit, ipsum quas adipisci illo blanditiis.
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores repudiandae pariatur expedita asperiores unde autem eligendi ullam similique voluptate! Quaerat fugit eum dicta laudantium reprehenderit modi doloribus at porro fugiat.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit accusamus dolor perspiciatis recusandae maiores, non et, maxime assumenda fugiat nihil corporis doloremque sunt laboriosam, modi dolorem quo perferendis ratione impedit.
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur necessitatibus, iure sapiente dolorum reprehenderit harum eaque ducimus aliquam veniam laborum consectetur, animi rerum cupiditate asperiores, ab illum esse mollitia eos!
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, quis eaque provident sequi, amet eius animi culpa officia aperiam enim expedita eum. Autem deleniti aliquam neque ab nihil, perferendis eaque.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus ea eos accusantium nemo, quo ad, error ipsam aspernatur laborum delectus recusandae adipisci expedita qui rem ducimus molestias ut ex quibusdam.
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto alias incidunt blanditiis excepturi, magnam rerum nam beatae reprehenderit non doloremque nisi ipsam perspiciatis accusantium obcaecati corrupti ab nulla doloribus a.
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            2
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta, sunt. Voluptatibus quae odio reprehenderit excepturi voluptate. At vel, consequuntur eos unde recusandae autem quam voluptates, animi debitis quis placeat. Amet.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, laborum! Sunt minus error molestiae doloribus perferendis, soluta veniam dolor sequi maiores facere perspiciatis incidunt itaque assumenda accusantium ducimus, voluptas totam!
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt labore ipsam voluptatum sapiente suscipit quaerat, ab dolor dignissimos consequuntur cumque minus numquam, quas aliquam, exercitationem quis quidem est rerum libero!
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
    })
})
@endsection