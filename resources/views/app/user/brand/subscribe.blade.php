@extends('layouts.brand')
@section('content')

<div class="d-flex justify-content-center pt-5">
<div>
    @if($subscription and $subscription->status == 'active')
    <div class="card">
        <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-center">
                <img src="../assets/images/influencify-logo-icon.svg" class="img-fluid mb-1" style="width: 50px; height:50px">
            </div>
            <div class="d-flex justify-content-center flex-column">
                <p class="title text-center" style="font-size: 30px; font-weight: 400;">PRO plan active!</p>
                <p style="font-size: 22px; font-weight: 300;">Subscribed since: {{dateFormat($subscription->created, 'M j Y')}}</p>
                <p style="font-size: 22px; font-weight: 300;">Type: {{$subscription->plan->interval == 'month' ? 'Monthly plan' : 'Annual plan'}}</p>
                @if($subscription->cancel_at_period_end)
                    <p style="font-size: 22px; font-weight: 300;">Your subscription will be deactivated at the next billing date.</p>
                    <p style="font-size: 22px; font-weight: 300;">Next billing date: {{dateFormat($subscription->current_period_end, 'M j Y')}}</p>
                @else
                    <p style="font-size: 22px; font-weight: 300;">Next charge: {{dateFormat($subscription->current_period_end, 'M j Y')}}</p>
                    <p style="font-size: 22px; font-weight: 300;">Amount: {{stripeNumFormat($subscription->plan->amount_decimal)}}</p>
                    <form method="POST" action="{{ route('subscribe.cancel') }}">
                        @csrf
                    <p class="d-flex justify-content-center"><button type="submit" class="btn btn-primary font-weight-normal red-hat-display w-10" style="font-weight: 900 !important; font-size: 20px; color: #FFFFFF !important; margin-bottom: -50px;">Cancel subscription</button></p>
                    </form>
                @endif

            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-center">
                <img src="../assets/images/influencify-logo-icon.svg" class="img-fluid mb-1" style="width: 50px; height:50px">
            </div>
            <div class="d-flex justify-content-center">
                <p class="title" style="font-size: 30px; font-weight: 400; margin-bottom:35px;">Upgrade to PRO</p>
            </div>
            <div class="btn-group btn-group-toggle mb-1" data-toggle="buttons">
                <label class="btn btn-toggle-update">
                <input type="radio" name="options" id="toggle-update-monthly">
                <div>monthly</div> 
                </label>
                <label class="btn btn-toggle-update active">
                <input type="radio" name="options" id="toggle-update-annually" checked="">
                <div>annually</div> 
                </label>
            </div>
            <p class="title text-center" style="font-size: 18px; font-weight: 400; margin-bottom:35px;">Pay annually & save up to 33%</p>
            <p id="cost" class="title text-center" style="font-size: 36px; font-weight: 400; color:#033FFF; margin-bottom:35px"> / month</p>
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-left">
                    <i class="bx bx-check primary pr-1" style="font-size: 18px;"></i>
                    <p>3 gift-only campaigns monthly, up to 100,000 impressions each <i class="bx bx-info-circle" data-toggle="tooltip" data-placement="auto" title="Each gift-only campaign allows for up to 100,000 impressions. For gift-only campaigns we cannot garantee a minimum of impressions, as influencers will have to accept the product to promote the brand. Gift-only campaigns will always be distributed to micro and mid-tier influencers and that distribution will depend on the intrinsic value of your product. the more valuable your product is, the more it will be distributed to mid-tier influencers. Only paid campaigns can be distributed to large-size influencers"></i></p>
                </div>
                <div class="d-flex justify-content-left">
                    <i class="bx bx-check primary pr-1" style="font-size: 18px;"></i>
                    <p>Manually select suggested influencers <i class="bx bx-info-circle" data-toggle="tooltip" data-placement="auto" title="We will show you 4x times the number of influencers you will need. Example: if our system determines you'll need 2 influencers, we'll show you 8 influencers for you to choose from. You'll be able to see Influencers' handles and stats"></i></p>
                </div>
                <div class="d-flex justify-content-left">
                    <i class="bx bx-check primary pr-1" style="font-size: 18px;"></i>
                    <p>Campaign analytics broken down for each selected influencer <i class="bx bx-info-circle" data-placement="auto" data-toggle="tooltip" title="You'll be able to see how each influencer performed in your campaign instead of aggregate metrics"></i></p>
                </div>
                <div class="d-flex justify-content-left">
                    <i class="bx bx-check primary pr-1" style="font-size: 18px;"></i>
                    <p>User permission levels <i class="bx bx-info-circle" data-toggle="tooltip" data-placement="auto" title="Choose exactly what each of your users can do on your dashboard. Define roles such as account owner, manager, marketer etc"></i></p>
                </div>
                {{-- <button type="button" class="btn btn-primary font-weight-normal red-hat-display" style="font-weight: 900 !important; font-size: 20px; color: #FFFFFF !important; margin-bottom: -50px;">Upgrade to Pro</button> --}}
            </div>
        </div>
    </div>

    <div class="card mt-1">
        <div class="card-body p-1">
            <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
                <p class="title mb-0" id="total-cost" style="font-size: 25px; font-weight: 400;">Total cost: </p>
            </div>
            <div>
                <input type="button" class="btn btn-secondary position-relative btn-add-new-credit-card" onclick="addNewCreditCard('#new-campaign-payment')" value="Add new credit card"></input>
            </div>
            </div>
            <div id="new-card" class="d-none">
                <form id='card-form' method="POST" action="{{ route('subscribe.store') }}">
                    @csrf
                    <input type="hidden" class="plan" name="plan">
                    <div class="d-flex align-items-center">
                        <div>
                            <div>
                                <img class="img-fluid" src="../assets/images/card-credit.png">
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
                    <button type="submit" class="btn btn-primary font-weight-normal red-hat-display w-100" style="font-weight: 900 !important; font-size: 20px; color: #FFFFFF !important; margin-bottom: -50px;">Pay & Upgrade to PRO</button>
                </form>
            </div>

            @if ($cards and $cards->count())
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
                <form id='card-form' method="POST" action="{{ route('subscribe.store') }}">
                    @csrf
                    <input type="hidden" class="plan" name="plan">
                    <input type="hidden" id="card_id" name="card_id">
                    <button type="submit" class="btn btn-primary font-weight-normal red-hat-display w-100" style="font-weight: 700 !important; font-size: 20px; color: #FFFFFF !important; margin-bottom: -50px;">Pay & Upgrade to PRO</button>
                </form>
            </div>
            
            @endif
        </div>
    </div>
    @endif
</div>
</div>

@endsection

@section('view-js')
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

function addNewCreditCard(divCard) {
  if ($(' #new-card').hasClass('d-none')) {
      $(' #new-card').removeClass('d-none');
      $(' #cards-no-content').addClass('d-none');
      $(' #cards-content').addClass('d-none');
      $(' .btn-add-new-credit-card')[0].value = 'Use existing cards';
  } else {
      $(' #new-card').addClass('d-none');
      $(' #cards-no-content').addClass('d-none');
      $(' #cards-content').removeClass('d-none');
      $(' .btn-add-new-credit-card')[0].value = 'Add new credit card';
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

$("#toggle-update-monthly").click(function(){
    $('#cost').html('$89 / month');
    $('#total-cost').html('Total cost: $89.00');
    $('.plan').val('monthly');
});
$("#toggle-update-annually").click(function(){
    $('#cost').html('$59 / month');
    $('#total-cost').html('Total cost: $708.00');
    $('.plan').val('anual');
});

$("#toggle-update-annually").click();

$(".bx-info-circle").click(function(){
    $(this).tooltip('toggle');
});

</script>
@endSection