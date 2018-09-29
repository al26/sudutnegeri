@extends('member.partials.menu.master')
@php
    $prop = Auth::user()->profile->toArray();
    $check = in_array(null, $prop);
@endphp
@section('menu')
    <div class="card">
        <div class="card-header text-left border-bottom bg-lighten">
            <h4 class="m-0">Informasi Personal</h4>
        </div>
        @if ($check)
            <div class="card-body">
                <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" class="card-link" data-toggle="pjax" data-pjax="menu">lengkapi profil Anda</a>
            </div>
        @else
            <div class="card-body">
                @if (Auth::user()->profile->biography !== "")
                    <p class="card-text">{{Auth::user()->profile->biography}}</p>
                @else
                    <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" class="card-link" data-toggle="pjax" data-pjax="menu">tambah biografi</a>
                @endif
            </div>
            <ul class="list-group list-group-flush">
                @if(Auth::user()->profile->profession !== "")
                    <li class="list-group-item text-capitalize"><i class="fas fa-briefcase fw mr-3"></i> {{Auth::user()->profile->profession}}</li>
                @else
                    <li class="list-group-item text-capitalize"><a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" data-toggle="pjax" data-pjax="menu" class="card-link"><i class="fas fa-briefcase fw mr-3"></i> tambah profesi</a></li>
                @endif
                
                @if(Auth::user()->profile->skills !== "")
                    <li class="list-group-item text-capitalize"><i class="fas fa-puzzle-piece fw mr-3"></i> {{Auth::user()->profile->skills}}</li>
                @else
                    <li class="list-group-item text-capitalize"><a href="" class="card-link"><i class="fas fa-puzzle-piece fw mr-3"></i> tambah keahlian</a></li>
                @endif
                @if(Auth::user()->profile->address->regency->name !== "")
                    <li class="list-group-item text-capitalize"><i class="fas fa-map-marker-alt fw mr-3"></i> {{strtolower(Auth::user()->profile->address->regency->name)}}</li>
                @else
                    <li class="list-group-item text-capitalize"><a href="" class="card-link"><i class="fas fa-map-marker-alt fw mr-3"></i> tambah alamat</a></li>
                @endif
            </ul>
        @endif
    </div>
@endsection