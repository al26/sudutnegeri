<div class="card">
    <div class="card-body">
        <form>
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Data Diri</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control col-12 col-md-9" id="nama_lengkap" placeholder="Nama Lengkap Kamu" value="{{Auth::user()->profile->name}}">
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="jk">Jenis Kelamin</label>
                    <select id="jk" class="custom-select form-control col-12 col-md-9">
                        <option {{empty(Auth::user()->profile->gender) ? 'selected' : ''}}>Pilih jenis kelamin</option>
                        <option value="laki-laki" {{Auth::user()->profile->gender == 'laki-laki' ? 'selected' : ''}}>Laki-laki</option>
                        <option value="perempuan" {{Auth::user()->profile->gender == 'perempuan' ? 'selected' : ''}}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="dob">Tanggal Lahir</label>
                    <input type="date" class="form-control col-12 col-md-9" id="dob" value="{{Auth::user()->profile->dob}}">
                </div>
            </div>
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Tentang Kamu</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="bio">Bio Singkat</label>
                    <textarea class="form-control col-12 col-md-9" id="bio" rows="3" placeholder="Deskripsikan dirimu">{{Auth::user()->profile->biography}}</textarea>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="passion">Minat</label>
                    <select id="passion" class="dsp show-tick col-12 col-md-9 px-md-0" data-live-search="true" multiple data-actions-box="true" title="Pilih Bidang">
                        {{-- <option value="1">Semua Bidang</option> --}}
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
                    <label class="fs-label col-12 col-md-3" for="skill">Keahlian</label>
                    <input type="text" class="form-control col-12 col-md-9" id="skill" placeholder="Skills atau Keahlian kamu" value="{{Auth::user()->profile->skill}}">
                    <small class="form-text text-muted offset-md-3">Pisahkan dengan tanda koma ( , )</small>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="profesi">Profesi</label>
                    <input type="text" class="form-control col-12 col-md-9" id="profesi" placeholder="Tuliskan Profesi kamu" value="{{Auth::user()->profile->profession}}">
                    <small class="form-text text-muted offset-md-3">contoh : Guru</small>
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="institusi">Institusi</label>
                    <input type="text" class="form-control col-12 col-md-9" id="institusi" placeholder="Institusi kamu" value="{{Auth::user()->profile->institute}}">
                    <small class="form-text text-muted offset-md-3">Tulis nama perusahaan, sekolah, universitas, atau institusi lainnya</small>
                </div>
            </div>
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Informasi Kontak</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="hp">Nomor Telepon</label>
                    <input type="text" class="form-control col-12 col-md-9" id="hp" placeholder="Nomor Hp yang dapat dihubungi" value="{{Auth::user()->profile->phone_number}}">
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="alamat">Alamat</label>
                    <textarea id="alamat" class="form-control col-12 col-md-9" placeholder="Tuliskan alamat" rows="3">{{Auth::user()->profile->address}}</textarea>
                </div>
            </div>
        </form>
    </div>
</div>