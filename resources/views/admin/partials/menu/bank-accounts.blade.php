<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-left border-bottom bg-lighten clearfix d-flex flex-row justify-content-between align-items-center">
                <h4 class="m-0 p-0">Daftar Akun Bank</h4>
                <a href="{{route('ba.create')}}" class="btn btn-sm btn-secondary text-white ml-auto" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Tambah Daftar Bank", "cancel":"batal", "add":"Simpan", "actionUrl":"{{route('ba.store')}}","redirectAfter":"{{route('admin.dashboard', ['menu' => 'bank-accounts'])}}","pjax-reload":["#ac"]}'><i class="fas fa-plus-square"></i> Tambah Akun Bank</a>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Bank</th>
                            <th>Atas Nama</th>
                            <th>Nomor Rekening</th>
                            <th>Alamat Bank</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bank_accounts as $account)
                            <tr>
                                <td>{{$account->bank->bank_name}}</td>
                                <td>{{$account->account_name}}</td>
                                <td>{{$account->account_number}}</td>
                                <td>{{$account->bank_address}}</td>
                                <td>
                                    <a href="{{route('ba.edit', ['id' => encrypt($account->id)])}}" class="btn btn-sm btn-primary text-white my-1" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Ubah Akun Bank", "cancel":"batal", "edit":"Simpan", "actionUrl":"{{route('ba.update', ['id' => encrypt($account->id)])}}","redirectAfter":"{{route('admin.dashboard', ['menu' => 'bank-accounts'])}}","pjax-reload":["#ac"]}'><i class="fas fa-edit"></i> Ubah</a>
                                    <a href="" class="btn btn-sm btn-danger text-white my-1" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Hapus Akun Bank","text":"Akun bank {{$account->bank->bank_name}} atas nama {{$account->account_name}} akan dihapus dari daftar akun bank. Lanjutkan hapus ?", "actionUrl":"{{route('ba.destroy', ['id' => encrypt($account->id)])}}","delete":"Hapus", "cancel":"Batalkan","redirectAfter":"{{route('admin.dashboard', ['menu' => 'bank-accounts'])}}","pjax-container":"#ac"}'><i class="far fa-trash-alt"></i> Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>