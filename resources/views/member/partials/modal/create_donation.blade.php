<form method="POST">
    @csrf
    <input type="hidden" class="form-control" name="data[user_id]" value="{{Auth::user()->id}}">
    <input type="hidden" class="form-control" name="data[project_id]" value="{{$project_id}}">
    <div class="form-group">
        <label for="amount">Jumlah Donasi</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Rp</div>
            </div>
            <input type="text" class="form-control" id="amount" placeholder="Jumlah donasi" name="data[amount]" onkeypress="javascript:return isNumberKey(event);">
        </div>
        <small id="amountHelpBlock" class="form-text text-muted">
            Masukkan nominal donasi minimal Rp 10.000 dengan kelipatan ribuan (contoh: 20.000, 50.000, 100.000)
        </small>
    </div>
    <div class="form-group">
        <label for="bank_id">Metode Pembayaran</label>
        <select id="bank_id" name="data[bank_id]" class="selectpicker form-control show-tick" data-actions-box="true" title="Pilih metode pembayaran" data-live-search="true">
            @foreach($banks as $key => $bank)
                <option value="{{$bank->id}}" data-tokens="{{$bank->bank_name}}">{{"Transfer Bank $bank->bank_name"}}</option>
            @endforeach
        </select>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="anonymouse" name="data[anonymouse]">
        <label class="custom-control-label" for="anonymouse">Tampilkan sebagai anonim</label>
    </div>
</form>