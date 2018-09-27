@extends('member.partials.menu.master')

@section('menu')
    <div class="card">
        <div class="card-header font-weight-bold bg-primary text-white text-center">
            <h4 class="m-0">Informasi Personal</h4>
        </div>
        <div class="card-body">
            @if (Auth::user()->profile->biography !== "")
                <p class="card-text">{{Auth::user()->profile->biography}}</p>
            @else
                <a href="" class="card-link">tambah biografi</a>
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
    </div>
@endsection