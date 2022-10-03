@extends('layouts.login')
@section('content')
    <div id="div-1" class="text-center mx-auto w-40 mt-n5">
        <p class="text-center title">Log in</p>
        <p>Quae tibi placent quicunq prosunt aut diligebat multum.</p>
        <div class="card disable-rounded-right mb-0 p-3 d-flex justify-content-center">
            <div class="card-header pb-1 pt-0">
                <div class="card-title mb-0">
                    <p class="text-center red-hat-display mb-0">Login</p>
                </div>
            </div>
            <div class="card-body p-0">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group mb-50">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-50 d-flex align-items-center">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">
                        <i id="icon-password" class="bx bx-show-alt" style="margin-left: -35px; font-size: 25px;" title="Show password" onclick="showHidePassword();"></i>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-50 d-flex align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-50 d-flex align-items-center">
                        
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        
                    </div>
                    
                    <button type="submit" class="btn btn-primary position-relative w-100">Log in</button>
                </form>
            </div>
        </div>
    </div>
@endsection