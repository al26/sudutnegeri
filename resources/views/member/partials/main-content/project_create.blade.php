<div class="card">
    <div class="card-body">
        <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data" id="form-create-project">
            @csrf
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Data Proyek</span></div>
                <input type="hidden" class="form-control" id="user_id" name="data[user_id]" value="{{Auth::user()->id}}">
                <div class="form-group">
                    <label for="project_name">Judul Proyek</label>
                    <input type="text" class="form-control" id="project_name" placeholder="Judul Proyek" name="data[project_name]">
                </div>
                <div class="form-group row mx-0">
                    <div class="col-12 p-0 d-md-flex justify-content-between">
                        <div class="col-12 col-md-6 p-0 pr-md-3">
                            <label for="category_id">Kategori Proyek</label>
                            <select id="category_id" name="data[category_id]" class="select2 col-12">
                                <option selected disabled>--Pilih Kategori--</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pilih kategori yang paling sesuai</small>
                        </div>
                        <div class="col-12 col-md-6 p-0">
                            <label for="project_location">Lokasi Pelaksanaan Proyek</label>
                            <select id="project_location" name="data[project_location]" class="select2 col-12">
                                <option selected disabled>--Pilih Lokasi--</option>
                                {{-- @foreach($regencies as $regency)
                                    <option value="{{$regency->name}}">{{$regency->name}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_description">Detail Proyek</label>
                    <textarea class="form-control the-summernote" id="project_description" rows="3" name="data[project_description]"></textarea>
                    <small class="form-text text-muted">Jelaskan proyek Anda secara lengkap. Jabarkan pula detil pelaksanaan proyek seperti jam pelaksanaan, jam kerja bagi relawan, dll. Foto/video pendukung dapat ditambahkan jika diperlukan</small>
                </div>
                <div class="form-group">
                    <label for="project_banner">Baner Proyek</label>
                    <div class="row mb-3 text-center">
                        <div class="col-12">
                            <img id="pb-preview-default" alt="preview" class="img-fluid img-thumbnail" src="{{asset('storage/no-image.jpg')}}">
                            <img id="pb-preview" alt="preview" class="img-fluid img-thumbnail" src="" style="display:none;">
                            <img id="pb-loader" src="{{asset('storage/loader/spinner.gif')}}" alt="loader" class="img-fluid"  style="display:none">
                        </div>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="project_banner" name="data[project_banner]" onchange="javascript:previewImgUpload(this, '#pb-preview-default', '#pb-loader', '#pb-preview', '#pb-label');">
                        <label class="custom-file-label" for="project_banner" id="pb-label">Pilih File</label>
                    </div>
                    <small class="form-text text-muted">Lampirkan sebuah foto dengan format .jpg, .png, atau .svg</small>
                </div>
                {{-- <div class="form-group">
                    <label for="project_location">Lokasi</label>
                    <select id="project_location" name="data[project_location]" class="select2 col-12">
                        <option selected disabled>--Pilih Lokasi--</option>
                        @foreach($regencies as $regency)
                            <option value="{{$regency->name}}">{{$regency->name}}</option>
                        @endforeach
                    </select>
                </div> --}}
                {{-- <div class="form-group">
                    <label for="project_deadline">Tenggat Waktu</label>
                    <input type="date" class="form-control" id="project_deadline" placeholder="Tenggat Waktu" name="data[project_deadline]">
                </div>
                <div class="form-group">
                    <label for="project_deadline">Tenggat Waktu</label>
                    <input type="text" class="form-control" id="project_deadline" placeholder="Tenggat Waktu" name="data[project_deadline]">
                    <br>
                    <ul class="list-group">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div> --}}
            </div>
            <div class="form-group row mx-0">
                <div class="col-12 p-0 d-md-flex justify-content-between">
                    <div class="col-12 col-md-6 px-0 pr-md-3">
                        <div class="form-section">
                            <div class="fs-head"><span class="fs-head-text">Target Proyek</span></div>
                            <div class="form-group">
                                <label for="funding_target">Target Dana</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control" id="funding_target" placeholder="Target Dana" name="data[funding_target]" onkeypress="javascript:return isNumberKey(event);">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="volunteer_quota">Kuota Relawan</label>
                                <input type="text" class="form-control" id="volunteer_quota" placeholder="Kuota Relawan" name="data[volunteer_quota]" onkeypress="javascript:return isNumberKey(event);">
                            </div>          
                        </div>
                    </div>
                    <div class="col-12 col-md-6 px-0">
                        <div class="form-section">
                            <div class="fs-head"><span class="fs-head-text">Tenggat Waktu</span></div>
                            <div class="form-group">
                                <label for="close_donation">Batas Waktu Donasi</label>
                                <input type="date" class="form-control" id="close_donation" placeholder="batas waktu donasi" name="data[close_donation]">
                            </div>
                            <div class="form-group">
                                <label for="close_reg">Batas Pendaftaran Relawan</label>
                                <input type="date" class="form-control" id="close_reg" placeholder="batas waktu pendaftaran relawan" name="data[close_reg]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Penerimaan Relawan</span></div>
                <div class="form-group">
                    <div class="alert alert-info text-justify"><small>Beberapa pertanyaan akan diajukan kepada calon relawan. Pertanyaan mengenai motivasi pendaftar dan mengapa pendaftar layak untuk diterima sebagai relawan akan diajukan sebagai pertanyaan bawaan (default). Anda dapat mengajukan pertanyaan tambahan untuk proyek yang Anda buat. <br>
                    Masukkan pertanyaan yang ingin anda ajukan pada kolom yang disediakan kemudian tekan tombol <b>Tambahkan</b>. Daftar pertanyaan yang Anda ajukan akan tampil di bawah kolom tersebut. Tekan pada simbol <b>x</b> untuk menghapus pertanyaan.
                    </small> </div>
                    <label for="question">Ajukan Pertanyaan Tambahan untuk Calon Relawan (opsional)</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="question" placeholder="Pertanyaan yang ingin diajukan">
                        <input type="hidden" name="questions" id="question-val">
                        <div class="input-group-append">
                            <span class="btn btn-light" onclick="javascript:dynamicList('question', 'question-list', 'question-val');">Tambahkan</span>
                        </div>
                    </div>
                    <ul class="dynamic-list" id="question-list"></ul>
                </div>
            </div>
            <div class="form-group">
                <label for="attachments">Dokumen Verifikasi</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="attachments" name="data[attachments][]" multiple onchange="javascript:dynamicFileList(this, 'attachments-list', 'attachment-label', 'hidden-attachments')">
                    <input type="hidden" id="hidden-attachments" name="data[han]">
                    <label class="custom-file-label" for="attachments" id="attachment-label">Pilih File</label>
                </div>
                <small class="form-text text-muted">Lampirkan sebuah foto dengan format .jpg, .png, atau .svg</small>
                <ul class="dynamic-list" id="attachments-list"></ul>
            </div>
            <button type="submit" id="create-project" class="btn btn-md btn-primary">Buat Proyek</button>
            <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-md btn-danger" onclick="javascript:$(this).redireload($(this).getBackUrl()); return false;"> Batalkan</a>
        </form>
    </div>
</div>