<div class="card">
    <div class="card-body">
        <div class="form-section">
            <div class="fs-head"><span class="fs-head-text">Kelola Proyek {{$data['project_name']}}</span></div>
        </div>
        <div class="row section-content">
            <div class="col-4 px-2 info-box-parent">
                <a class="btn-box" href="{{route('project.edit', ['id' => $data['id']])}}" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Ubah Data Proyek","actionUrl":"{{route('project.update', ["id" => $data['id']])}}","edit":"Simpan Perubahan","lg":true,"cancel":"Batal"}'>
                    <div class="info-box">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">Ubah</h3>
                            <p class="text-secondary">Proyek</p>
                        </div>
                        <div class="info-box-icon">
                            <i class="far fa-edit"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 px-2 info-box-parent">
                <a class="btn-box" href="" target="_blank">
                    <div class="info-box">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">Lihat</h3>
                            <p class="text-secondary">Proyek</p>
                        </div>
                        <div class="info-box-icon">
                            <i class="fas fa-external-link-alt"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 px-2 info-box-parent">
                <a class="btn-box" href="" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Hapus Proyek","text":"Hapus proyek {{$data['name']}} ?", "actionUrl":"{{route('project.delete', ["id" => $data['id']])}}","delete":"Hapus Proyek", "cancel":"Batalkan","redirectAfter":"{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}","pjax-container":"#mr"}'>
                    <div class="info-box">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">Hapus</h3>
                            <p class="text-secondary">Proyek</p>
                        </div>
                        <div class="info-box-icon">
                            <i class="far fa-trash-alt"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="form-section mt-3">
            <div class="fs-head"><span class="fs-head-text">Data Historis {{$data['name']}}</span></div>
        </div>
        <div class="row section-content">
            <a href="{{route('get.modal',['parent_directory' => 'member', 'content' => 'form_tulis_update'])}}" class="btn btn-sm btn-secondary mx-3 mb-3" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Tulis Update Campaign {{$data['name']}}","actionUrl":"/tulis-update-campaign","add":"Post Update"}'><i class="fas fw fa-pencil-alt"></i> Tulis Update</a>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Judul Update</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>Terpublikasi</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary"><i class="far fw fa-edit"></i> Edit</a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="far fw fa-trash-alt"></i> Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>