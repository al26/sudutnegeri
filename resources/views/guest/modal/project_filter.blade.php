<form action="{{route('project.browse')}}" method="GET">
    <div class="form-group row m-0">
        {{-- <div class="col-12 p-0 d-md-flex justify-content-between"> --}}
            <div class="col-12 col-md-6 col-lg-4 p-0 px-md-1 mb-2">
                <label for="category">Kategori Proyek</label>
                <select id="category" class="select2 col-12" name="category">
                    <option selected value="all">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{$category->slug}}">{{$category->category}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6 p-0 col-lg-6 px-md-1 mb-2">
                <label for="location">Lokasi Proyek</label>
                <select id="location" class="select2 col-12" name="location">
                    <option selected value="all">Semua Lokasi</option>
                </select>
            </div>
            <div class="col-12 col-md-6 p-0 col-lg-2 px-md-1 mb-2 mb-md-0">
                <label for="sort">Urutkan</label>
                <select id="sort" class="select2 col-12" name="sort">
                    <option value="latest" selected>Publikasi Terbaru</option>
                    <option value="oldest">Publikasi Lama</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-auto p-0 px-md-1 mt-2 mt-md-0 d-flex flex-row ml-auto">
                <button class="btn btn-md btn-secondary align-self-md-center mx-1 ml-auto" type="submit"><i class="fas fa-check"></i> Terapkan</button>
                <a href="{{route('project.browse')}}" class="btn btn-md btn-danger align-self-md-center ml-1" type="reset"><i class="fas fa-undo-alt"></i> Hapus Filter</a>
            </div>
        {{-- </div> --}}
    </div>
</form>