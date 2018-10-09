<form method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="category">Nama Kategori</label>
        <input type="text" class="form-control" id="category" name="category" placeholder="Ketik nama kategori" value="{{$name}}">
    </div>
</form>