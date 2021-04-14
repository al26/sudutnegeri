<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CV</title>

    <link rel="stylesheet" href="{{secure_asset('css/app.css')}}">
</head>
<body class="bg-white">
    <div class="card container border-0">
        <div class="card-body border-0">
            <section class="cv-header bg-secondary clearfix">
                <div class="cv-title text-left text-secondary bg-white">
                    <span class="--text m-0 font-weight-bold">CURRICULUM VITAE RELAWAN</span>
                    <span class="--text _sub m-0">CURRICULUM VITAE OF VOLUNTEERS</span>
                </div>
                <div class="cv-brand">
                    <h4 class="text-white m-0">
                        <i class="fab fw fa-staylinked" data-fa-transform="grow-5"></i>
                        &nbsp;{{ config('app.name', 'SudutNegeri') }}
                    </h4>
                </div>
            </section>
            <section class="cv-top media my-3 px-3">
                <div class="media-body p-0">
                    <span class="--text font-weight-bold _head pl-2 text-uppercase">{{$user->profile->name}}</span>
                    <span class="--text font-weight-bold pl-2 text-uppercase">{{$user->profile->profession.' '.$user->profile->institution}}</span>
                    <hr class="my-1">
                    <ul class="list-group border-0 fa-ul">
                        <li class="list-group-item border-0 font-weight-bold py-3"><span class="fa-li"><i class="fas fa-map-marked-alt" data-fa-transform="grow-15"></i></span>
                            {{$user->profile->address->exact_location}} <br>
                            {{ucwords(strtolower("kecamatan ".$user->profile->address->district->name.", ".$user->profile->address->regency->name))}}
                        </li>
                        <li class="list-group-item border-0 font-weight-bold py-3"><span class="fa-li"><i class="fas fa-envelope" data-fa-transform="grow-15"></i></span>{{$user->email}}</li>
                        <li class="list-group-item border-0 font-weight-bold py-3"><span class="fa-li"><i class="fas fa-phone-square" data-fa-transform="grow-15"></i></span>{{$user->profile->phone_number}}</li>
                        <li class="list-group-item border-0 font-weight-bold py-3">
                            <span class="fa-li">
                                <span class="fa-stack">
                                    <i class="far fa-calendar fa-stack-2x" data-fa-transform="up-2"></i>
                                    <i class="fas fa-birthday-cake fa-stack-1x"></i>
                                </span>
                            </span>
                            {{Idnme::print_date($user->profile->dob, false)}}
                        </li>
                        <li class="list-group-item border-0 font-weight-bold py-3"><span class="fa-li"><i class="fas fa-user-graduate" data-fa-transform="grow-15"></i></span>{{$user->profile->cv->education}}</li>
                    </ul>
                </div>
                <img src="{{secure_asset($user->profile->profile_picture)}}" alt="" class="img-fluid img-thumbnail ml-3">
            </section>
            <section class="cv-data">
                <dl class="row p-3">
                    <dt class="col-12 mb-2 card-header">Keahlian / <i>Skills</i></dt>
                    <dd class="col-12">
                        <ul class="fa-ul list-group border-0">
                            @php
                                $skills = explode(",", $user->profile->skills);
                            @endphp

                            @foreach ($skills as $s)
                                <li class="list-group-item border-0"><span class="fa-li"><i class="fas fa-angle-double-right"></i></span>{{$s}}</li>
                            @endforeach
                        </ul>
                    </dd>

                    <dt class="col-12 mb-2 card-header">Bahasa Asing / <i>Foreign Language</i></dt>
                    <dd class="col-12">
                        <ul class="list-group fa-ul border-0">
                            @php
                                $langs = explode(",", $user->profile->cv->foreign_lang);
                            @endphp

                            @foreach ($langs as $l)
                                <li class="list-group-item border-0"><span class="fa-li"><i class="fas fa-angle-double-right"></i></span>{{$l}}</li>
                            @endforeach
                        </ul>
                    </dd>

                    <dt class="col-12 card-header">Pengalaman Organisasi / <i>Organizational Experience</i></dt>
                    <dd class="col-12">
                        <div class="card-body">
                            {!! $user->profile->cv->org_exp !!}
                        </div>
                    </dd>

                    <dt class="col-12 card-header">Pengalaman Profesional/ <i>Professional Experience</i></dt>
                    <dd class="col-12">
                        <div class="card-body">
                            {!! $user->profile->cv->pro_exp !!}
                        </div>
                    </dd>
                </dl>
            </section>
            <div class="row line-col">
                <div class="col-2 bg-primary"></div>
                <div class="col-2 bg-dark"></div>
                <div class="col-2 bg-danger"></div>
                <div class="col-2 bg-success"></div>
                <div class="col-2 bg-warning"></div>
                <div class="col-2 bg-info"></div>
            </div>
            <section class="cv-footer d-flex flex-row py-3">
                <h4 class="m-0 mr-auto">
                    <i class="fab fw fa-staylinked" data-fa-transform="grow-5"></i>
                    &nbsp;{{ config('app.name', 'SudutNegeri') }}
                </h4>
                <ul class="ml-auto my-0 list-inline">
                    <li class="list-inline-item"><i class="fab fa-facebook-f rounded-0 border-0 social-icon fb"></i>&nbsp;SudutNegeri</li>
                    <li class="list-inline-item"><i class="fab fa-google-plus-g rounded-0 border-0 social-icon g-plus"></i>&nbsp;SudutNegeri</li>
                    <li class="list-inline-item"><i class="fab fa-youtube rounded-0 border-0 social-icon youtube"></i>&nbsp;SudutNegeriChanel</li>
                    <li class="list-inline-item"><i class="fab fa-instagram rounded-0 border-0 social-icon ig"></i>&nbsp;@SudutNegeri</li>
                </ul>
            </section>
        </div>
    </div>



    <script src="{{secure_asset('js/app.js')}}"></script>
</body>
</html>