@extends('member.partials.menu.master')

@section('menu')
    <div class="nav flex-column nav-pills" id="setting-menu" aria-orientation="vertical">
        <a class="nav-link" id="m-setting-personal-info" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/setting/personal-info')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Data Diri</a>
        <a class="nav-link" id="m-setting-account" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/setting/account')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Akun</a>
    </div>
@endsection