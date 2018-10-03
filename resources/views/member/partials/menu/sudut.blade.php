@extends('member.partials.menu.master')

@section('menu')
    <div class="card">
        <div class="card-header text-left border-bottom bg-lighten">
            <h4 class="m-0">Menu Si Sudut</h4>
        </div>
        <div class="list-group list-group-flush" id="sudut-menu">
            <a class="list-group-item list-group-item-action dv-menu" id="m-sudut-projects" data-toggle="pjax" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}"><i class="fas fw fa-project-diagram mr-2"></i>Proyek Saya</a>
            <a class="list-group-item list-group-item-action dv-menu" id="m-sudut-volunteer" data-toggle="pjax" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'volunteer'])}}"><i class="fas fw fa-people-carry mr-2"></i>Data Calon Relawan</a>
            @if (Auth::user()->profile->verification->status !== 'verified')
                <a class="list-group-item list-group-item-action dv-menu" id="m-sudut-verify" data-toggle="pjax" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'verify'])}}"><i class="fas fw fa-user-check mr-2"></i>Verifikasi Akun</a>
            @endif
        </div>
    </div>
    {{-- <div class="nav flex-column nav-pills" id="sudut-menu" aria-orientation="vertical">
        <a class="list-group-item list-group-item-action" id="m-sudut-projects" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/sudut/projects')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Proyek Saya</a>
        <a class="list-group-item list-group-item-action" id="m-sudut-volunteer" data-toggle="pjax" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'volunteer'])}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Data Calon Relawan</a>
        <a class="list-group-item list-group-item-action" id="m-sudut-verify" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/sudut/verify')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Verifikasi Akun</a>
    </div> --}}
@endsection