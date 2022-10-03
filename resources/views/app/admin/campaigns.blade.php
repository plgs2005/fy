@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center row-cols-1 row-cols-md-1">
        @if ($campaigns->count())
            @foreach ($campaigns as $campaign)
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body">
                    <h5 class="card-title"><a href="{{route('admin.campaign.detail', ['id' => $campaign->id])}}" class="card-link stretched-link">{{$campaign->name}}</a></h5>
                        <div class="row">
                            <div class="col-md-2">
                                img
                            </div>
                            <div class="col-md-2">
                                Created in: {{$campaign->created_at}}<br>
                                Starts:<br>
                                End:<br>
                            </div>
                            <div class="col-md-2">
                                {{$campaign->influencers->count()}} influencers
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            You don't have any campaigns yet.
        @endif
        
    </div>
</div>
@endsection
