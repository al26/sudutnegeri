@extends('layouts.app')
@php
    $current_activity = Auth::user()->volunteers()->where('status', 'accepted')->orWhere('status', 'pending')->get();
@endphp

@section('content')
<div class="container my-md-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 p-0 px-md-3">
            <div class="card border-0 vh-100">
                @if (empty($current_activity))
                    @if (in_array(Auth::user()->id, $existing_volunteers))
                        <div class="card-body text-center">
                            <div class="my-3">
                                <i class="fas fa-clipboard-check fa-10x"></i>
                            </div>
                            <span class="font-weight-bold">Anda telah mendaftar ke proyek {{$project->project_name}} !</span><br>
                            <span class="">Mohon maaf, setiap member hanya diperkenankan mendaftar 1x pada setiap proyek yang sama.</span>
                            <br>
                            <div class="d-flex mt-3">
                                <a href="{{route('project.show', ['slug' => $project->project_slug])}}" class="btn btn-secondary w-50 m-0 mr-1">Kembali ke halaman proyek</a>
                                <a href="{{route('project.browse', ['category' => 'all'])}}" class="btn btn-primary w-50 m-0 ml-1">Cari proyek lain</a>
                            </div>
                        </div>
                    @else
                        <div class="card-body text-center pb-0">
                            <h4 class="m-0">Hai, {{ucwords(Auth::user()->profile->name)}}</h4>
                            <p class="m-0">Mohon lengkapi formulir berikut untuk melanjutkan pendaftaran sebagai relawan</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('volunteer.store')}}">
                                @csrf
                                <input type="hidden" class="form-control" name="data[user_id]" value="{{Auth::user()->id}}">
                                <input type="hidden" class="form-control" name="data[project_slug]" value="{{$project->project_slug}}">
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Kepada</div>
                                        </div>
                                        <input type="text" class="form-control" readonly value="{{$project->user->profile->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Subyek</div>
                                        </div>
                                        <textarea class="form-control" aria-label="Subyek" readonly style="height:auto">{{$project->project_name}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="motivation">Apa motivasi Anda ingin menjadi relawan untuk proyek ini ?</label>
                                    <textarea class="form-control editor {{$errors->first('motivation') ? 'is-invalid' : ''}}" id="motivation" rows="5" name="data[motivation]">{{old('motivation')}}</textarea>
                                    <div class="invalid-feedback d-block">
                                        {{$errors->first("motivation")}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="eligibility">Yakinkan kami bahwa Anda akan menjadi relawan yang tepat untuk proyek ini !</label>
                                    <textarea class="form-control editor {{$errors->first('eligibility') ? 'is-invalid' : ''}}" id="eligibility" rows="5" name="data[eligibility]">{{old('eligibility')}}</textarea>
                                    <div class="invalid-feedback d-block">
                                        {{$errors->first("eligibility")}}
                                    </div>
                                </div>
                                @if(!empty($questions))
                                    @foreach($questions as $key => $q)
                                        <div class="form-group">
                                            <label for="question{{$q->id}}">{{$q->question}}</label>
                                            <textarea class='form-control editor {{$errors->first("question$q->id") ? "is-invalid" : ""}}' id="question{{$q->id}}" rows="5" name="questions[question{{$q->id}}]">{{old("question$q->id")}}</textarea>
                                            <div class="invalid-feedback d-block">
                                                {{$errors->first("question$q->id")}}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="permitance" onchange="javascript:handleAgreement(this, 'regis');">
                                    <label class="custom-control-label" for="permitance">Izinkan pemilik proyek untuk melihat profil dan rekam jejak akun SudutNegeri saya</label>
                                </div>
                                <div class="form-group d-flex">
                                    <button type="submit" id="regis" class="btn btn-secondary w-50 mx-1" disabled onclick="javascript:return checkAgreement(this, 'permitance');">Lanjut</button>
                                    <a href="{{route('project.show', ['slug' => $project->project_slug])}}" class="btn btn-danger w-50 mx-1">Batal</a>
                                </div>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="card-body text-center">
                        <div class="my-3">
                            <i class="fas fa-clipboard-check fa-10x"></i>
                        </div>
                        <span class="font-weight-bold">Anda masih terdaftar sebagai (calon) relawan di proyek <a href="{{route('project.show', ['slug' => $current_activity[0]->project->project_slug])}}" class="card-link">{{$current_activity[0]->project->project_name}}</a> !</span><br>
                        <span class="">Mohon maaf, setiap member hanya dapat terlibat aktif sebagai relawan dalam 1 proyek. Tidak dapat merangkap ke proyek lain atau aktif dalam 2 atau lebih proyek dalam 1 waktu.</span>
                        <br>
                        <div class="d-flex mt-3">
                            <a href="{{route('project.show', ['slug' => $project->project_slug])}}" class="btn btn-secondary w-50 m-0 mr-1">Kembali ke halaman proyek</a>
                            <a href="{{route('project.browse', ['category' => 'all'])}}" class="btn btn-primary w-50 m-0 ml-1">Cari proyek lain</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var errors = new Array();
    @php foreach($errors->getMessages() as $key => $val){ @endphp
        errors["{{$key}}"] = "{{$val[0]}}";
    @php } @endphp
    
    function getFeedback(errors) {
        console.log('get' + errors);
        var inputs = $('textarea');
        
        $.each(errors, function(index, value){
            $('#'+index).parent().append('<div class="invalid-feedback d-block">'+value+'</div>');
            $('#'+index).addClass('is-invalid');
        });
    }

    function resetFeedback(){
        var inputs = $('input:not([type="submit"]), textarea, select');
        $.each(inputs, function(){
            $(this).siblings('.invalid-feedback').remove();
            $(this).removeClass('is-invalid');
        });
    }
</script>
@endsection