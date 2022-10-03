@extends('layouts.brand')
@section('content')
<div class="modal-body-content mt-2">
<div id="existing-campaign">
    <div class="row d-flex justify-content-between align-items-baseline mb-1">
    <div>
        <p class="red-hat-display" style="font-size: 25px;">Copy everything from existing campaign</p>
    </div>
    <div>
        <div class="d-flex btn input-secondary px-1">
            <i class="bx bx-search font-medium-5" style="color: #747E9F;"></i>
            <input type="text" placeholder="Search campaigns" class="input-secondary" style="color: #747E9F; height: auto;">
        </div>
    </div>
    </div>

    <div class="row justify-content-center">
    @foreach ($campaigns as $campaign)
    @if($campaign->partial != 1)
        <div class="card card-campaign align-items-center mx-1" campaign_id="{{$campaign->id}}">
            <div class="campaign-selected p-1 d-none">
            <button type="submit" class="btn btn-primary position-relative w-100 mt-auto" style="margin-top: 2px;">select</button>
            </div>
            <div class="campaign-background"></div>
            <div class="d-flex flex-column justify-content-between" style="height: 100%; padding: 30px 20px; width:100%">
            <div class="d-flex justify-content-around">
                <div class="text-center">
                <div style="color: #033FFF; width: 27px;margin-left: 0px;">
                    <img src="../assets/images/fluent_people-audience-20-regular.png" class="img-fluid">
                </div>
                <div>
                    <p style="font-weight: 500;">{{$campaign->selectedInfluencersCount()}}</p>
                </div>
                </div>
                <div class="text-center">
                <div style="color: #02EEFD; width: 27px;margin-left: 0px;">
                    <img src="../assets/images/fluent_money-20-regular.png" class="img-fluid">
                </div>
                <div>
                    <p style="font-weight: 500;">${{thousandsFormat($campaign->budget, true)}}</p>
                </div>
                </div>
                <div class="text-center">
                <div style="color: #FF9933; width: 27px;margin-left: 0px;">
                    <img src="../assets/images/fluent_eye-show-16-filled.png" class="img-fluid">
                </div>
                <div>
                    <p style="font-weight: 500;">{{thousandsFormat($campaign->impression_count())}}</p>
                </div>
                </div>
            </div>
            <div>
                <p class="title text-center mb-0" style="font-size: 20px; font-weight: 500;">{{$campaign->name}}</p>
            </div>
            </div>
        </div>
    
    @endif
    @endforeach
    </div>
    <div class="row mt-1 mb-2">
        <a href="#" class="m-auto">more campaings</a>
    </div>
    <div class="row mb-1">
    <a class="position-relative m-auto d-flex justify-content-center align-items-center" href="{{ route('campaign.create') }}">
        <button type="button" id="btn-create-campaign-scratch" class="btn btn-primary" style="height: 48px;">
            <i class="bx bx-plus-circle" style="margin-right: 10px; margin-bottom: 2px; font-size: 20px;"></i><span style="font-weight: 700;">Create campaign from scratch</span>
        </button>
    </a>
    </div>
</div>
</div>

@endsection

@section('view-js')
<script>
//copy campaign
$('.card-campaign').mouseenter(function() {
  $(' .campaign-selected', this).removeClass('d-none');
});

//copy campaign
$('.card-campaign').mouseleave(function() {
  if (!($(' .campaign-selected', this).hasClass('d-flex'))) {
    $(' .campaign-selected', this).addClass('d-none');
  }
});

//copy campaign
$('.card-campaign').click(function() {
  $('.campaign-selected').removeClass('d-flex');
  $('.campaign-selected').addClass('d-none');
  $(' .campaign-selected', this).removeClass('d-none');
  $(' .campaign-selected', this).addClass('d-flex');
  window.location.href = "{{url('/campaign-create')}}/"+$(this).attr('campaign_id');
});
</script>
@endsection