<form action="{{route('project.update-doc', ['id' => $id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="attachments">Dokumen Verifikasi</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="attachments" name="attachments[]" multiple onchange="javascript:dynamicFileList(this, 'attachments-list', 'attachment-label')" required>
            <label class="custom-file-label" for="attachments" id="attachment-label">Pilih File</label>
        </div>
        <small class="form-text text-muted">Lampirkan sebuah foto dengan format .jpg, .png, atau .svg</small>
        <ul class="dynamic-list" id="attachments-list"></ul>
    </div>
</form>