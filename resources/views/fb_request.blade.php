@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul>
                        @foreach($casos as $i => $caso)
                        <li><a href="?call={{$i}}">{{$i}} - {{$caso}}</a></li>
                        @endforeach
                    </ul>
                    @php
                        var_dump($data);
                    @endphp
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
