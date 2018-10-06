@extends('layouts.app')

@section('content')
<div class="container mt-lg-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 bg-white p-0 vh-100">
            <div class="card border-0">
                <div class="card-body">
                    <h4 class="text-justify mb-3 font-weight-bold">Selamat, {{Auth::user()->profile->name}}</h4>
                    <p class="text-justify">Formulir pendaftaran Anda <b>berhasil</b> dikirimkan ke pengelola proyek <b>{{$project->project_name}}</b> untuk selanjutnya dilakukan proses seleksi oleh pihak terkait.</p>
                    <p class="text-justify">Informasi mengenai <b>hasil seleksi dapat diketahui melalui alamat email Anda</b> (sesuai yang tercantum di CV). Informasi tersebut juga dapat Anda ketahui melalui website Sudut Negeri pada <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}" class="card-link">dashboard</a> akun Anda.</p>
                    <p class="text-justify">Mohon untuk menunggu sampai proses seleksi berakhir.</p>
                        
                    <p class="mb-2 text-right">Terimakasih,</p>
                    <h5 class=" text-right font-weight-bold">SudutNegeri</h5>
                    <hr>
                    <div class="d-flex border-0 mt-4">
                        <a href="{{route('project.show', ['slug' => $project->project_slug])}}" class="btn btn-secondary w-50 m-0 mr-1">Kembali ke halaman proyek</a>
                        <a href="{{route('project.browse', ['category' => 'all'])}}" class="btn btn-primary w-50 m-0 ml-1">Cari proyek lain</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
