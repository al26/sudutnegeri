@extends('layouts.app')

@section('content')
<div class="container">
    <section class="m-resume mt-3">
        <div class="row">
            <div class="col-12 bg-white pt-3 pr-0">
                <div class="media">
                    <img class="img-fluid img-thumbnail mr-3" src="{{asset('storage/profile_pictures/'.Auth::user()->profile->profile_picture)}}" alt="" style="max-height:15rem;">
                    <div class="media-body mt-auto">
                        <span class="p-name --text _head">{{ Auth::user()->profile->name }}</span>
                        <div class="row my-3">
                            <div class="col-4">
                                <span class="--text">Campaign Saya</span>
                                <span class="--text">50</span>
                            </div>
                            <div class="col-4">
                                <span class="--text">Total Donasi</span>
                                <span class="--text">1.000.000</span>
                            </div>
                            <div class="col-4">
                                <span class="--text">Relawan</span>
                                <span class="--text">10</span>
                            </div>
                        </div>
                        <nav id="" class="navbar navbar-expand-sm bg-white navbar-dark p-0">
                            <div class="nav nav-pills nav-fill w-100" id="" role="tablist">
                                <a class="nav-item nav-link active" id="" data-toggle="tab" href="#p-about" role="tab" aria-controls="p-about" aria-selected="true">Tentang</a>
                                <a class="nav-item nav-link border-left border-right" id="" data-toggle="tab" href="#p-sudut" role="tab" aria-controls="p-sudut" aria-selected="false">Si Sudut</a>
                                <a class="nav-item nav-link" id="" data-toggle="tab" href="#p-negeri" role="tab" aria-controls="p-negeri" aria-selected="false">Si Negeri</a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="m-content mt-3">
        <div class="tab-content clearfix">
            <div class="tab-pane show active" id="p-about" role="tabpanel" aria-labelledby="p-about-tab">
                <div class="row">
                    <div class="col-3 bg-white py-3 border-right">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-personal-tab" data-toggle="pill" href="#v-pills-personal" role="tab" aria-controls="v-pills-personal" aria-selected="true"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Data Diri</a>
                            <a class="nav-link" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills-account" aria-selected="false"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Akun</a>
                        </div>
                    </div>
                    <div class="col-9 bg-white py-3" style="min-height:20rem;">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane show active" id="v-pills-personal" role="tabpanel" aria-labelledby="v-pills-personal-tab">Data Diri </div>
                            <div class="tab-pane" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">Pengaturan Akun</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="p-sudut" role="tabpanel" aria-labelledby="p-sudut-tab">
                <div class="row">
                    <div class="col-3 bg-white py-3 border-right">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-mycampaign-tab" data-toggle="pill" href="#v-pills-mycampaign" role="tab" aria-controls="v-pills-mycampaign" aria-selected="true"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Campaign Saya</a>
                            <a class="nav-link" id="v-pills-disbursement-tab" data-toggle="pill" href="#v-pills-disbursement" role="tab" aria-controls="v-pills-disbursement" aria-selected="false"><i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>Pencairan Dana</a>
                        </div>
                    </div>
                    <div class="col-9 bg-white py-3" style="min-height:20rem;">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane show active" id="v-pills-mycampaign" role="tabpanel" aria-labelledby="v-pills-mycampaign-tab">
                                <div class="container-fluid d-flex flex-row justify-content-between mb-3">
                                    <span class="--text _head">Daftar Campaign</span>
                                    <a class="btn btn-xs btn-secondary align-self-center" href=""><i class="fas fw fa-plus"></i> Campaign Baru</a>                                      
                                </div>
                                <table id="mc-table" class="table table-striped table-bordered" style="width:100%; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Publikasi</th>
                                            <th rowspan="2">Judul Campaign</th>
                                            <th colspan="2">Deadline (Sisa Hari)</th>
                                            <th colspan="2">Pencapaian Target</th>
                                            <th rowspan="2">Opsi</th>
                                        </tr>
                                        <tr>
                                            <th>Dana</th>
                                            <th>Relawan</th>
                                            <th>Dana</th>
                                            <th>Relawan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>4 April 2018</td>
                                            <td>Project 1</td>
                                            <td>10</td>
                                            <td>5</td>
                                            <td>70 %</td>
                                            <td>80 %</td>
                                            <td>
                                                <a class="btn btn-xs btn-link text-danger p-0" href=""><i class="fas fw fa-trash" data-fa-transform="shrink-2"></i> Hapus</a> | 
                                                <a class="btn btn-xs btn-link text-info p-0" href=""><i class="fas fw fa-info-circle" data-fa-transform="shrink-2"></i> Detil</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    {{-- <tfoot>
                                        <tr>
                                            <th>Publikasi</th>
                                            <th>Judul Project</th>
                                            <th>Dana</th>
                                            <th>Relawan</th>
                                            <th>Dana</th>
                                            <th>Relawan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </tfoot> --}}
                                </table>
                            </div>
                            <div class="tab-pane" id="v-pills-disbursement" role="tabpanel" aria-labelledby="v-pills-disbursement-tab">Pencairan Dana</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="p-negeri" role="tabpanel" aria-labelledby="p-negeri-tab">
                <div class="row">
                    {{-- <div class="col-12 py-3 bg-white" style="min-height:20rem"> --}}
                        <div class="col-3 bg-white py-3 border-right">
                            <div class="list-group list-group-flush">
                                <a href="" class="list-group-item list-group-item-action active">
                                    <i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>
                                    Riwayat Donasi
                                </a>
                                <a href="" class="list-group-item list-group-item-action">
                                    <i class="fas fw fa-check-square mr-2" data-fa-transform="grow-3"></i>
                                    Kegiatan
                                </a>
                            </div>
                        </div>
                        <div class="col-9 bg-white py-3" style="min-height:20rem;">
        
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
    $(document).ready(function() {
        $('#mc-table').DataTable();
    } );
@endsection