<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('profile.edit', ['id' => Auth::user()->profile->id])}}" id="form-profile">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Data Diri</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="name">Nama Lengkap</label>
                    <div class="col-12 col-md-9">
                        <input type="text" class="form-control" id="name" name="data[name]" placeholder="Nama Lengkap Kamu" value="{{Auth::user()->profile->name}}">
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="gender">Jenis Kelamin</label>
                    <div class="col-12 col-md-9">
                        <select id="gender" name="data[gender]" class="custom-select form-control">
                            <option {{empty(Auth::user()->profile->gender) ? 'selected' : ''}} disabled >-- Pilih jenis kelamin --</option>
                            <option value="Laki-laki" {{Auth::user()->profile->gender == 'Laki-laki' ? 'selected' : ''}}>Laki-laki</option>
                            <option value="Perempuan" {{Auth::user()->profile->gender == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="dob">Tanggal Lahir</label>
                    <div class="col-12 col-md-9">
                        <input type="date" class="form-control" id="dob" name="data[dob]" value="{{Auth::user()->profile->dob}}">
                    </div>
                </div>
            </div>
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Tentang Kamu</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="biography">Biografi</label>
                    <div class="col-12 col-md-9">
                        <textarea class="form-control" id="biography" name="data[biography]" rows="5" placeholder="Deskripsikan dirimu">{{Auth::user()->profile->biography}}</textarea>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="interest">Minat</label>
                    <div class="col-12 col-md-9">
                        <select id="interest" name="data[interest][]" multiple="multiple" class="select2 col-12">
                            @foreach($sectors as $sector)
                                <option value="{{$sector->id}}">{{$sector->sector}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="skills">Keahlian</label>
                    <div class="col-12 col-md-9">
                        <input type="text" class="form-control" id="skills" name="data[skills]" placeholder="Skills atau Keahlian kamu" value="{{Auth::user()->profile->skills}}">
                        <small class="form-text text-muted">Pisahkan dengan tanda koma ( , )</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="profession">Profesi</label>
                    <div class="col-12 col-md-9">
                        <input type="text" class="form-control" id="profession" name="data[profession]" placeholder="Tuliskan Profesi kamu" value="{{Auth::user()->profile->profession}}">
                        <small class="form-text text-muted">contoh : Guru, karyawan, dll</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="institution">Institusi</label>
                    <div class="col-12 col-md-9">
                        <input type="text" class="form-control" id="institution" name="data[institution]" placeholder="Institusi kamu" value="{{Auth::user()->profile->institution}}">
                        <small class="form-text text-muted">Tulis nama perusahaan, sekolah, universitas, atau institusi lainnya</small>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Informasi Kontak</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="phone_number">Nomor Telepon</label>
                    <div class="col-12 col-md-9">
                        <input type="text" class="form-control" id="phone_number" name="data[phone_number]" placeholder="Nomor Hp yang dapat dihubungi" value="{{Auth::user()->profile->phone_number}}" onkeypress="javascript:return isNumberKey(event);">
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="exact_location">Alamat</label>
                    <div class="col-12 col-md-9">
                        <textarea id="exact_location" name="data[exact_location]" class="form-control" placeholder="Tuliskan alamat" rows="3">{{Auth::user()->profile->address->exact_location}}</textarea>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <div class="col-12 col-md-9 offset-md-3 p-0 d-md-flex justify-content-between">
                        <div class="col-12 col-md-6">
                            <select id="province_id" name="data[province_id]" class="select2 col-12">
                                @if(!empty(Auth::user()->profile->address->province_id))
                                    <option value="{{Auth::user()->profile->address->province_id}}">{{Auth::user()->profile->address->province->name}}</option>
                                @else
                                    <option selected disabled>--Pilih Propinsi--</option>
                                @endif
                                @foreach($provinces as $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <select id="regency_id" name="data[regency_id]" class="select2 col-12">
                                @if(!empty(Auth::user()->profile->address->regency_id))
                                    <option value="{{Auth::user()->profile->address->regency_id}}">{{Auth::user()->profile->address->regency->name}}</option>
                                @else
                                    <option selected disabled>--Pilih Kabupaten/Kota--</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <div class="col-12 col-md-9 offset-md-3 p-0 d-md-flex justify-content-between">
                        <div class="col-12 col-md-6">
                            <select id="district_id" name="data[district_id]" class="select2 col-12">
                                @if(!empty(Auth::user()->profile->address->district_id))
                                    <option value="{{Auth::user()->profile->address->district_id}}">{{Auth::user()->profile->address->district->name}}</option>
                                @else
                                    <option selected disabled>--Pilih Kecamatan--</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" id="zip_code" name="data[zip_code]" placeholder="Kode Pos" value="{{Auth::user()->profile->address->zip_code}}" onkeypress="javascript:return isNumberKey(event);">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="profile-edit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>