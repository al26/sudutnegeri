@extends('member.partials.menu.master')

@section('menu')
    <div class="nav flex-column nav-pills" id="negeri-menu" aria-orientation="vertical">
        <a class="nav-link" id="m-negeri-donations" data-pjax="main-content" href="{{url('/dashboard/negeri/donations')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Donasi Saya</a>
        <a class="nav-link" id="m-negeri-activity" data-pjax="main-content" href="{{url('/dashboard/negeri/activity')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Aktivitas Saya</a>
        <a class="nav-link" id="m-negeri-cv" data-pjax="main-content" href="{{url('/dashboard/negeri/cv')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>CV Saya</a>
    </div>
@endsection