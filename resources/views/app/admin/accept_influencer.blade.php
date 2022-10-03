@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-md-2">
           <h1> {{$campaign->name}} </h1>
        </div>
        <div class="col-md-2">
            <a href="{{route('admin.list.influencer', ['campaignId' => $campaign->id])}}">Add Influencer</a>
         </div>
    </div>
    <div class="row justify-content-center row-cols-1">
        @foreach ($campaign->influencers as $influencer)
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        {{$influencer->name}} - id - {{$influencer->id}}
                    <form id="form1" method="POST" action="{{ route('admin.store.accept.influencer') }}">
                        @csrf
                        <a href="{{route('admin.influencer.detail', ['id' => $influencer->id])}}" class="card-link">{{$influencer->first_name}} {{$influencer->last_name}}</a>
                        <input type="hidden" id="userId" name="userId" value="{{$influencer->id}}">
                        <input type="hidden" id="campaignId" name="campaignId" value="{{$campaign->id}}">
                        <input type="hidden" id="command" name="command" value="accept">
                        @if ($influencer->pivot->admin_accept == 1)
                            - Influencer Accepted
                        @elseif ($influencer->pivot->admin_accept === 0)
                        @else
                            <button type="submit" class="m-2 btn btn-primary">
                                {{ __('Accept') }}
                            </button>
                        @endif
                    </form>
                    <form id="form2" method="POST" action="{{ route('admin.store.accept.influencer') }}">
                        @csrf
                        <input type="hidden" id="userId" name="userId" value="{{$influencer->id}}">
                        <input type="hidden" id="campaignId" name="campaignId" value="{{$campaign->id}}">
                        <input type="hidden" id="command" name="command" value="reject">
                        @if ($influencer->pivot->admin_accept === 0)
                        - Influencer Rejected
                        @elseif ($influencer->pivot->admin_accept == 1)

                        @else
                            <button type="submit" class="m-2 btn btn-primary">
                                {{ __('Reject') }}
                            </button>
                        @endif
                    </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
         
    </div>
</div>
@endsection
