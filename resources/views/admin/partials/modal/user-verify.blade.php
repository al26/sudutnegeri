<div class="row">
    <div class="col-12 mb-3">
        <h4 class="m-0 text-center">Pencocokan Data Pengguna</h4>
    </div>
    <hr>
    <div class="col-12 col-lg-6 pl3-3 pr-1">
        <dl class="row">
            <dt class="col-12">No. {{$verification->profile->identity_card}}</dt>
            <dd class="col-12">{{$verification->profile->identity_number}}</dd>
            <dt class="col-12">Nama</dt>
            <dd class="col-12">{{$verification->profile->name}}</dd>
            <dt class="col-12">Jenis Kelamin</dt>
            <dd class="col-12">{{$verification->profile->gender}}</dd>
            <dt class="col-12">Tanggal Lahir</dt>
            <dd class="col-12">{{Idnme::print_date($verification->profile->dob,false)}}</dd>
            <dt class="col-12">Alamat</dt>
            <dd class="col-12">{{$verification->profile->address->exact_location.", Kec. ".ucwords(strtolower($verification->profile->address->district->name))." ".ucwords(strtolower($verification->profile->address->regency->name)).", Prop. ".ucwords(strtolower($verification->profile->address->province->name))}}</td>
            <dt class="col-12">Profesi</dt>
            <dd class="col-12">{{$verification->profile->profession}}</dd>
        </dl>
        {{-- <div class="justify-content-center">
            <div class="table-responsive mt-3">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th >No. {{$verification->profile->identity_card}}</th>
                    </tr>
                    <tr>
                        <td class="text-left">{{$verification->profile->identity_number}}</td>
                    </tr>
                    <tr>
                        <th >Nama</th>
                    </tr>
                    <tr>
                        <td class="text-left">{{$verification->profile->name}}</td>
                    </tr>
                    <tr>
                        <th >Jenis Kelamin</th>
                    </tr>
                    <tr>
                        <td class="text-left">{{$verification->profile->gender}}</td>
                    </tr>
                    <tr>
                        <th >Tanggal Lahir</th>
                    </tr>
                    <tr>
                        <td class="text-left">{{Idnme::print_date($verification->profile->dob,false)}}</td>
                    </tr>
                    <tr>
                        <th >Alamat</th>
                    </tr>
                    <tr>
                        <td class="text-left">{{$verification->profile->address->exact_location." Kec. ".$verification->profile->address->district->name." ".$verification->profile->address->regency->name." Prop. ".$verification->profile->address->province->name}}</td>
                    </tr>
                    <tr>
                        <th >Profesi</th>
                    </tr>
                    <tr>
                        <td class="text-left">{{$verification->profile->profession}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>
    <div class="col-12 col-lg-6 pr-3 pl-1">
        <img class="align-self-center ml-auto img-fluid" src="{{asset($verification->scan_id_card)}}" alt="Scan / Foto Kartu Identitas">
    </div>
</div>
<div class="row">
    <div class="col-12 my-3">
        <h4 class="m-0 text-center">Foto Verifikasi</h4>
    </div>
    <hr>
    <div class="col-12 d-flex flex-row justify-content-center">
        <img class="align-self-center mx-auto img-fluid" src="{{asset($verification->verification_picture)}}" alt="Foto Verifikasi">
    </div>
</div>
      