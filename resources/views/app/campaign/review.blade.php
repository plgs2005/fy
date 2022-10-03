@extends('layouts.newCampaign')
@section('content')
<div class="container-fluid p-3 mt-2">
    <div id="new-campaign-review"  style="margin-bottom: 85px;">

        <div class="row d-flex justify-content-between align-items-baseline mb-1">
        <div class="col-xl-12 col-md-6 col-12 m-auto">
            <p class="red-hat-display pr-2" style="font-size: 25px;">Review</p>
        </div>
        </div>

        <div class="row d-flex justify-content-between align-items-baseline mb-1">
        <div class="col-xl-12 col-md-6 col-12 m-auto">
            <ul id="timeline-new-campaign-review" class="timeline">

            <li class="li-timeline-review-new-campaign timeline-item timeline-icon-*color-palette* active pt-0">
            <div class="timeline-content card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="pr-2">
                        <p class="title" style="font-size: 25px;">1. Type of Campaign</p>
                        </div>
                        <div>
                        <a id="campaign-item-1-title-edit" href="{{route('campaign.edit', ['id'=>$campaign->id])}}" style="text-decoration: underline; font-weight: 500;">edit</a>
                        </div>
                    </div>
                    @if ($campaign->type == 'paid')
                        <p>Paid Campaign</p>
                    @endif
                    @if ($campaign->type == 'trade')
                        <p>Trade Campaign</p>
                    @endif
                    <hr class="mt-2 mb-0" style="border: solid 1px #000000; opacity: 0.1;">
                </div>
            </div>
            </li>

            <li class="li-timeline-review-new-campaign timeline-item timeline-icon-*color-palette* active">
            <div class="timeline-content card">
                <div class="card-body pt-0">
                <div class="d-flex">
                    <div class="pr-2">
                    <p class="title" style="font-size: 25px;">2. Goal</p>
                    </div>
                    <div>
                    <a id="campaign-item-2-title-edit" href="{{route('campaign.edit', ['id'=>$campaign->id])}}" style="text-decoration: underline; font-weight: 500;">edit</a>
                    </div>
                </div>
                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Objective</p>
                    </div>
                    <div>
                    <p>{{ ucFirst($campaign->goal) }}</p>
                    </div>
                </div>
                <hr class="mt-1 mb-0" style="border: solid 1px #000000; opacity: 0.1;">
                </div>
            </div>
            </li>

            <li class="li-timeline-review-new-campaign timeline-item timeline-icon-*color-palette* active">
            <div class="timeline-content card">
                <div class="card-body pt-0">
                <div class="d-flex">
                    <div class="pr-2">
                    <p class="title" style="font-size: 25px;">3. Audience</p>
                    </div>
                    <div>
                    <a id="campaign-item-3-title-edit" href="{{route('campaign.edit', ['id'=>$campaign->id])}}" style="text-decoration: underline; font-weight: 500;">edit</a>
                    </div>
                </div>

                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Category</p>
                    </div>
                    <div>
                    {{-- <p>Category X - Subcategorie Y</p> --}}
                    <p>{{$audience->category->name}}</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Work it</p>
                    </div>
                    <div>
                        @if ($audience->influencer_size == 'medium')
                            <p>Medium-sized influencers</p>
                        @endif
                        @if ($audience->influencer_size == 'micro')
                            <p>Micro influencers</p>
                        @endif
                    </div>
                </div>
                
                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Gender</p>
                    </div>
                    <div>
                        @if ($audience->audience_gender == 'f')
                            <p>Feminine - {{$audience->audience_age}} years</p>
                        @endif
                        @if ($audience->audience_gender == 'm')
                            <p>Masculine - {{$audience->audience_age}} years</p>
                        @endif

                    </div>
                </div>

                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Location</p>
                    </div>
                    <div>
                    <p><span class="title primary" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;"></span> United States</p>
                    </div>
                </div>

                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Language</p>
                    </div>
                    <div>
                    <p>English</p>
                    </div>
                </div>
                <hr class="mt-1 mb-0" style="border: solid 1px #000000; opacity: 0.1;">
                </div>
            </div>
            </li>

            <li class="li-timeline-review-new-campaign timeline-item timeline-icon-*color-palette* active">
            <div class="timeline-content card">
                <div class="card-body pt-0">
                <div class="d-flex">
                    <div class="pr-2">
                    <p class="title" style="font-size: 25px;">4. Format</p>
                    </div>
                    <div>
                    <a id="campaign-item-4-title-edit" href="{{route('campaign.edit', ['id'=>$campaign->id])}}" style="text-decoration: underline; font-weight: 500;">edit</a>
                    </div>
                </div>

                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Where</p>
                    </div>
                    <div>
                        @if ($campaign->social_platform_instagram AND $campaign->social_platform_facebook)
                            <p>Instagram & Facebook</p>
                        @else
                            @if ($campaign->social_platform_instagram)
                                <p>Instagram</p>
                            @endif
                            @if ($campaign->social_platform_facebook)
                                <p>Facebook</p>
                            @endif
                        @endif
                    </div>
                </div>
                
                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Format</p>
                    </div>
                    <div>
                        <p>{{ucfirst($campaign->format)}}</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Type</p>
                    </div>
                    <div>
                        @if ($campaign->format_type_feed AND $campaign->format_type_story)
                        <p>Feed & Stories</p>
                        @else
                            @if ($campaign->format_type_feed)
                                <p>Feed</p>
                            @endif
                            @if ($campaign->format_type_story)
                                <p>Stories</p>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">What look/feel/style</p>
                    </div>
                    <div>
                    <p>{{ ucfirst($campaign->style) }}</p>
                    </div>
                </div>

                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">What is your brand goal with this campaign?</p>
                    </div>
                    <div>
                    <p>{{$campaign->goal_description}}</p>
                    </div>
                </div>

                @if ($campaign->goal_images)
                <div class=" d-flex align-items-baseline mb-1">
                    <div class="col-xl-12 col-md-6 col-12 p-0">
                        @php
                            $images = json_decode($campaign->goal_images);
                        @endphp
                        @foreach ($images as $img)
                            <img src="{{URL::asset("/storage/$img")}}" class="rounded mx-1" style="box-shadow: 8px 8px 10px rgba(0, 0, 0, 0.3);" width="120" height="120">
                        @endforeach
                    </div>
                </div>
                @endif


                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Influencer will receive a product</p>
                    </div>
                    <div>
                        @if ($campaign->physical_product AND $campaign->digital_product AND $campaign->service)
                            <p>Yes, Physical, digital product and service</p>
                        @elseif ($campaign->physical_product AND $campaign->digital_product)
                            <p>Yes, Physical and digital product</p>
                        @elseif ($campaign->physical_product AND $campaign->service)
                            <p>Yes, Physical product and service</p>
                        @elseif ($campaign->digital_product AND $campaign->service)
                            <p>Yes, Digital product and service</p>
                        @elseif ($campaign->physical_product)
                            <p>Yes, Physical product</p>
                        @elseif ($campaign->digital_product)
                            <p>Yes, Digital product</p>
                        @elseif ($campaign->service)
                            <p>Yes, Service</p>
                        @else 
                            <p>No.</p>
                        @endif
                    </div>
                </div>

                @if ($campaign->physical_product OR $campaign->digital_product OR $campaign->service)
                    <div class="d-flex align-items-baseline mb-1">
                        <div>
                            <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">What is the product?</p>
                        </div>
                        <div>
                            <p>{{$campaign->product_description}}</p>
                        </div>
                    </div>
                    
                    @if ($campaign->product_images)
                    <div class=" d-flex align-items-baseline mb-1">
                        <div class="col-xl-12 col-md-6 col-12 p-0">
                            @php
                                $images = json_decode($campaign->product_images);
                            @endphp
                            @foreach ($images as $img)
                                <img src="{{URL::asset("/storage/$img")}}" class="rounded mx-1" style="box-shadow: 8px 8px 10px rgba(0, 0, 0, 0.3);" width="120" height="120">
                            @endforeach
                        </div>
                    </div>
                    @endif
                @endif

                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">URL you want influencers to send their followers to:</p>
                    </div>
                    <div>
                    <a href="{{$campaign->url}}" style="text-decoration: underline;">{{$campaign->url}}</a>
                    </div>
                </div>

                <div class="d-flex align-items-baseline mb-1">
                    <div>
                        <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Specific instructions:</p>
                    </div>
                    <div>
                        <p>{{$campaign->instructions}}</p>
                    </div>
                </div>
                @if ($campaign->instruction_images)
                    <div class=" d-flex align-items-baseline mb-1">
                        <div class="col-xl-12 col-md-6 col-12 p-0">
                            @php
                                $images = json_decode($campaign->instruction_images);
                            @endphp
                            @foreach ($images as $img)
                                <img src="{{URL::asset("/storage/$img")}}" class="rounded mx-1" style="box-shadow: 8px 8px 10px rgba(0, 0, 0, 0.3);" width="120" height="120">
                            @endforeach
                        </div>
                    </div>
                @endif
                <hr class="mt-1 mb-0" style="border: solid 1px #000000; opacity: 0.1;">
                </div>
            </div>
            </li>

            <li class="li-timeline-review-new-campaign timeline-item timeline-icon-*color-palette* active">
            <div class="timeline-content card">
                <div class="card-body pt-0">
                <div class="d-flex">
                    <div class="pr-2">
                    <p class="title" style="font-size: 25px;">5. Time & Budget</p>
                    </div>
                    <div>
                    <a id="campaign-item-5-title-edit" href="{{route('campaign.edit', ['id'=>$campaign->id])}}" style="text-decoration: underline; font-weight: 500;">edit</a>
                    </div>
                </div>

                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Date & time content should be posted</p>
                    </div>
                    <div>
                    <p>{{$campaign->datetime}}</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-baseline mb-1">
                    <div>
                    <p class="title mr-2" style="font-size: 15px; font-weight: 500; font-family: 'Red Hat Text', sans-serif;">Budget</p>
                    </div>
                    <div>
                    <p>{{stripeNumFormat($campaign->budget)}}</p>
                    </div>
                </div>
                </div>
            </div>
            </li>

        </ul>
        </div>
        </div>

    </div>

    <div id="new-campaign-switch" class="row mb-1 pl-2">
        <div class="col-xl-12 col-md-6 col-12 m-auto">

        <div class="form-group d-flex mb-2 text-left">
            <div class="custom-control custom-switch custom-control-inline m-auto">
                <span class="switch-influencers-1-text-left @if($campaign->different_influencers == 0) primary @endif" style="margin-left: -130px; margin-right: 55px;">Repeat high performing influencers</span>
                <input type="checkbox" class="custom-control-input" id="switch-influencers-1" name="switch-influencers-1" @if($campaign->different_influencers == 1) checked @endif>
                <label class="custom-control-label" for="switch-influencers-1">
                </label>
                <span class="switch-influencers-1-text-right pl-50 @if($campaign->different_influencers == 1) primary @endif">Use different influencers</span>
            </div>
        </div>

        <div class="form-group d-flex mb-2 text-left">
            <div class="custom-control custom-switch custom-control-inline m-auto">
                <span class="switch-influencers-2-text-left @if($campaign->manual_select_influencers == 0) primary @endif pr-4"style="margin-left: -60px;">Let ai select best influencers and run campaign</span>
                <input type="checkbox" class="custom-control-input toggle-pro @if($user->subscriptionActive()) subscription-active @endif" id="switch-influencers-2" name="switch-influencers-2" @if($campaign->manual_select_influencers == 1) checked @endif>
                <label class="custom-control-label" for="switch-influencers-2">
                </label>
                <span class="switch-influencers-2-text-right pl-50 @if($campaign->manual_select_influencers == 1) primary @endif">I want to manually select suggested influencers</span>
                <div class="badge-pro-toggle">
                <p>PRO</p>
                </div>
            </div>
        </div>

        </div>
    </div>

    {{-- select cards --}}
    <div id="new-campaign-payment" class="row pl-2 mb-1">
        <div class="col-xl-9 col-md-6 col-12 m-auto">
        <div class="card mt-1">
            <div class="card-body p-1">
                <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <p class="title mb-0" style="font-size: 25px; font-weight: 500;">Total cost: {{stripeNumFormat($campaign->budget)}}</p>
                </div>
                <div>
                    <input type="button" class="btn btn-secondary position-relative btn-add-new-credit-card" onclick="addNewCreditCard('#new-campaign-payment')" value="Add new credit card"></input>
                </div>
                </div>
                <div id="new-card" class="d-none">
                    <form id='card-form' method="POST" action="{{ route('campaign.pay') }}">
                        @csrf
                        <div class="d-flex align-items-center">
                            <div>
                            <div>
                                <img class="img-fluid" src="../assets/images/card-credit.png">
                            </div>
                            <div>
                                <div class="form-group mb-2 text-left">
                                <div class="custom-control custom-switch custom-control-inline ml-1">
                                    <input type="checkbox" checked class="custom-control-input" id="switch-save-card" name="switch-save-card">
                                    <label class="custom-control-label" for="switch-save-card">
                                    </label>
                                    <span class="primary">Save card</span>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div>
                                <div class="form-group mb-2">
                                    <label class="title" style="font-size: 15px;">Credit card</label>
                                    <input type="text" class="form-control" name="card_number" id="credit-card" placeholder="Credit card number" required="required" maxlength="19">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="title" style="font-size: 15px;">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name on card"  maxlength="50" required="required">
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="form-group mb-2" style="width: 48%;">
                                        <label class="title" style="font-size: 15px;">Expiration date</label>
                                        <input maxlength='5' placeholder="MM/YY" type="text" class="form-control" id="expiration-date" pattern="(0[1-9]|1[012])/(2[1-9]{1}|3[0-9]{1})" title="Card expiration date" required>
                                        <input type="hidden" name="SecureCard-expiryMonth">
                                        <input type="hidden" name="SecureCard-expiryYear">
                                    </div>
                                    <div class="form-group mb-2" style="width: 48%;">
                                        <label class="title" style="font-size: 15px;">CVV</label>
                                        <input type="text" class="form-control" name="cvv" id="cvv" placeholder="CVV" required="required" maxlength="3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn-pay-start-campaign btn btn-primary position-relative w-100">Pay and start</button>
                    </form>
                </div>

                @if ($cards->count())
                <div id="cards-content" class="">
                    <p style="font-size: 13px; margin-bottom: 5px;">Select the card</p>
                    @foreach ($cards as $card)
                    <div class="d-flex align-items-center mb-1">
                        <div id="card-{{$loop->iteration}}-new-campaign" class="card-bank credit-card-1 mr-1" card_id="{{$card['id']}}" iteration="{{$loop->iteration}}">
                            <div id="card-{{$loop->iteration}}-selected" class="card-bank-selected title d-none">Selected</div>
                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div>
                                    @if ($card['card']['brand'] == 'visa')
                                        <img src="../assets/images/icon-visa.png" class="img-fluid">
                                    @elseif ($card['card']['brand'] == 'master')
                                        <img src="../assets/images/icon-mastercard.png" class="img-fluid">
                                    @endif
                                </div>
                                <div style="width: 60%;">
                                    <p style="font-size: 20px;">Final <span class="pl-1">{{$card['card']['last4']}}</span></p>
                                    <div class="d-flex justify-content-between" style="font-size: 16px;">
                                        <div>{{$card['card']['exp_month']}}/{{$card['card']['exp_year']}}</div>
                                        <div>xxx</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                    <form id='card-form' method="POST" action="{{ route('campaign.pay') }}">
                        @csrf
                        <input type="hidden" id="card_id" name="card_id">
                        <button type="submit" class="btn-pay-start-campaign btn btn-primary position-relative w-100 mt-2">Pay and start</button>
                    </form>
                </div>
                @else
                <div id="cards-no-content" class="text-center">
                    <div id="cards-no-content" class="text-center d-none">
                        <div class="m-auto">
                            <p style="font-size: 13px;">No credit cards added</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        </div>
    </div>
    {{-- select cards end --}}
</div>
@endsection

@section('view-js')
<script>

$('#switch-influencers-1').click(function(e) {
    
  if ($('#switch-influencers-1').hasClass('toggle-pro')) {
    e.preventDefault();
    $('#modal-upgrade').modal();
  } else {
    if ($('.switch-influencers-1-text-right').hasClass('primary')){
      $('.switch-influencers-1-text-left').addClass('primary');
      $('.switch-influencers-1-text-right').removeClass('primary');
    } else {
      $('.switch-influencers-1-text-left').removeClass('primary');
      $('.switch-influencers-1-text-right').addClass('primary');
    }

    $.ajax({
        type:'POST',
        url:'/campaign-review-switch',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'ajax': true, 'different_influencers': $(this).is(':checked'), 'campaignId': {{$campaign->id}}},
    });
  }
});

$('#switch-influencers-2').click(function(e) {
  if ($('#switch-influencers-2').hasClass('toggle-pro') && !($(this).hasClass('subscription-active')) ) {
    e.preventDefault();
    $('#modal-upgrade').modal();
  } else {
    if ($('.switch-influencers-2-text-right').hasClass('primary')){
      $('.switch-influencers-2-text-left').addClass('primary');
      $('.switch-influencers-2-text-right').removeClass('primary');
    } else {
      $('.switch-influencers-2-text-left').removeClass('primary');
      $('.switch-influencers-2-text-right').addClass('primary');
    }
    $.ajax({
        type:'POST',
        url:'/campaign-review-switch',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'ajax': true, 'manual_select': $(this).is(':checked'), 'campaignId': {{$campaign->id}}},
    });
  }
});

function addNewCreditCard(divCard) {
  if ($(' #new-card', divCard).hasClass('d-none')) {
      $(' #new-card', divCard).removeClass('d-none');
      $(' #cards-no-content', divCard).addClass('d-none');
      $(' #cards-content', divCard).addClass('d-none');
      $(' .btn-add-new-credit-card', divCard)[0].value = 'Use existing cards';
  } else {
      $(' #new-card', divCard).addClass('d-none');
      $(' #cards-no-content', divCard).addClass('d-none');
      $(' #cards-content', divCard).removeClass('d-none');
      $(' .btn-add-new-credit-card', divCard)[0].value = 'Add new credit card';
  }
}

$(".card-bank").click(function(){
    var iteration = $(this).attr('iteration');
    $(".card-bank").each(function() {
        var iteration2 = $(this).attr('iteration');
        if (iteration == iteration2) {
            console.log(iteration2);
            if ($("#card-"+iteration+"-selected").hasClass('d-none')) {
                $("#card-"+iteration+"-selected").removeClass('d-none');
                $("#card_id").val($(this).attr('card_id'));
            } else {
                $("#card-"+iteration+"-selected").addClass('d-none');
            }
        } else {
            $("#card-"+iteration2+"-selected").addClass('d-none');
        }
    });
});

//mascara numero cartao
document.getElementById("credit-card").addEventListener("input", function() {
  var i = document.getElementById("credit-card").value.length;
  var str = document.getElementById("credit-card").value
  if (isNaN(Number(str.charAt(i-1)))) {
    document.getElementById("credit-card").value = str.substr(0, i-1)
  }
});
document.addEventListener('keydown', function(event) { 
  if(event.keyCode != 46 && event.keyCode != 8){
  var i = document.getElementById("credit-card").value.length;
  if (i === 4 || i === 9 || i === 14)
    document.getElementById("credit-card").value = document.getElementById("credit-card").value + " ";
  }
});

//mascara expiry date
var expiryMask = function() {
    var inputChar = String.fromCharCode(event.keyCode);
    var code = event.keyCode;
    var allowedKeys = [8];
    if (allowedKeys.indexOf(code) !== -1) {
        return;
    }

    event.target.value = event.target.value.replace(
        /^([1-9]\/|[2-9])$/g, '0$1/'
    ).replace(
        /^(0[1-9]|1[0-2])$/g, '$1/'
    ).replace(
        /^([0-1])([3-9])$/g, '0$1/$2'
    ).replace(
        /^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2'
    ).replace(
        /^([0]+)\/|[0]+$/g, '0'
    ).replace(
        /[^\d\/]|^[\/]*$/g, ''
    ).replace(
        /\/\//g, '/'
    );
}

var splitDate = function($domobj, value) {
    var regExp = /(1[0-2]|0[1-9]|\d)\/(20\d{2}|19\d{2}|0(?!0)\d|[1-9]\d)/;
    var matches = regExp.exec(value);
    $domobj.siblings('input[name$="expiryMonth"]').val(matches[1]);
    $domobj.siblings('input[name$="expiryYear"]').val(matches[2]);
}

$('#expiration-date').on('keyup', function(){
    expiryMask();
});

$('#expiration-date').on('focusout', function(){
    splitDate($(this), $(this).val());
});

</script>
@endSection