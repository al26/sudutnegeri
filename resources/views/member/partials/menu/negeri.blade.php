@extends('member.partials.menu.master')

@section('menu')
    <div class="card">
        <div class="card-header text-left border-bottom bg-lighten">
            <h4 class="m-0">Menu Si Negeri</h4>
        </div>
        <div class="list-group list-group-flush" id="negeri-menu">
            <a class="list-group-item list-group-item-action dv-menu" id="m-negeri-donations" data-pjax="main-content" href="{{url('/dashboard/negeri/donations')}}"><i class="fas fw fa-coins mr-2"></i>Investasi Saya</a>
            <a class="list-group-item list-group-item-action dv-menu" id="m-negeri-activity" data-pjax="main-content" href="{{url('/dashboard/negeri/activity')}}"><i class="fas fw fa-hand-holding-heart mr-2"></i>Aktivitas Saya</a>
            <a class="list-group-item list-group-item-action dv-menu" id="m-negeri-cv" data-pjax="main-content" href="{{url('/dashboard/negeri/cv')}}"><i class="fas fw fa-id-card mr-2"></i>Buat CV Saya</a>
        </div>
    </div>

    {{-- <div class="nav flex-column nav-pills" id="negeri-menu" aria-orientation="vertical">
        <a class="nav-link" id="m-negeri-donations" data-pjax="main-content" href="{{url('/dashboard/negeri/donations')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Donasi Saya</a>
        <a class="nav-link" id="m-negeri-activity" data-pjax="main-content" href="{{url('/dashboard/negeri/activity')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Aktivitas Saya</a>
        <a class="nav-link" id="m-negeri-cv" data-pjax="main-content" href="{{url('/dashboard/negeri/cv')}}"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>CV Saya</a>
    </div> --}}
@endsection