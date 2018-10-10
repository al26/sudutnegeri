<form method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="bank_code">Kode Bank</label>
        <input type="text" class="form-control" id="bank_code" name="data[bank_code]" placeholder="Kode bank" onkeypress="javascript:return isNumberKey(event);" value="{{$bank->bank_code}}">
    </div>
    <div class="form-group">
        <label for="bank_name">Nama Bank</label>
        <input type="text" class="form-control" id="bank_name" name="data[bank_name]" placeholder="Nama bank" value="{{$bank->bank_name}}">
    </div>
    <div class="row mb-3 text-center">
        <div class="col-12">
            <img id="bank-preview-default" alt="preview" class="img-fluid img-thumbnail" src="{{asset($bank->logo)}}">
            <img id="bank-preview" alt="preview" class="img-fluid img-thumbnail" src="" style="display:none;">
            <img id="bank-loader" src="{{asset('storage/loader/spinner.gif')}}" alt="loader" class="img-fluid"  style="display:none">
        </div>
    </div>
    
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="logo" name="data[logo]" onchange="javascript:previewImgUpload(this, '#bank-preview-default', '#bank-loader', '#bank-preview', '#bank-label');">
        <label class="custom-file-label" for="logo" id="bank-label">Pilih File</label>
    </div>
</form>