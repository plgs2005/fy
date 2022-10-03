@extends('layouts.login')
@section('content')
<div id="div-2" class="text-center mx-auto w-40">
    <div class="fonticon-wrap">
        <i class="bx bx-paper-plane" style="font-size: 70px; color: #010D33;"></i>
    </div>
    <p class="text-center title">{{ __('We sent you an email') }}</p>
    <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
    <p>{{ __('If you did not receive the email') }},</p>
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
    </form>
</div>
@endsection
