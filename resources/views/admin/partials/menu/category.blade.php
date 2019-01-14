@section('title', 'Kategori Proyek')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-left border-bottom bg-lighten clearfix d-flex flex-row justify-content-between align-items-center">
                <h4 class="m-0 p-0">Daftar Kategori Proyek</h4>
                <a href="{{route('category.create')}}" class="btn btn-sm btn-secondary text-white ml-auto" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Tambah Kategori Baru", "cancel":"batal", "add":"Simpan", "actionUrl":"{{route('category.store')}}","redirectAfter":"{{route('admin.dashboard', ['menu' => 'category'])}}","pjax-reload":["#ac"]}'><i class="fas fa-plus-square"></i> Tambah Kategori</a>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->category}}</td>
                                <td>
                                    <a href="{{route('category.edit', ['id' => encrypt($category->id)])}}" class="btn btn-sm btn-primary text-white my-1" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Ubah Kategori", "cancel":"batal", "edit":"Simpan", "actionUrl":"{{route('category.update', ['id' => encrypt($category->id)])}}","redirectAfter":"{{route('admin.dashboard', ['menu' => 'category'])}}","pjax-reload":["#ac"]}'><i class="fas fa-edit"></i> Ubah</a>
                                    <a href="" class="btn btn-sm btn-danger text-white my-1" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Hapus Kategori","text":"Kategori {{$category->category}} akan dihapus. Semua proyek dengan kategori tersebut akan menjadi tanpa kategori. Lanjutkan hapus ?", "actionUrl":"{{route('category.destroy', ['id' => encrypt($category->id)])}}","delete":"Hapus", "cancel":"Batalkan","redirectAfter":"{{route('admin.dashboard', ['menu' => 'category'])}}","pjax-container":"#ac"}'><i class="far fa-trash-alt"></i> Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>