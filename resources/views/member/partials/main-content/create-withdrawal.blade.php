<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0 float-left col-11 p-0">Form Pengajuan Pencairan Dana</h4>
        <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'withdrawal'])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right col-auto"><i class="fas fa-times"></i></a>
    </div>
    @if ($projects->count() <= 0)
        <div class="card-body">
            <div class="text-center p-5 my-auto">
                <div class="my-3">
                    <i class="fas fa-money-bill-wave fa-10x"></i>
                </div>
                <span class="font-weight-bold">Tidak ada proyek yang dapat Anda cairkan !</span><br>
                <span class="">Pastikan semua pencairan telah diproses untuk setiap proyek Anda. <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'withdrawal'])}}" data-toggle="pjax" data-pjax="menu">Lihat riwayat pencairan</a></span>
            </div>
        </div>
    @else
        <div class="card-body">
            <form action="{{route('withdrawal.store')}}" method="post" id="form-create-withdrawal">
                @csrf
                <div class="alert alert-info">Mohon gunakan rekening atas nama Anda sendiri sesuai nama yang terdaftar di Sudut Negeri yaitu <b>{{ucwords(Auth::user()->profile->name)}}</b></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="bank_code">Nama Bank</label>
                    <div class="col-12 col-md-9 p-0">
                        <select id="bank_id" name="data[bank_id]" class="select2 form-control">
                            <option selected disabled>-- Pilih Bank --</option>
                            @foreach ($banks as $bank)
                                <option value="{{$bank->id}}">{{"Bank ".$bank->bank_name}}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Pilih nama bank tujuan pencairan dana</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="account_number">Nomor Rekening</label>
                    <div class="col-12 col-md-9 p-0">
                        <input type="text" class="form-control" id="account_number" name="data[account_number]" placeholder="Nomor rekening" onkeypress="javascript:return isNumberKey(event);">
                        <small class="form-text text-muted">Masukkan nomor rekening pencairan dana Anda</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="account_name">Atas Nama</label>
                    <div class="col-12 col-md-9 p-0">
                        <input type="text" class="form-control" value="{{ucwords(Auth::user()->profile->name)}}" readonly>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="project_id">Pilih Proyek</label>
                    <div class="col-12 col-md-9 p-0">
                        <select id="project_id" name="data[project_id]" class="select2 form-control" data-saldo="{{route('get.saldo')}}">
                            <option selected disabled>-- Pilih Proyek --</option>
                            @foreach ($projects as $project)
                                <option value="{{encrypt($project->id)}}">{{$project->project_name}}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Pilih proyek yang ingin dicairkan</small>
                    </div>
                </div>
                <div class="alert alert-info text-justify hidden offset-md-3" id="info-saldo"></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="amount">Jumlah Penarikan</label>
                    <div class="input-group mb-2 col-12 col-md-9 p-0">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="text" class="form-control" id="amount" placeholder="Jumlah penarikan" name="data[amount]" onkeypress="javascript:return isNumberKey(event);">
                    </div>
                    <small id="amountHelpBlock" class="form-text text-muted offset-md-3">
                        Masukkan nominal dana yang ingin dicairkan
                    </small>
                </div>
                {{-- <div class="form-group">
                    <label for="attachment">Scan/foto ktp pemilik rekening <b>(jika bukan atas nama sendiri)</b></label>
                    <div class="row mb-3 text-center">
                        <div class="col-12">
                            <img id="wd-preview-default" alt="preview" class="img-fluid img-thumbnail" src="{{asset('storage/no-image.jpg')}}">
                            <img id="wd-preview" alt="preview" class="img-fluid img-thumbnail" src="" style="display:none;">
                            <img id="wd-loader" src="{{asset('storage/loader/spinner.gif')}}" alt="loader" class="img-fluid"  style="display:none">
                        </div>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="attachment" name="data[attachment]" onchange="javascript:previewImgUpload(this, '#wd-preview-default', '#wd-loader', '#wd-preview', '#wd-label');">
                        <label class="custom-file-label" for="attachment" id="wd-label">Pilih File</label>
                    </div>
                    <small class="form-text text-muted">Lampirkan foto/scan ktp pemilik rekening jika bukan atas nama Anda sendiri. Format .jpg, atau .png</small> --}}
                </div>
                <button type="submit" id="create-withdrawal" class="btn btn-md btn-primary" data-redirectAfter="{{route('dashboard', ['menu' => 'sudut', 'section' => 'withdrawal'])}}">Ajukan Penarikan Dana</button>
                <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'withdrawal'])}}" class="btn btn-danger" data-toggle="pjax" data-pjax="main-content">Batal</a>
            </form>
        </div>
    @endif
</div>