@extends('layouts.app')

@section('content')
<div class="container mt-lg-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card border-0">
                <div class="card-body text-center">
                    <p>Anda akan berinvestasi untuk proyek</p>
                    <h4>{{$project->project_name}}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('donation.store')}}">
                        @csrf
                        <input type="hidden" class="form-control" name="data[user_id]" value="{{Auth::user()->id}}">
                        <input type="hidden" class="form-control" name="data[project_slug]" value="{{$project->project_slug}}">
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
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="anonymouse" name="data[anonymouse]">
                            <label class="custom-control-label" for="anonymouse">Tampilkan sebagai anonim</label>
                        </div>
                        <div class="form-group mt-2">
                            <label for="bank_id">Metode Pembayaran</label>
                            <select id="bank_id" name="data[bank_id]" class="select2 form-control">
                                <option selected disabled>--Pilih Metode Pembayaran--</option>
                                @foreach($banks as $key => $bank)
                                    <option value="{{$bank->id}}">{{"Transfer Bank $bank->bank_name"}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Nomor HP</label>
                            <input type="text" class="form-control" id="phone_number" placeholder="Jumlah donasi" name="data[phone_number]" onkeypress="javascript:return isNumberKey(event);" value="{{Auth::user()->profile->phone_number}}">
                            <small id="hpHelpBlock" class="form-text text-muted">
                                Notifikasi SMS akan dikirimkan ke nomor diatas
                            </small>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="agreement" name="data[agreement]" onchange="javascript:handleAgreement(this, 'donate');">
                            <label class="custom-control-label" for="agreement">Saya setuju dengan <a href="">syarat & ketentuan</a> Sudut Negeri</label>
                        </div>
                        <div class="form-group d-flex">
                            <button type="submit" id="donate" class="btn btn-secondary w-50 mx-1" disabled>Lanjut</button>
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
        $('.select2').select2({theme: "bootstrap4",tags: true,});
    });
</script>
@endsection