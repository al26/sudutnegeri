@extends('member.partials.menu.master')

@section('menu')
    <div class="nav flex-column nav-pills" id="sudut-menu" aria-orientation="vertical">
        <a class="nav-link" id="m-sudut-projects" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/sudut/projects')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Proyek Saya</a>
        <a class="nav-link" id="m-sudut-volunteer" data-toggle="pjax" data-pjax="main-content" href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'volunteer'])}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Data Calon Relawan</a>
        {{-- <a class="nav-link" id="m-sudut-account" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/setting/account')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Akun</a> --}}
    </div>
@endsection