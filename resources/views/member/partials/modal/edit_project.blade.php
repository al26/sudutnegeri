<form method="POST">
    @csrf
    <div class="form-section">
        <div class="fs-head"><span class="fs-head-text">Data Proyek</span></div>
        <input type="hidden" class="form-control" id="user_id" name="data[user_id]" value="{{$user_id}}">
        <div class="form-group">
            <label for="project_name">Judul Proyek</label>
            <input type="text" class="form-control" id="project_name" placeholder="Judul Proyek" name="data[project_name]" value="{{$project_name}}">
        </div>
        <div class="form-group">
            <label for="description">Detail Proyek</label>
            <textarea class="form-control the-summernote" id="description" rows="3" name="data[description]">{{$description}}</textarea>
        </div>
        <div class="form-group">
            <label for="location">Lokasi</label>
            <input type="text" class="form-control" id="location" placeholder="Lokasi" name="data[location]" value="{{$location}}">
        </div>
        <div class="form-group">
            <label for="deadline">Tenggat Waktu</label>
            <input type="date" class="form-control" id="deadline" placeholder="Tenggat Waktu" name="data[deadline]" value="{{$deadline}}">
        </div>
    </div>
    <div class="form-section">
        <div class="fs-head"><span class="fs-head-text">Target Proyek</span></div>
        <div class="form-group">
            <label for="funding_target">Target Dana</label>
            <input type="text" class="form-control" id="funding_target" placeholder="Target Dana" name="data[funding_target]" value="{{$funding_target}}">
        </div>
        <div class="form-group">
            <label for="volunteer_spot">Target Relawan</label>
            <input type="text" class="form-control" id="volunteer_spot" placeholder="Target Relawan" name="data[volunteer_spot]" value="{{$volunteer_spot}}">
        </div>
    </div>
</form>