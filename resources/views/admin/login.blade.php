@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="custom-form" method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <h4 class="text-center font-weight-bold">Masuk</h4>    
                    <h4 class="text-justify"><small>Halaman Masuk khusus Administrator</a></h4>    
                </div>

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    <label for="email" class="animated-label">{{ __('E-Mail Kamu') }}</label>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" style="position: absolute; margin-bottom: .25rem;">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group mb-5">
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
                    {{-- <a class="btn btn-link text-secondary px-0" href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                    </a> --}}
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
