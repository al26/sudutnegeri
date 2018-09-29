@extends('member.partials.menu.master')

@section('menu')
    <div class="card">
        <div class="card-header text-left border-bottom bg-lighten">
            <h4 class="m-0">Menu Pengaturan</h4>
        </div>
        <div class="list-group" id="setting-menu">
            <a class="list-group-item list-group-item-action dv-menu" id="m-setting-profile" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/setting/profile')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Edit Profil</a>
            <a class="list-group-item list-group-item-action dv-menu" id="m-setting-account" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/setting/account')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Akun</a>
        </div>
    </div>
    {{-- <div class="nav flex-column nav-pills" id="setting-menu" aria-orientation="vertical">
        <a class="list-group-item list-group-item-action" id="m-setting-profile" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/setting/profile')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Edit Profil</a>
        <a class="list-group-item list-group-item-action" id="m-setting-account" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/setting/account')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Akun</a>
    </div> --}}
@endsection