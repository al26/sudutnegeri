<form method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="bank_id">Nama Bank</label>
        <select class="form-control select2" id="bank_id" name="data[bank_id]">
            @foreach ($banks as $bank)
                <option value="{{$bank->id}}" {{$bank->id === $bank_account->id ? 'selected' : ''}}>{{$bank->bank_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="account_number">Nomor Rekening</label>
        <input type="text" class="form-control" id="account_number" name="data[account_number]" placeholder="Nomor rekening bank" onkeypress="javascript:return isNumberKey(event);" value="{{$bank_account->account_number}}">
    </div>
    <div class="form-group">
        <label for="account_name">Nama Akun Bank (atas nama)</label>
        <input type="text" class="form-control" id="account_name" name="data[account_name]" placeholder="Ketik nama akun bank" value="{{$bank_account->account_name}}">
    </div>
    <div class="form-group">
        <label for="bank_address">Alamat Bank</label>
        <textarea type="text" class="form-control" id="bank_address" name="data[bank_address]">{{$bank_account->bank_address}}</textarea>
    </div>
</form>