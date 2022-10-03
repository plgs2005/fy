@extends('layouts.login')
@section('content')
<div id="div-3" class="text-center mx-auto w-40">
    <p class="text-center title">Complete your registration</p>
    <p>Quae tibi placent quicunq prosunt aut diligebat multum.</p>
    <div class="card disable-rounded-right mb-0 p-3 d-flex justify-content-center">
        <div class="card-body p-0">
            <form method="POST" action="{{ route('brand.complete.profile') }}">
                @csrf
                <div class="form-group mb-50">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                </div>
                <div class="form-group mb-50">
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror phone_us" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="Phone">
                </div>
                <div class="form-group mb-50">
                    <input id="brand_name" type="text" class="form-control @error('brand_name') is-invalid @enderror" name="brand_name" value="{{ old('brand_name') }}" required autocomplete="brand_name" placeholder="Company">
                </div>
                <button type="submit" class="btn btn-primary position-relative w-100">Continue</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('view-js')
<script>
    $(document).ready(function() {
        $('.phone_us').mask('+1 (000) 000-0000');
    });
</script>
@endsection
