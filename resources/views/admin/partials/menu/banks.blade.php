<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-left border-bottom bg-lighten clearfix d-flex flex-row justify-content-between align-items-center">
                <h4 class="m-0 p-0">Daftar Bank</h4>
                <a href="{{route('banks.create')}}" class="btn btn-sm btn-secondary text-white ml-auto" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Tambah Daftar Bank", "cancel":"batal", "add":"Simpan", "actionUrl":"{{route('banks.store')}}","redirectAfter":"{{route('admin.dashboard', ['menu' => 'banks'])}}","pjax-reload":["#ac"]}'><i class="fas fa-plus-square"></i> Tambah Kategori</a>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Kode Bank</th>
                            <th>Nama Bank</th>
                            <th>Logo Bank</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banks as $bank)
                            <tr>
                                <td>{{$bank->bank_code}}</td>
                                <td>{{$bank->bank_name}}</td>
                                <td><img src="{{asset($bank->logo)}}" alt="Logo Bank" class="img-fluid" width="100"></td>
                                <td>
                                    {{-- <a href="{{route('bank.edit', ['id' => encrypt($bank->id)])}}" class="btn btn-sm btn-primary text-white my-1" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Ubah Kategori", "cancel":"batal", "edit":"Simpan", "actionUrl":"{{route('bank.update', ['id' => encrypt($bank->id)])}}","redirectAfter":"{{route('admin.dashboard', ['menu' => 'bank'])}}","pjax-reload":["#ac"]}'><i class="fas fa-edit"></i> Ubah</a> --}}
                                    <a href="" class="btn btn-sm btn-danger text-white my-1" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Hapus Bank","text":"Bank {{$bank->bank_name}} akan dihapus dari daftar bank. Lanjutkan hapus ?", "actionUrl":"{{route('banks.destroy', ['id' => encrypt($bank->id)])}}","delete":"Hapus", "cancel":"Batalkan","redirectAfter":"{{route('admin.dashboard', ['menu' => 'banks'])}}","pjax-container":"#ac"}'><i class="far fa-trash-alt"></i> Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>