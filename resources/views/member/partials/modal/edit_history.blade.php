<form method="POST">
    @method('PUT')
    @csrf
    <input type="hidden" class="form-control" id="user_id" name="data[user_id]" value="{{Auth::user()->id}}">
    <input type="hidden" class="form-control" id="project_id" name="data[project_id]" value="{{$project_id}}">
    <div class="form-group">
        <label for="title">Judul Update</label>
        <input type="text" class="form-control" id="title" placeholder="Judul update" name="data[title]" value="{{$title}}">
    </div>
    <div class="form-group">
        <label for="description">Detail Update</label>
        <textarea class="form-control the-summernote" id="body" rows="3" name="data[body]">{{$body}}</textarea>
    </div>
</form>