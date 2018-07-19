<div class="card">
    <div class="card-body">
        <div class="form-section">
            <div class="fs-head">
                <span class="fs-head-text">Total Investasi</span>
            </div>
        </div>
        <div class="row section-content">
            <div class="col-12 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary">{{$total}}</h3>
                    </div>
                    <div class="info-box-icon">
                        <i class="far fa-edit"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-section mt-3">
            <div class="fs-head"><span class="fs-head-text">Investasi Saya</span></div>
        </div>
        <div class="row section-content">
            <a href="{{route('project.browse', ['category' => 'all'])}}" class="btn btn-sm btn-secondary mx-3 mb-3" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Tulis Update Proyek {{$data['name']}}","actionUrl":"{{route('history.store')}}","add":"Post Update", "lg":true, "cancel":"Batal"}'><i class="fas fw fa-pencil-alt"></i> Tambah Investasi</a>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Proyek</th>
                        <th>Jumlah Investasi</th>
                        <th>Tanggal Investasi</th>
                        <th>Status</th>
                        <th>Bukti Transfer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($investments as $i)
                        <tr>
                            <td>{{$i->project->project_name}}</td>
                            <td>{{$i->amount}}</td>
                            <td>{{$i->created_at}}</td>
                            <td>{{$i->status}}</td>
                            <td>
                                @if(empty($i->transfer_receipt))
                                    <a href="" class="btn btn-sm btn-primary"><i class="fas fa-cloud-upload-alt"></i> Upload Bukti Transfer</a>
                                @else
                                    <a href="" class="btn btn-sm btn-link"> Lihat Bukti Transfer</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>