@extends('layouts.app')

@section('content')
    @if (isset($fbPageInfo))
        {{var_dump($fbPageInfo)}}
        {{var_dump($instaUserInfo)}}
    @else
    <a class="btn btn-lg btn-primary btn-block" href="{{ url('auth/facebook') }}">
        <strong>Connect Facebook</strong>
    </a>
    @endif
@endsection