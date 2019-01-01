@php
    $education = explode(",",Auth::user()->profile->cv->education);
@endphp
<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        @php
            $cv = Auth::user()->profile->cv->toArray();
        @endphp
        <h4 class="m-0 float-left">{{in_array(null, $cv) ? 'Buat' : 'Perbarui'}} CV Saya</h4>
        @if (!in_array(null, $cv))
            <a class="btn btn-sm btn-secondary float-right" href="{{route('view.cv', ['id' => encrypt(Auth::user()->id)])}}" data-toggle="modal" data-target="#modal" data-modal='{"title":"CV Relawan", "cancel":"Tutup", "lg":true}' data-backdrop="static" data-keyboard="false">Lihat CV Saya</a>
        @endif
    </div>
    @if (in_array(null, Auth::user()->profile->toArray()))
        <div class="card-body">
            <div class="text-center">
                <div class="my-3">
                    <i class="fas fa-tasks fa-10x"></i>
                </div>
                <span class="font-weight-bold">Anda belum melengkapi data profil !</span><br>
                <span class="">Mohon <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" data-toggle="pjax" data-pjax="menu">lengkapi profil</a> Anda untuk dapat melanjutkan pembuatan CV.</span>
            </div>
        </div>
    @else
        <div class="card-body">
            <form method="POST" action="{{route('update.cv', ['profile' => encrypt(Auth::user()->profile->id)])}}" id="form-cv">
                @csrf
                @method('PUT')
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="education">Pendidikan Terakhir</label>
                    <div class="col-12 col-md-9 p-0">
                        <div class="major">
                            <input type="text" class="form-control" name="data[major]" id="major" placeholder="Jurusan" value="{{!empty($education) && count($education) > 1 ? $education[0] : ''}}">
                            <small class="help-block text-muted">Isi dengan simbol <b>"-"</b> jika kosong</small>
                        </div>
                        <div class="institute">
                            <input type="text" class="form-control mt-3" name="data[institution]" id="institution" placeholder="Institusi / Universitas" value="{{!empty($education) && count($education) > 1 ? $education[1] : ''}}">
                            <small class="help-block text-muted">Isi dengan simbol <b>"-"</b> jika kosong</small>
                        </div>
                        <div class="year">
                            <input type="text" class="form-control mt-3" name="data[year]" id="year" placeholder="Tahun kelulusan" onkeypress="javascript:return isNumberKey(event);" pattern="[0-9]{4}" value="{{!empty($education) && count($education) > 1 ? $education[2] : ''}}">
                            <small class="help-block text-muted">Isi dengan simbol <b>"0000"</b> jika kosong</small>
                        </div>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="foreign_lang">Bahasa Asing</label>
                    <div class="col-12 col-md-9 p-0">
                        <input type="text" class="form-control" name="data[foreign_lang]" id="foreign_lang" placeholder="Bahasa asing yang dikuasai" value="{{Auth::user()->profile->cv->foreign_lang}}">
                        <small class="help-block text-muted">Pisahkan dengan tanda koma ( , ) jika lebih dari 1 bahasa asing dikuasai. Isi dengan simbol <b>"-"</b> jika kosong</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="org_exp">Pengalaman Organisasi</label>
                    <div class="col-12 col-md-9 p-0">
                        <textarea type="text" class="form-control the-summernote-text" name="data[org_exp]" id="org_exp">{{Auth::user()->profile->cv->org_exp}}</textarea>
                        <small class="help-block text-muted">Tuliskan pengalaman organisasi Anda dalam 3 tahun terakhir. Isi dengan simbol <b>"-"</b> jika kosong</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="pro_exp">Pengalaman Profesional</label>
                    <div class="col-12 col-md-9 p-0">
                        <textarea type="text" class="form-control the-summernote-text" name="data[pro_exp]" id="pro_exp">{{Auth::user()->profile->cv->pro_exp}}</textarea>
                        <small class="help-block text-muted">Tuliskan pengalaman profesional Anda dalam 3 tahun terakhir. Isi dengan simbol <b>"-"</b> jika kosong</small>
                    </div>
                </div>
                
                <button type="submit" id="cv-edit" class="offset-md-3 btn btn-primary" data-redirectAfter="{{route('dashboard', ['menu' => 'negeri', 'section' => 'cv'])}}">{{!in_array(null, $cv) ? "Perbarui" : "Buat" }} CV</button>
            </form>
        </div>
    @endif
</div>