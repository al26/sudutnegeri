@php
    $prop = Auth::user()->profile->toArray();
    $check = in_array(null, $prop);
@endphp
<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Verifikasi Akun</h4>
    </div>
    @if ($check)
        <div class="card-body">
            <div class="text-center">
                <div class="my-3">
                    <i class="fas fa-tasks fa-10x"></i>
                </div>
                <span class="font-weight-bold">Anda belum melengkapi data profil !</span><br>
                <span class="">Mohon <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" data-toggle="pjax" data-pjax="menu">lengkapi profil</a> Anda untuk dapat melanjutkan verifikasi.</span>
            </div>
        </div>
    @else
        <div class="card-body">
            <form action="{{route('account.verify')}}" method="POST" enctype="multipart/form-data" id="form-verification">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="receipt">Unggah foto/scan {{Auth::user()->profile->identity_card}} Anda</label>
                    <div class="row mb-3 text-center">
                        <div class="col-12">
                            <img id="sic-preview-default" alt="preview" class="img-fluid img-thumbnail" src="{{asset('storage/no-image.jpg')}}">
                            <img id="sic-preview" alt="preview" class="img-fluid img-thumbnail" src="" style="display:none;">
                            <img id="sic-loader" src="{{asset('storage/loader/spinner.gif')}}" alt="loader" class="img-fluid"  style="display:none">
                        </div>
                    </div>
                    
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="sic" name="sic" onchange="javascript:previewImgUpload(this, '#sic-preview-default','#sic-loader','#sic-preview', '#sic-label');">
                        <label class="custom-file-label" id="sic-label" for="sic">Pilih foto atau scan {{Auth::user()->profile->identity_card}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="receipt">Unggah foto selfi dengan {{Auth::user()->profile->identity_card}} Anda</label>
                    <div class="row mb-3 text-center">
                        <div class="col-12">
                            <img id="vp-preview-default" alt="preview" class="img-fluid img-thumbnail" src="{{asset('storage/no-image.jpg')}}">
                            <img id="vp-preview" alt="preview" class="img-fluid img-thumbnail" src="" style="display:none;">
                            <img id="vp-loader" src="{{asset('storage/loader/spinner.gif')}}" alt="loader" class="img-fluid"  style="display:none">
                        </div>
                    </div>
                    
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="vp" name="vp" onchange="javascript:previewImgUpload(this, '#vp-preview-default','#vp-loader','#vp-preview', '#vp-label');">
                        <label class="custom-file-label" id="vp-label" for="vp">Pilih foto verifikasi</label>
                    </div>
                </div>
    
            <button type="submit" id="upload-verification" class="btn btn-primary float-right" data-redirectAfter="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" data-referrer="javascript:$(this).getBackUrl();">Verifikasi</button>
            </form>
        </div>
    @endif
</div>