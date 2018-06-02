@extends('layouts.app')

@section('content')
<div class="container">
    <section class="m-topcard mt-3">
        <div class="card border-0">
            <img id="p-cover" class="card-img-top" src="{{asset('storage/profile_pictures/cover_default.jpg')}}" alt="Cover Photo">
            <div id="p-cover-overlay">
                <i class="fas fw fa-camera-retro"></i> Perbarui Foto Sampul</a>
            </div>
            <div class="card-body p-0">
                <div class="nav nav-pills nav-fill w-100" id="h-menu">
                    <a id="m-overview" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/overview')}}">Overview</a>
                    <a id="m-setting" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/setting')}}">Pengaturan</a>
                    <a id="m-sudut" class="nav-item nav-link p-3 border-left border-right" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/sudut')}}">Jadi Sudut</a>
                    <a id="m-negeri" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/negeri')}}">Jadi Negeri</a>
                </div>
            </div>
            <div id="p-pic-container" class="text-center">
                <img id="p-pic" class="card-img-bottom img-thumbnail" src="{{asset('storage/profile_pictures/'.Auth::user()->profile->profile_picture)}}" alt="Profile Picture">
                <a id="p-pic-overlay" class="text-white decoration-none" href=""><i class="fas fw fa-camera-retro"></i> Perbarui Foto Profil</a>
            </div>
            <div id="p-data" class="card-img-overlay">
                <span class="--text _head">{{Auth::user()->profile->name}}</span>
                <span class="--text _sub"><i class="far fw fa-check-square" data-fa-transform="grow-2"></i> Pengguna Terverifikasi</span>
            </div>
        </div>
    </section>
    <section class="m-content mt-3" id="mc" data-pjax-container>
        {{-- <div class="loader-overlay">
            <div class="loader"></div>
        </div> --}}
        @php
            if (empty($menu)) {
                $menu = "overview";   
            }
        @endphp
        @include('member.partials.menu.'.$menu, ['section' => $section, 'menu' => $menu])
    </section>
</div>
@endsection
@section('script')
    $(document).pjax('a[data-pjax=menu]', '#mc');
    toggleActiveMenuTab();
    $('#mc').on('pjax:send', function() {
        toggleActiveMenuTab();
        toggleActiveContentTab();
    });

    $(document).pjax('a[data-pjax=main-content]', '#mr');
    toggleActiveContentTab();
    $('#mr').on('pjax:send', function() {
        toggleActiveContentTab();
    });

    function toggleActiveMenuTab() {
        var path = document.location.pathname,
            menu = path.split("/");
        $('#h-menu a').each(function() {
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
        });
        $('#m-'+menu[2]).addClass('active');
    }

    function toggleActiveContentTab() {
        var path = document.location.pathname,
            menu = path.split("/");
        $('#'+menu[2]+'-menu a').not('#m-'+menu[2]+'-'+menu[3]).each(function() {
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
        });
        $('#m-'+menu[2]+'-'+menu[3]).addClass('active');
    }
@endsection