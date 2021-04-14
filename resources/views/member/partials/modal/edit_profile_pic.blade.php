<form action="{{route('avatar.update', ['id' => $id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row mb-3 text-center">
        <div class="col-12">
            <img id="profile-preview-default" alt="preview" class="img-fluid img-thumbnail" src="{{secure_asset('storage/profile_pictures/no_image_placeholder.png')}}">
            <img id="profile-preview" alt="preview" class="img-fluid img-thumbnail" src="{{secure_asset('storage/profile_pictures/no_image_placeholder.png')}}" style="display:none;">
            <img id="profile-loader" src="{{secure_asset('storage/loader/spinner.gif')}}" alt="loader" class="img-fluid"  style="display:none">
            {{-- <br><label for="upload-progress" id="up-label"></label>
            <div class="progress" style="height:50px; display:none;" id="upload-progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
            </div> --}}
        </div>
    </div>
    
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="avatar" name="avatar" onchange="javascript:previewImgUpload(this, '#profile-preview-default', '#profile-loader', '#profile-preview', '#profile-label');">
        <label class="custom-file-label" for="avatar" id="profile-label">Pilih File</label>
    </div>
</form>