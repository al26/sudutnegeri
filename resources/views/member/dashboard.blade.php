@extends('layouts.app')

@section('content')
{{-- @include('layouts.partials._alert') --}}
<div class="container p-0 px-lg-3">
    <section class="m-topcard mt-lg-3" id="mt" data-pjax-container>
        @include('member.partials.topcard', ['menu' => $menu, 'section' => $section])        
    </section>
    <section class="m-content my-lg-3 clearfix" id="mc" data-pjax-container>
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
        // ClassicEditor
        // .create( document.querySelector('.editor') )
        // .then( editor => {
        //     console.log( editor );
        // } )
        // .catch( error => {
        //     console.error( error );
        // } );
</script>
<script>
    $(document).ready(function() {
        toggleActiveMenuTab();
        toggleActiveContentTab();

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
                },
                responsive : true,
                autoWidth : true,
                lengthChange : true,
                stateSave : true,
                fixedHeader : true
            }
        );
        
        $(document).loadModal();
        $(document).ajaxPagination();
        // $(document).activateCKEditor();
        $('.the-summernote').summernote({
            height:150
        });
        activateOptGenerator();
        $('.select2').select2({theme: "bootstrap4",tags: true,});
        $(document).ajaxSelect2("project_location", "{{route('get.location')}}");
        // showMoreLess(100, 'Selengkapnya', 'Sebagian', '.update-list-item');
    });

    $(document).on('click', '#password-create', function(e){
        e.preventDefault();
        $('#form-account').ajaxCrudNonModal(['#mr']);
    });

    $(document).on('click', '#password-change', function(e){
        e.preventDefault();
        $('#form-account-change').ajaxCrudNonModal(['#mr']);
    });

    $(document).on('click', '#profile-edit', function(e){
        e.preventDefault();
        $('#form-profile').ajaxCrudNonModal(['#mr', '#mt']);
    });

    $(document).on('click', '#upload-receipt', function(e){
        e.preventDefault();
        $('#form-receipt').ajaxCrudNonModal(['#mr']);
    });

    $(document).on('click', '#upload-verification', function(e){
        e.preventDefault();
        $('#form-verification').ajaxCrudNonModal(['#mr']);
    });

    $(document).on('click', '#create-project', function(e){
        e.preventDefault();
        $('#form-create-project').ajaxCrudNonModal(['#mr'], "{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}");
    });

    $(document).pjax('a[data-pjax=menu]', '#mc');
    $('#mc').on('pjax:complete', function() {
        toggleActiveMenuTab();
        toggleActiveContentTab();
    });

    $(document).pjax('a[data-pjax=main-content]', '#mr');
    $('#mr').on('pjax:complete', function() {
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
            console.log($(this));
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

        $('#mh-menu a').each(function() {
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
        });
        $('#mobile-'+menu[2]+'-'+menu[3]).addClass('active');
    }

    function activateOptGenerator(){
        generateOption('#province_id', '#regency_id', 'regencies', 'Kabupaten/Kota');
        generateOption('#regency_id', '#district_id', 'districts', 'Kecamatan');
    }

    
</script>
@endsection