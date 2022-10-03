@extends('layouts.login')
@section('content')
<div id="div-1" class="text-center mx-auto w-40 mt-n5">
    <p class="text-center title">Sign up</p>
    <p>Quae tibi placent quicunq prosunt aut diligebat multum.</p>
    <div class="card disable-rounded-right mb-0 p-3 d-flex justify-content-center">
        <div class="card-header pb-1 pt-0">
            <div class="card-title mb-0">
                <p class="text-center red-hat-display mb-0">Company Register</p>
            </div>
        </div>
        <div class="card-body p-0">
            <form method="POST" action="{{ route('registerBrand') }}">


                @csrf
                <div class="form-group mb-50">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-50 d-flex align-items-center">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="password">
                    <i id="icon-password" class="bx bx-show-alt" style="margin-left: -35px; font-size: 25px;" title="Show password" onclick="showHidePassword();"></i>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-50 d-flex align-items-center">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="confirm-password">
                    <i id="icon-password-confirm" class="bx bx-show-alt" style="margin-left: -35px; font-size: 25px;" title="Show password" onclick="showHidePasswordConfirmation();"></i>
                </div>

                <div class="form-group mb-2 text-left">
                    <div class="custom-control custom-switch custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="terms" name="terms">
                        <label class="custom-control-label" for="terms">
                        </label>
                        <span>Accept <a class="font-weight-bold" href="#"><u>the terms</u></a></span>
                    </div>
                </div>
                <input type="hidden" name="time_zone" id="time_zone">
                <button type="submit" class="btn btn-primary position-relative w-100">Sign up</button>
            </form>
        </div>
    </div>
</div>
@endsection


<script type="text/javascript">
    window.onload = function timeZone() {

        var offset = new Date().getTimezoneOffset();
        //console.log(offset);
        //console.log(Intl.DateTimeFormat().resolvedOptions().timeZone)

        var msg = Intl.DateTimeFormat().resolvedOptions().timeZone;
        
        document.getElementById('time_zone').value = msg;

    };
</script>