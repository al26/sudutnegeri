@extends('layouts.app')

@section('content')
{{-- @include('layouts.partials._alert') --}}
<div class="container">
    <section class="m-topcard mt-3">
        <div class="card border-0">
            <img id="p-cover" class="card-img-top" src="{{asset('storage/profile_pictures/cover_default.jpg')}}" alt="Cover Photo">
            {{-- <div id="p-cover-overlay">
                <i class="fas fw fa-camera-retro"></i> Perbarui Foto Sampul</a>
            </div> --}}
            <div class="card-body p-0">
                <div class="nav nav-pills nav-fill w-100" id="h-menu">
                    <a id="m-overview" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/overview')}}">Overview</a>
                    <a id="m-setting" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/setting')}}">Pengaturan</a>
                    <a id="m-sudut" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/sudut')}}">Jadi Sudut</a>
                    <a id="m-negeri" class="nav-item nav-link p-3" data-toggle="pjax" data-pjax="menu" href="{{url('/dashboard/negeri')}}">Jadi Negeri</a>
                </div>
            </div>
            <div class="card-img-overlay d-flex justify-content-center p-0" style="bottom:4rem">
                <div id="p-pic-container" class="text-center mr-5 mt-5">
                    <img id="p-pic" class="img-thumbnail pchange" src="{{asset($user_profile->profile_picture)}}" alt="Profile Picture">
                    <a id="p-pic-overlay" class="text-white decoration-none" href="{{route('avatar.edit', ['id' => $user_profile->id])}}" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Perbarui Foto Profil","edit":"Simpan Perubahan", "lg":true, "cancel":"Batal", "actionUrl":"{{route('avatar.update', ['id' => $user_profile->id])}}", "pjax-reload":false, "pchange":true, "pchange-url":"{{route('pchange', ['id' => $user_profile->id])}}"}'><i class="fas fw fa-camera-retro"></i> Perbarui Foto Profil</a>
                </div>
                <div id="p-data" class="mt-5">
                    <div class="d-flex justify-content-between">
                        <span class="--text _head">{{$user_profile->name}}</span>
                    </div>

                    <ul class="list-inline">
                        <li class="list-inline-item mr-5">
                            {{-- <a data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/sudut/projects')}}"> --}}
                                <span class="--text">Proyek</span>
                                <span class="--text _head">1000</span>
                            {{-- </a> --}}
                        </li>
                        <li class="list-inline-item mr-5">
                            {{-- <a data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/negeri/activity')}}"> --}}
                                <span class="--text">Aktifitas</span>
                                <span class="--text _head">10</span>
                            {{-- </a> --}}
                        </li>
                        <li class="list-inline-item">
                            {{-- <a data-toggle="pjax" data-pjax="main-content" href="{{url('/dashboard/negeri/donations')}}"> --}}
                                <span class="--text">Investasi</span>
                                <span class="--text _head">20</span>
                            {{-- </a> --}}
                        </li>
                    </ul>

                    <span class="--text">
                        @if(!empty(Auth::user()->verify->id))
                            <span class="badge badge-info align-self-center"><i class="mr-1 far fw fa-check-square" data-fa-transform="grow-3"></i>Pengguna terverifikasi</span><br>
                        @endif
                        <span class="--text _sub mt-1">Tergabung sejak : {{Idnme::print_date(Auth::user()->created_at, false)}}</span>
                    </span>
                </div>
            </div>
        </div>
    </section>
    <section class="m-content my-3 clearfix" id="mc" data-pjax-container>
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
    @include('components.modal')
</div>
@endsection
@section('script')
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script> --}}
<script>
        ClassicEditor
        .create( document.querySelector('.editor') )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable(
            {
                "language": {
                    "sProcessing":   "Sedang proses...",
                    "sLengthMenu":   "Tampilan _MENU_ entri",
                    "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                    "sInfo":         "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
                    "sInfoEmpty":    "Tampilan 0 hingga 0 dari 0 entri",
                    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Cari:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Awal",
                        "sPrevious": "Balik",
                        "sNext":     "Lanjut",
                        "sLast":     "Akhir"
                    }
                }
            }
        );
        toggleActiveMenuTab();
        toggleActiveContentTab();
        $(document).loadModal();
        $(document).ajaxPagination();
        $(document).activateCKEditor();
        // $('.the-summernote').summernote();
        activateOptGenerator();
        $('.select2').select2({theme: "bootstrap4",tags: true,});
        $(document).ajaxSelect2("project_location", "{{route('get.location')}}");
    });

    $(document).on('click', '#password-create', function(e){
        e.preventDefault();
        $('#form-account').ajaxCrudNonModal('#mr');
    });

    $(document).on('click', '#profile-edit', function(e){
        e.preventDefault();
        $('#form-profile').ajaxCrudNonModal('#mr');
    });

    $(document).on('click', '#upload-receipt', function(e){
        e.preventDefault();
        $('#form-receipt').ajaxCrudNonModal('#mr');
    });

    $(document).on('click', '#create-project', function(e){
        e.preventDefault();
        $('#form-create-project').ajaxCrudNonModal('#mr');
    });

    $(document).pjax('a[data-pjax=menu]', '#mc');
    $('#mc').on('pjax:send', function() {
        toggleActiveMenuTab();
        toggleActiveContentTab();
    });

    $(document).pjax('a[data-pjax=main-content]', '#mr');
    $('#mr').on('pjax:send', function() {
        toggleActiveContentTab();
    });

    $('#mc, #mr').on('pjax:complete', function() {
        $('.select2').select2({theme: "bootstrap4",tags: true,});
        $('#example').DataTable();
        activateOptGenerator();
        // $(document).activateSummernote();
        $(document).ajaxSelect2("project_location", "{{route('get.location')}}");
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

    function activateOptGenerator(){
        generateOption('#province_id', '#regency_id', 'regencies', 'Kabupaten/Kota');
        generateOption('#regency_id', '#district_id', 'districts', 'Kecamatan');
    }

    
</script>
@endsection