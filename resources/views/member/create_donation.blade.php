@extends('layouts.app')

@section('content')
<div class="container my-md-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 p-0 px-md-3">
            <div class="card border-0 vh-100">
                <div class="card-body">
                    <div class="text-center pb-3">
                        <h4 class="m-0">Hai, {{ucwords(Auth::user()->profile->name)}}</h4>
                        <p class="m-0">Anda akan berinvestasi untuk proyek</p>
                        <h5 class="m-0">{{$project->project_name}}</h5>
                    </div>
                    <form method="POST" action="{{route('donation.store')}}">
                        @csrf
                        <input type="hidden" class="form-control" name="data[user_id]" value="{{urlencode(base64_encode(Auth::user()->id))}}">
                        <input type="hidden" class="form-control" name="data[project_slug]" value="{{$project->project_slug}}">
                        <div class="form-group">
                            <label for="amount">Jumlah Donasi</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control {{$errors->first('amount') ? 'is-invalid' : ''}}" id="amount" placeholder="Jumlah donasi" name="data[amount]" onkeypress="javascript:return isNumberKey(event);" value="{{old('data.amount')}}">
                                <div class="invalid-feedback d-block">
                                    {{$errors->first("amount")}}
                                </div>
                            </div>
                            <small id="amountHelpBlock" class="form-text text-muted">
                                Masukkan nominal donasi minimal Rp 10.000 dengan kelipatan ribuan (contoh: 20.000, 50.000, 100.000). Maksimal 4.000.000.000
                            </small>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="anonymouse" name="data[anonymouse]" {{old('data.anonymouse') === "on" ? 'checked' : ''}}>
                            <label class="custom-control-label" for="anonymouse">Tampilkan sebagai anonim</label>
                        </div>
                        <div class="form-group mt-2">
                            {{-- {{old('bank_id') ? dd(old('bank_id')) : ''}} --}}
                            <label for="bank_code">Metode Pembayaran</label>
                            <select id="bank_code" name="data[bank_code]" class="select2 form-control {{$errors->first('bank_code') ? 'is-invalid' : ''}}">
                                @if (!empty(old('data.bank_code')))
                                    <option value="{{old('data.bank_code')}}" selected>{{"Transfer Bank ".$banks->where('id', old('data.bank_code'))->pluck('bank_name')[0]}}</option>
                                    @foreach($banks->where('id', '!=' ,old('data.bank_code')) as $key => $bank)
                                        <option value="{{$bank->bank_code}}">{{"Transfer Bank $bank->bank_name"}}</option>
                                    @endforeach
                                @else
                                    <option selected disabled>--Pilih Metode Pembayaran--</option>
                                    @foreach($banks as $key => $bank)
                                        <option value="{{$bank->bank_code}}">{{"Transfer Bank $bank->bank_name"}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback d-block">
                                {{$errors->first("bank_code")}}
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="phone_number">Nomor HP</label>
                            <input type="text" class="form-control" id="phone_number" placeholder="Jumlah donasi" name="data[phone_number]" onkeypress="javascript:return isNumberKey(event);" value="{{Auth::user()->profile->phone_number}}">
                            <small id="hpHelpBlock" class="form-text text-muted">
                                Notifikasi SMS akan dikirimkan ke nomor diatas
                            </small>
                        </div> --}}
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="agreement" onchange="javascript:handleAgreement(this, 'donate');">
                            <label class="custom-control-label" for="agreement">Saya setuju dengan <a href="">syarat & ketentuan</a> Sudut Negeri</label>
                        </div>
                        <div class="form-group d-flex">
                            <button type="submit" id="donate" class="btn btn-secondary w-50 mx-1" disabled onclick="javascript:return checkAgreement(this, 'agreement');">Lanjut</button>
                            <a href="{{route('project.show', ['slug' => $project->project_slug])}}" class="btn btn-danger w-50 mx-1">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.select2').select2({theme: "bootstrap4"});
    });
</script>
@endsection