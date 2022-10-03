@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center mb-4">Add Influencer to Campaign: {{$campaign->name}}</h3>
            <form method="POST" action="{{route('admin.list.influencer', ['campaignId' => $campaign->id])}}">
                @csrf
                <div class="form-row">
                    <x-select-category :categories="$categories" />
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Filter') }}
                        </button>
                        <a href="{{route('admin.list.influencer', ['campaignId' => $campaign->id])}}"><button type="button" class="btn btn-primary">
                            {{ __('Clear') }}
                        </button></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            
        </div>
    </div>
    <div class="row justify-content-center row-cols-1 row-cols-md-1">
        @foreach ($influencers as $influencer)
        @php
            $social_medias = $influencer->social_medias;
        @endphp
        @if ($social_medias->count())
            
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                <h5 class="card-title"><a href="{{route('admin.influencer.detail', ['id' => $influencer->id])}}" class="card-link">{{$influencer->first_name}} {{$influencer->last_name}}</a></h5>
                    <div class="row">
                        <div class="col-md-2">
                            {{$influencer->name}} - id - {{$influencer->id}}
                        </div>
                        <div class="col-md-2">
                            Social Medias <br>
                            @foreach ($social_medias as $item)
                                @if ($item->social_media !== 'facebook')
                                    <a target="_blank" href="{{$item->url}}" class="card-link">{{socialMedias($item)}}</a><br>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-2">
                            Category : <br>
                            @foreach ($influencer->categories as $category)
                                {{$category->name}}<br>
                            @endforeach
                        </div>
                        <div class="col-md-2">
                             info
                        </div>
                        <div class="col-md-2">
                            <form id="form{{$influencer->id}}" method="POST" action="{{ route('admin.add.influencer.campaign') }}">
                                @csrf
                                <input type="hidden" id="userId" name="userId" value="{{$influencer->id}}">
                                <input type="hidden" id="campaignId" name="campaignId" value="{{$campaign->id}}">
                                <button type="submit" class="m-2 btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                                
                            </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>

        @endif
        @endforeach
    </div>
</div>
@endsection
