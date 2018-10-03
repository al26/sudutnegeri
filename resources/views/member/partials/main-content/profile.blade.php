<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Edit Profil</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('profile.edit', ['id' => Auth::user()->profile->id])}}" id="form-profile">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Data Diri</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="gender">Kartu Identitas</label>
                    <div class="col-12 col-md-9 p-0">
                        <select id="identity_card" name="data[identity_card]" class="custom-select form-control">
                            <option {{empty(Auth::user()->profile->identity_card) ? 'selected' : ''}} disabled >-- Pilih kartu identitas --</option>
                            <option value="KTP" {{Auth::user()->profile->identity_card == 'KTP' ? 'selected' : ''}}>KTP</option>
                            <option value="SIM" {{Auth::user()->profile->identity_card == 'SIM' ? 'selected' : ''}}>SIM</option>
                            <option value="Paspor" {{Auth::user()->profile->identity_card == 'Paspor' ? 'selected' : ''}}>Paspor</option>
                        </select>
                        <small class="form-text text-muted">Pilih kartu identitas yang akan Anda gunakan sebagai acuan data profil</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="identity_number">Nomor Identitas</label>
                    <div class="col-12 col-md-9 p-0">
                        <input type="text" class="form-control" id="identity_number" name="data[identity_number]" placeholder="Nomor identitas" value="{{Auth::user()->profile->identity_number}}" onkeypress="javascript:return isNumberKey(event);">
                        <small class="form-text text-muted">Masukkan nomor KTP / SIM / Paspor sesuai kartu identitas yang dipilih</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="name">Nama Lengkap</label>
                    <div class="col-12 col-md-9 p-0">
                        <input type="text" class="form-control" id="name" name="data[name]" placeholder="Nama Lengkap Kamu" value="{{Auth::user()->profile->name}}">
                        <small class="form-text text-muted">Nama sesuai kartu identitas</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="gender">Jenis Kelamin</label>
                    <div class="col-12 col-md-9 p-0">
                        <select id="gender" name="data[gender]" class="custom-select form-control">
                            <option {{empty(Auth::user()->profile->gender) ? 'selected' : ''}} disabled >-- Pilih jenis kelamin --</option>
                            <option value="Laki-laki" {{Auth::user()->profile->gender == 'Laki-laki' ? 'selected' : ''}}>Laki-laki</option>
                            <option value="Perempuan" {{Auth::user()->profile->gender == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                        </select>
                        <small class="form-text text-muted">Jenis kelamin sesuai kartu identitas</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="dob">Tanggal Lahir</label>
                    <div class="col-12 col-md-9 p-0">
                        <input type="date" class="form-control" id="dob" name="data[dob]" value="{{Auth::user()->profile->dob}}">
                        <small class="form-text text-muted">Tanggal lahir sesuai kartu identitas</small>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Tentang Anda</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="biography">Biografi</label>
                    <div class="col-12 col-md-9 p-0">
                        <textarea class="form-control" id="biography" name="data[biography]" rows="5" placeholder="Deskripsikan dirimu">{{Auth::user()->profile->biography}}</textarea>
                        <small class="form-text text-muted">Tuliskan biografi singkat tentang diri Anda</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="interest">Minat</label>
                    <div class="col-12 col-md-9 p-0">
                        <select id="interest" name="data[interest][]" multiple="multiple" class="select2 col-12">
                            @php
                                $minat = explode(",",Auth::user()->profile->interest);
                            @endphp
                            @foreach($categories as $category)
                                @if(in_array($category->id, $minat))
                                    <option value="{{$category->id}}" selected="true">{{$category->category}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->category}}</option>
                                @endif
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Pilih kategori proyek yang paling Anda minati</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="skills">Keahlian</label>
                    <div class="col-12 col-md-9 p-0">
                        <input type="text" class="form-control" id="skills" name="data[skills]" placeholder="Skills atau Keahlian kamu" value="{{Auth::user()->profile->skills}}">
                        <small class="form-text text-muted">Pisahkan dengan tanda koma ( , )</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="profession">Profesi</label>
                    <div class="col-12 col-md-9 p-0">
                        <input type="text" class="form-control" id="profession" name="data[profession]" placeholder="Tuliskan Profesi kamu" value="{{Auth::user()->profile->profession}}">
                        <small class="form-text text-muted">contoh : Guru, karyawan, dll</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="institution">Institusi</label>
                    <div class="col-12 col-md-9 p-0">
                        <input type="text" class="form-control" id="institution" name="data[institution]" placeholder="Institusi kamu" value="{{Auth::user()->profile->institution}}">
                        <small class="form-text text-muted">Tulis nama perusahaan, sekolah, universitas, atau institusi lainnya</small>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Informasi Kontak</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="phone_number">Nomor Telepon</label>
                    <div class="col-12 col-md-9 p-0">
                        <input type="text" class="form-control" id="phone_number" name="data[phone_number]" placeholder="Nomor Hp yang dapat dihubungi" value="{{Auth::user()->profile->phone_number}}" onkeypress="javascript:return isNumberKey(event);">
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3 p-0" for="exact_location">Alamat</label>
                    <div class="col-12 col-md-9 p-0">
                        <textarea id="exact_location" name="data[exact_location]" class="form-control" placeholder="Tuliskan alamat" rows="3">{{Auth::user()->profile->address->exact_location}}</textarea>
                        <small class="form-text text-muted">Alamat sesuai kartu identitas</small>
                    </div>
                </div>
                <div class="form-group row mx-0">
                    <div class="col-12 col-md-9 offset-md-3 p-0 d-md-flex justify-content-between">
                        <div class="col-12 col-md-6 p-0 mb-3 m-md-0 pr-md-3 w-100">
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
                        <div class="col-12 col-md-6 p-0 w-100">
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
                        <div class="col-12 col-md-6 p-0 mb-3 m-md-0 pr-md-3 w-100">
                            <select id="district_id" name="data[district_id]" class="select2 col-12">
                                @if(!empty(Auth::user()->profile->address->district_id))
                                    <option value="{{Auth::user()->profile->address->district_id}}">{{Auth::user()->profile->address->district->name}}</option>
                                @else
                                    <option selected disabled>--Pilih Kecamatan--</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-12 col-md-6 p-0">
                            <input type="text" class="form-control" id="zip_code" name="data[zip_code]" placeholder="Kode Pos" value="{{Auth::user()->profile->address->zip_code}}" onkeypress="javascript:return isNumberKey(event);">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="profile-edit" class="offset-md-3 btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>