<div class="card">
    <div class="card-header">
        <h4 class="m-0 card-title float-left p-0 col-11">Ubah Proyek {{$project->project_name}}</h4>
        <a href="{{url('/dashboard/sudut/projects/manage/'.$project->project_slug)}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right col-auto"><i class="fas fa-times"></i></a>
    </div>
    <div class="card-body">
        <form action="{{route('project.update', ['id' => encrypt($project->id)])}}" method="POST" enctype="multipart/form-data" id="form-edit-project">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Data Proyek</span></div>
                <input type="hidden" class="form-control" id="user_id" name="data[user_id]" value="{{Auth::user()->id}}">
                <div class="form-group">
                    <label for="project_name">Judul Proyek</label>
                    <input type="text" class="form-control" id="project_name" placeholder="Judul Proyek" name="data[project_name]" value="{{$project->project_name}}">
                </div>
                <div class="form-group row mx-0">
                    <div class="col-12 p-0 d-md-flex justify-content-between">
                        <div class="col-12 col-md-6 p-0 pr-md-3">
                            <label for="category_id">Kategori Proyek</label>
                            <select id="category_id" name="data[category_id]" class="select2 col-12">
                                @if (!empty($project->category_id))
                                    <option selected value="{{$project->category_id}}">{{$project->category->category}}</option>
                                    @foreach($categories->where('id', '!=', $project->category_id) as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach    
                                @else
                                    <option selected disabled>--Pilih Kategori--</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="form-text text-muted">Pilih kategori yang paling sesuai</small>
                        </div>
                        <div class="col-12 col-md-6 p-0">
                            <label for="regency_id">Lokasi Pelaksanaan Proyek</label>
                            <select id="regency_id" name="data[regency_id]" class="select2 col-12">
                                @if (!empty($project->location->id))
                                    <option selected value="{{$project->location->id}}">{{$project->location->name}}</option>    
                                @else
                                    <option selected disabled>--Pilih Lokasi--</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_description">Detail Proyek</label>
                    <textarea class="form-control the-summernote" id="project_description" rows="3" name="data[project_description]">{{$project->project_description}}</textarea>
                    <small class="form-text text-muted">Jelaskan proyek Anda secara lengkap. Jabarkan pula detil pelaksanaan proyek seperti jam pelaksanaan, jam kerja bagi relawan, dll. Foto/video pendukung dapat ditambahkan jika diperlukan</small>
                </div>
                <div class="form-group">
                    <label for="project_banner">Baner Proyek</label>
                    <div class="row mb-3 text-center">
                        <div class="col-12">
                            <img id="pb-preview-default" alt="preview" class="img-fluid img-thumbnail" src="{{!empty($project->project_banner) ?secure_asset($project->project_banner) : secure_asset('storage/no-image.jpg')}}">
                            <img id="pb-preview" alt="preview" class="img-fluid img-thumbnail" src="" style="display:none;">
                            <img id="pb-loader" src="{{secure_asset('storage/loader/spinner.gif')}}" alt="loader" class="img-fluid"  style="display:none">
                        </div>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="project_banner" name="data[project_banner]" onchange="javascript:previewImgUpload(this, '#pb-preview-default', '#pb-loader', '#pb-preview', '#pb-label');">
                        <label class="custom-file-label" for="project_banner" id="pb-label">Pilih File</label>
                    </div>
                    <small class="form-text text-muted">Lampirkan sebuah foto dengan format .jpg, .png, atau .svg</small>
                </div>
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
                                    <input type="text" class="form-control" id="funding_target" placeholder="Target Dana" name="data[funding_target]" onkeypress="javascript:return isNumberKey(event);" value="{{$project->funding_target}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="volunteer_quota">Kuota Relawan</label>
                                <input type="text" class="form-control" id="volunteer_quota" placeholder="Kuota Relawan" name="data[volunteer_quota]" onkeypress="javascript:return isNumberKey(event);" value="{{$project->volunteer_quota}}">
                            </div>          
                        </div>
                    </div>
                    <div class="col-12 col-md-6 px-0">
                        <div class="form-section">
                            <div class="fs-head"><span class="fs-head-text">Tenggat Waktu</span></div>
                            <div class="form-group">
                                @php
                                    $close_donation = new DateTime($project->close_donation);
                                @endphp
                                <label for="close_donation">Batas Waktu Donasi</label>
                                <input type="date" class="form-control" id="close_donation" placeholder="batas waktu donasi" name="data[close_donation]" value="{{$close_donation->format('Y-m-d')}}">
                            </div>
                            <div class="form-group">
                                @php
                                    $close_reg = new DateTime($project->close_reg);
                                @endphp
                                <label for="close_reg">Batas Pendaftaran Relawan</label>
                                <input type="date" class="form-control" id="close_reg" placeholder="batas waktu pendaftaran relawan" name="data[close_reg]" value="{{$close_reg->format('Y-m-d')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="form-section">
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
            </div> --}}
            {{-- <div class="form-group">
                <label for="attachments">Dokumen Verifikasi</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="attachments" name="data[attachments][]" multiple onchange="javascript:dynamicFileList(this, 'attachments-list', 'attachment-label')">
                    <label class="custom-file-label" for="attachments" id="attachment-label">Pilih File</label>
                </div>
                <small class="form-text text-muted">Lampirkan sebuah foto dengan format .jpg, .png, atau .svg</small>
                <ul class="dynamic-list" id="attachments-list"></ul>
            </div> --}}
            <button type="submit" id="edit-project" class="btn btn-md btn-primary">Ubah Proyek</button>
            <a href="{{url('/dashboard/sudut/projects/manage/'.$project->project_slug)}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-md btn-danger"> Batalkan</a>
        </form>
    </div>
</div>