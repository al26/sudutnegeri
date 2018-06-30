@extends('member.partials.menu.master')

@section('menu')
    <div class="nav flex-column nav-pills" id="sudut-menu" aria-orientation="vertical">
        <a class="nav-link" id="m-sudut-campaigns" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/sudut/campaigns')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Campaign Saya</a>
        {{-- <a class="nav-link" id="m-sudut-account" data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/setting/account')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Akun</a> --}}
    </div>
@endsection