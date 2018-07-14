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