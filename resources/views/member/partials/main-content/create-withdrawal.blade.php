<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Cairkan Dana Proyek {{$project->project_name}}</h4>
    </div>
    <div class="card-body">
        <form action="{{route('withdrawal.store')}}" method="post" id="form-create-withdrawal">
            @csrf
            <div class="form-group row mx-0">
                <label class="fs-label col-12 col-md-3 p-0" for="account_number">Nomor Rekening</label>
                <div class="col-12 col-md-9 p-0">
                    <input type="text" class="form-control" id="account_number" name="data[account_number]" placeholder="Nomor rekening" value="{{old(data.account_number)}}" onkeypress="javascript:return isNumberKey(event);">
                    <small class="form-text text-muted">Masukkan nomor rekening pencairan dana Anda</small>
                </div>
            </div>
            <div class="form-group row mx-0">
                <label class="fs-label col-12 col-md-3 p-0" for="bank_code">Nama Bank</label>
                <div class="col-12 col-md-9 p-0">
                    <select id="bank_code" name="data[bank_code]" class="custom-select form-control">
                        <option selected disabled>-- Pilih Bank --</option>
                        @foreach ($banks as $bank)
                            <option value="{{$bank->bank_code}}">{{$bank->bank_name}}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Pilih nama bank tujuan pencairan dana</small>
                </div>
            </div>
            <div class="form-group row mx-0">
                <label class="fs-label col-12 col-md-3 p-0" for="account_name">Atas Nama</label>
                <div class="col-12 col-md-9 p-0">
                    <input type="text" class="form-control" id="account_name" name="data[account_name]" placeholder="Atas nama nomor rekening anda" value="{{old(data.account_name)}}">
                    <small class="form-text text-muted">Masukkan nama pemilik rekening</small>
                </div>
            </div>
            <div class="form-group row mx-0">
                <label class="fs-label col-12 col-md-3 p-0" for="amount">Jumlah Penarikan</label>
                <div class="input-group mb-2 col-12 col-md-9 p-0">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Rp</div>
                    </div>
                    <input type="text" class="form-control" id="amount" placeholder="Jumlah penarikan" name="data[amount]" onkeypress="javascript:return isNumberKey(event);" value="{{old('data.amount')}}">
                </div>
                <small id="amountHelpBlock" class="form-text text-muted">
                    Masukkan nominal dana yang ingin dicairkan
                </small>
            </div>
            <div class="form-group">
                <label for="project_banner">Scan/foto ktp pemilik rekening <b>(jika bukan atas nama sendiri)</b></label>
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
                <small class="form-text text-muted">Lampirkan foto/scan ktp pemilik rekening jika bukan atas nama Anda sendiri. Format .jpg, atau .png</small>
            </div>
            <button type="submit" id="create-withdrawal" class="btn btn-md btn-primary">Ajukan Penarikan Dana</button>
        </form>
    </div>
</div>