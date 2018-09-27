@extends('layouts.app')

{{-- @php
    if($errors->any()) {
        dd($errors->getMessages());
    }
@endphp --}}

@section('content')
<div class="container mt-lg-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card border-0">
                <div class="card-body text-center">
                    <h4>Hai, {{Auth::user()->profile->name}}</h4>
                    <p>Mohon lengkapi formulir berikut untuk melanjutkan pendaftaran sebagai relawan</p>
                </div>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-success">
                            {{ session()->get('error') }}
                        </div>
                    @endif
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
                            <label for="motivation">Apa motivasi Anda untuk menjadi relawan untuk proyek ini ?</label>
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