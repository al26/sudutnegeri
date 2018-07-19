<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('profile.edit', ['id' => Auth::user()->profile->id])}}" id="form-profile">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Data Diri</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="name">Nama Lengkap</label>
                    <input type="text" class="form-control col-12 col-md-9" id="name" name="data[name]" placeholder="Nama Lengkap Kamu" value="{{Auth::user()->profile->name}}">
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="gender">Jenis Kelamin</label>
                    <select id="gender" name="data[gender]" class="custom-select form-control col-12 col-md-9">
                        <option {{empty(Auth::user()->profile->gender) ? 'selected' : ''}}>Pilih jenis kelamin</option>
                        <option value="Laki-laki" {{Auth::user()->profile->gender == 'Laki-laki' ? 'selected' : ''}}>Laki-laki</option>
                        <option value="Perempuan" {{Auth::user()->profile->gender == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="dob">Tanggal Lahir</label>
                    <input type="date" class="form-control col-12 col-md-9" id="dob" name="data[dob]" value="{{Auth::user()->profile->dob}}">
                </div>
            </div>
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Tentang Kamu</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="biography">Biografi</label>
                    <textarea class="form-control col-12 col-md-9" id="biography" name="data[biography]" rows="5" placeholder="Deskripsikan dirimu">{{Auth::user()->profile->biography}}</textarea>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="interest">Minat</label>
                    <select id="interest" name="data[interest]" class="dsp show-tick col-12 col-md-9 px-md-0" data-live-search="true" multiple data-actions-box="true" title="Pilih Bidang">
                        <option value="2" data-tokens="Pengembangan Karakter Anak">Pengembangan Karakter Anak</option>
                        <option value="3" data-tokens="Kewirausahaan">Kewirausahaan</option>
                        <option value="4" data-tokens="Kesehatan dan Lingkungan">Kesehatan dan Lingkungan</option>
                        <option value="5" data-tokens="Keterampilan">Keterampilan</option>
                        <option value="6" data-tokens="Edukasi Science Dasar">Edukasi Science Dasar</option>
                        <option value="7" data-tokens="Pendidikan Perempuan">Pendidikan Perempuan</option>
                        <option value="8" data-tokens="Wawasan Umum">Wawasan Umum</option>
                    </select>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="skills">Keahlian</label>
                    <input type="text" class="form-control col-12 col-md-9" id="skills" name="data[skils]" placeholder="Skills atau Keahlian kamu" value="{{Auth::user()->profile->skill}}">
                    <small class="form-text text-muted offset-md-3">Pisahkan dengan tanda koma ( , )</small>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="profession">Profesi</label>
                    <input type="text" class="form-control col-12 col-md-9" id="profession" name="data[profession]" placeholder="Tuliskan Profesi kamu" value="{{Auth::user()->profile->profession}}">
                    <small class="form-text text-muted offset-md-3">contoh : Guru, karyawan, dll</small>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="institution">Institusi</label>
                    <input type="text" class="form-control col-12 col-md-9" id="institution" name="data[institution]" placeholder="Institusi kamu" value="{{Auth::user()->profile->institute}}">
                    <small class="form-text text-muted offset-md-3">Tulis nama perusahaan, sekolah, universitas, atau institusi lainnya</small>
                </div>
            </div>
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Informasi Kontak</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="phone_number">Nomor Telepon</label>
                    <input type="text" class="form-control col-12 col-md-9" id="phone_number" name="data[phone_number]" placeholder="Nomor Hp yang dapat dihubungi" value="{{Auth::user()->profile->phone_number}}">
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="address">Alamat</label>
                    <textarea id="address" class="form-control col-12 col-md-9" placeholder="Tuliskan alamat" rows="5">{{Auth::user()->profile->address}}</textarea>
                </div>
            </div>
            <button type="submit" id="profile-edit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>