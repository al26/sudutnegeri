<div class="card">
    <div class="card-header">
        <h4 class="m-0 float-left p-0 col-11">Unggah Bukti Transfer</h4>
        <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'donations'])}}" data-toggle="pjax" data-pjax="main-content" class="btn btn-sm btn-danger float-right col-auto"><i class="fas fa-times"></i></a>
    </div>
    <div class="card-body">
        <form action="{{route('donation.savereceipt', ['id' => $donation->id])}}" method="POST" enctype="multipart/form-data" id="form-receipt">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="row mb-3 text-center">
                    <div class="col-12">
                        <img id="receipt-preview-default" alt="preview" class="img-fluid img-thumbnail" src="{{asset('storage/no-image.jpg')}}">
                        <img id="receipt-preview" alt="preview" class="img-fluid img-thumbnail" src="" style="display:none;">
                        <img id="receipt-loader" src="{{asset('storage/loader/spinner.gif')}}" alt="loader" class="img-fluid"  style="display:none">
                        {{-- <br><label for="upload-progress" id="up-label"></label>
                        <div class="progress" style="height:50px; display:none;" id="upload-progress">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
                        </div> --}}
                    </div>
                </div>
                
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="receipt" name="receipt" onchange="javascript:previewImgUpload(this, '#receipt-preview-default', '#receipt-loader', '#receipt-preview', '#receipt-label');">
                    <label class="custom-file-label" for="receipt" id="receipt-label">Pilih File</label>
                </div>
            </div>

            <button type="submit" id="upload-receipt" class="btn btn-primary">Unggah Bukti Transfer</button>
        </form>
    </div>
</div>