@extends('admin.layout')

@section('content')
<!-- Left Panel -->


<!-- Left Panel -->
@include('admin.partials.menu')
<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle float-left"><i class="fa fa fa-tasks"></i></a>
                <div class="header-left">
                    <button class="search-trigger"><i class="fa fa-search"></i></button>
                    <div class="form-inline">
                        <form class="search-form">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                            <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                        </form>
                    </div>

                    <div class="dropdown for-notification">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="count bg-danger">5</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">
                        <p class="red">You have 3 Notification</p>
                        <a class="dropdown-item media bg-flat-color-1" href="#">
                            <i class="fa fa-check"></i>
                            <p>Server #1 overloaded.</p>
                        </a>
                        <a class="dropdown-item media bg-flat-color-4" href="#">
                            <i class="fa fa-info"></i>
                            <p>Server #2 overloaded.</p>
                        </a>
                        <a class="dropdown-item media bg-flat-color-5" href="#">
                            <i class="fa fa-warning"></i>
                            <p>Server #3 overloaded.</p>
                        </a>
                        </div>
                    </div>

                    <div class="dropdown for-message">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                            id="message"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti-email"></i>
                        <span class="count bg-primary">9</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="message">
                        <p class="red">You have 4 Mails</p>
                        <a class="dropdown-item media bg-flat-color-1" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                            <span class="message media-body">
                                <span class="name float-left">Jonathan Smith</span>
                                <span class="time float-right">Just now</span>
                                    <p>Hello, this is an example msg</p>
                            </span>
                        </a>
                        <a class="dropdown-item media bg-flat-color-4" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                            <span class="message media-body">
                                <span class="name float-left">Jack Sanders</span>
                                <span class="time float-right">5 minutes ago</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </span>
                        </a>
                        <a class="dropdown-item media bg-flat-color-5" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                            <span class="message media-body">
                                <span class="name float-left">Cheryl Wheeler</span>
                                <span class="time float-right">10 minutes ago</span>
                                    <p>Hello, this is an example msg</p>
                            </span>
                        </a>
                        <a class="dropdown-item media bg-flat-color-3" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                            <span class="message media-body">
                                <span class="name float-left">Rachel Santos</span>
                                <span class="time float-right">15 minutes ago</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="{{asset(Auth::user()->profile->profile_picture)}}" alt="User Avatar">
                    </a>

                    <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                            <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>
                    </div>
                </div>

                <div class="language-select dropdown" id="language-select">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                        <i class="flag-icon flag-icon-us"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="language" >
                        <div class="dropdown-item">
                            <span class="flag-icon flag-icon-fr"></span>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-es"></i>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-us"></i>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-it"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </header><!-- /header -->
    <!-- Header-->

    {{-- <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Dashboard</li>
                        <li class="active">xx</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="content mt-3" id="ac" data-pjax-container>

        @if(Session::get('success'))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @php
            if (empty($menu)) {
                $menu = "overview";   
            }
        @endphp
        @include('admin.partials.menu.'.$menu)

    </div> <!-- .content -->
    @include('components.modal')
</div><!-- /#right-panel -->

<!-- Right Panel -->
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $(document).loadModal();
        toggleActiveMenuTab();
        table = $('#example').DataTable(
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
    });


    $(document).pjax('a[data-pjax=adm-menu]', '#ac');
    $('#ac').on('pjax:send', function() {
        toggleActiveMenuTab();
    });

	$(document).on('click', '#project-verify', function(e){
        e.preventDefault();
        var data = $(this).data('data');
        var url = $(this).attr('href');
        $(this).ajaxYesNo(url, data);
    });

    $(document).on('click', '#project-reject', function(e){
        e.preventDefault();
        var data = $(this).data('data');
        var url = $(this).attr('href');
        $(this).ajaxYesNo(url, data);
    });


    $('#ac').on('pjax:complete', function() {
        table.destroy();
        table = $('#example').DataTable(
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
    });

    function toggleActiveMenuTab() {
        var path = document.location.pathname,
            menu = path.split("/");

        $('#am-menu li').each(function() {
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
        });
        $('#am-'+menu[3]).parent('li').addClass('active');
    }
</script>
@endsection