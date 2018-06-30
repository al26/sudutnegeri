<div class="card">
    <div class="card-body">
        <div class="row section-content card-deck">
            <div class="d-campaigns col-12 col-sm-6 col-lg-4">
                <div class="card m-0 mb-3">
                    <a class="cal" data-toggle="pjax" data-pjax="main-content" href="">
                        <span>
                            <i class="fas fa-plus fa-2x"></i><br>
                            Campaign <br>Baru
                        </span>
                    </a>        
                </div>
            </div>
            @for ($i = 0; $i < 10; $i++)    
                <div class="d-campaigns col-12 col-sm-6 col-lg-4">
                    <div class="card m-0 mb-3 border">
                        <img class="card-img-top rounded-0" src="http://via.placeholder.com/600x400" alt="Card image cap">
                        <div class="card-body py-0 px-3 pt-3" style="top:0">
                            <h5 class="card-title text-danger">Judul Project</h5>
                            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="project-needs">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Dana
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        <small class="progress-capt">25%</small>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Relawan
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        <small class="progress-capt">50%</small>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer px-3">
                            <div class="row">
                                <div class="col-6 text-left">
                                    <p class="mb-0"><small>Lokasi</small></p>
                                    <p class="mb-0">DKI Jakarta</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p class="mb-0"><small>Sisa Hari</small></p>
                                    <p class="mb-0">20</p>
                                </div>
                            </div>				      	
                        </div>
                        <a class="cml text-white" data-toggle="pjax" data-pjax="main-content" href="{{route('manage.campaign', ['id' => $i])}}">
                            <span>
                                <i class="fas fa-cogs fa-2x"></i><br>
                                Kelola <br>Campaign
                            </span>
                        </a>        
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>