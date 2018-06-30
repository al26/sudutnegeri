<div class="card">
    <div class="card-body">
        <div class="form-section">
            <div class="fs-head"><span class="fs-head-text">Kelola Campaign {{$data['name']}}</span></div>
        </div>
        <div class="row section-content">
            <div class="col-4 px-2 info-box-parent">
                <a class="btn-box" href="#" data-toggle="modal" data-target="#modal">
                    <div class="info-box">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">Ubah</h3>
                            <p class="text-secondary">Campaign</p>
                        </div>
                        <div class="info-box-icon">
                            <i class="far fa-edit"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary">Lihat</h3>
                        <p class="text-secondary">Campaign</p>
                    </div>
                    <div class="info-box-icon">
                        <i class="fas fa-external-link-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-4 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary">Hapus</h3>
                        <p class="text-secondary">Campaign</p>
                    </div>
                    <div class="info-box-icon">
                        <i class="far fa-trash-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>