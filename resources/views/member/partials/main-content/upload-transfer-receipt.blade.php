<div class="card">
    <div class="card-body">
        <form action="{{route('donation.savereceipt', ['id' => $donation->id])}}" method="POST" enctype="multipart/form-data" id="form-receipt">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="fs-head">
                    <span class="fs-head-text">Unggah Bukti Transfer</span>
                    <a href="" class="btn btn-sm btn-danger float-right" onclick="javascript:$(this).redireload($(this).getBackUrl()); return false;"><i class="far fa-window-close"></i> Kembali</a>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-12">
                        <img id="pp-preview-default" alt="preview" class="img-fluid img-thumbnail" src="{{asset('storage/profile_pictures/no_image_placeholder.png')}}">
                        <img id="pp-preview" alt="preview" class="img-fluid img-thumbnail" src="{{asset('storage/profile_pictures/no_image_placeholder.png')}}" style="display:none;">
                        <img id="pp-loader" src="{{asset('storage/loader/spinner.gif')}}" alt="loader" class="img-fluid"  style="display:none">
                        {{-- <br><label for="upload-progress" id="up-label"></label>
                        <div class="progress" style="height:50px; display:none;" id="upload-progress">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
                        </div> --}}
                    </div>
                </div>
                
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="receipt" name="receipt" onchange="javascript:previewImgUpload(this);">
                    <label class="custom-file-label" for="receipt">Pilih File</label>
                </div>
            </div>

            <button type="submit" id="upload-receipt" class="btn btn-primary float-right">Unggah Bukti Transfer</button>
        </form>
    </div>
</div>