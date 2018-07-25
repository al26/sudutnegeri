<form method="POST">
    @csrf
    <div class="form-section">
        <div class="fs-head"><span class="fs-head-text">Data Proyek</span></div>
        <input type="hidden" class="form-control" id="user_id" name="data[user_id]" value="{{Auth::user()->id}}">
        <div class="form-group">
            <label for="project_name">Judul Proyek</label>
            <input type="text" class="form-control" id="project_name" placeholder="Judul Proyek" name="data[project_name]">
        </div>
        <div class="form-group">
            <label for="project_description">Detail Proyek</label>
            <textarea class="form-control the-summernote" id="project_description" rows="3" name="data[project_description]"></textarea>
        </div>
        <div class="form-group">
            <label for="project_location">Lokasi</label>
            <select id="project_location" name="data[project_location]" class="select2 col-12">
                <option selected disabled>--Pilih Lokasi--</option>
                {{-- @foreach($regencies as $regency)
                    <option value="{{$regency->name}}">{{$regency->name}}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="form-group">
            <label for="project_deadline">Tenggat Waktu</label>
            <input type="date" class="form-control" id="project_deadline" placeholder="Tenggat Waktu" name="data[project_deadline]">
        </div>
    </div>
    <div class="form-section">
        <div class="fs-head"><span class="fs-head-text">Target Proyek</span></div>
        <div class="form-group">
            <label for="funding_target">Target Dana</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="text" class="form-control" id="funding_target" placeholder="Target Dana" name="data[funding_target]" onkeypress="javascript:return isNumberKey(event);">
            </div>
        </div>
        <div class="form-group">
            <label for="volunteer_quota">Target Relawan</label>
            <input type="text" class="form-control" id="volunteer_quota" placeholder="Target Relawan" name="data[volunteer_quota]" onkeypress="javascript:return isNumberKey(event);">
        </div>
    </div>
</form>