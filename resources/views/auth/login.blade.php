@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="custom-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <h4 class="text-center font-weight-bold">Masuk</h4>    
                    <h4 class="text-justify"><small>Silahkan masuk untuk dapat mengakses semua layanan SudutNegeri atau daftar </small><a class="btn btn-md btn-link px-0" href="{{ route('register') }}">disini</a></h4>    
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
                <div class="form-group mb-0 p-0">
                    <button type="submit" class="btn btn-secondary w-100">
                        {{ __('Masuk') }}
                    </button>
                    <a class="btn btn-link text-secondary px-0" href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                    </a>
                </div>
                
                <h2 id="form-divider"><span>atau</span></h2>

                <a href="{{ route('oauth.login', ['provider' => 'facebook']) }}" class="w-100 mb-2 btn btn-default btn-social fb"><span class="fab fa-facebook-f"></span>Masuk Dengan Akun Facebook</a>
                <a href="{{ route('oauth.login', ['provider' => 'google']) }}" class="w-100 mb-2 btn btn-default btn-social g-plus"><span class="fab fa-google-plus-g"></span>Masuk Dengan Akun Google</a>
            </form>
        </div>
    </div>
</div>
@endsection
