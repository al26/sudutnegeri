@extends('layouts.app')

@section('content')
<div class="container mt-lg-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 bg-white p-3 mb-3">
            <h4 class="text-justify mb-3 font-weight-bold">Selamat, {{Auth::user()->profile->name}}</h4>
            <p class="text-justify">Formulir pendaftaran Anda <b>berhasil</b> dikirimkan ke pengelola proyek <b>{{$project->project_name}}</b> untuk selanjutnya dilakukan proses seleksi oleh pihak terkait.</p>
            <p class="text-justify">Informasi mengenai <b>hasil seleksi dapat diketahui melalui alamat email Anda</b> (sesuai yang tercantum di CV). Informasi tersebut juga dapat Anda ketahui melalui website Sudut Negeri pada dashboard akun Anda.</p>
            <p class="text-justify">Mohon untuk menunggu sampai proses seleksi berakhir.</p>
                
            <p class="mb-2 text-right">Terima kasih,</p>
            <h5 class=" text-right font-weight-bold">SudutNegeri</h5>
        </div>
    </div>
</div>
@endsection
