@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="custom-form" method="POST" action="{{ route('register') }}">
                @csrf
                @if($continue)
                    <input type="hidden" name="continue" value="{{$continue}}">
                @endif
                <div class="mb-3">
                    <h4 class="text-center font-weight-bold">Registrasi Akun</h4>    
                    <h4 class="text-justify"><small>Daftar mudah dan cepat dengan akun media sosialmu</small></h4>
                </div>
                
                <a href="{{ route('oauth.login', ['provider' => 'facebook', 'action' => 'register', 'continue' => $continue]) }}" class="w-100 mb-2 btn btn-default btn-social fb"><span class="fab fa-facebook-f"></span>Daftar Dengan Akun Facebook</a>
                <a href="{{ route('oauth.login', ['provider' => 'google', 'action' => 'register', 'continue' => $continue]) }}" class="w-100 mb-2 btn btn-default btn-social g-plus"><span class="fab fa-google-plus-g"></span>Daftar Dengan Akun Google</a>
                
                <h2 id="form-divider"><span>atau</span></h2>
                
                <div class="form-group">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    <label for="name" class="animated-label">{{ __('Nama Kamu') }}</label>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" style="position: absolute; margin-bottom: .25rem;">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    <label for="email" class="animated-label">{{ __('E-Mail Kamu') }}</label>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" style="position: absolute; margin-bottom: .25rem;">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <label for="password" class="animated-label">{{ __('Kata sandi') }}</label>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" style="position: absolute; margin-bottom: .25rem;">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    <label for="password-confirm" class="animated-label">{{ __('Ketik ulang kata sandi') }}</label>
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Registrasi') }}
                    </button>
                    <hr class="mb-0">
                    <p>Sudah punya akun ? <a class="btn btn-md btn-link p-0" href="{{ route('register') }}">Masuk</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
