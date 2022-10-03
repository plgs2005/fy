<div class="d-flex justify-content-between">
    <div class="align-self-center">
        <p class="red-hat-display m-0" style="font-size: 25px;">Saved credit cards</p>
    </div>
    <div>
        <input type="button" class="btn btn-secondary position-relative btn-add-new-credit-card" onclick="addNewCreditCard()" value="Add new credit card"></input>
    </div>
</div>
<div class="card mt-1 ">
    <div class="card-body p-1">
        <div id="retorno-ajax">

        </div>
        <div id="new-card" class="d-none">
            <form id='card-form' method="POST" action="{{ route('card.store') }}">
                <div class="d-flex align-items-center">
                    <div class="w-50">
                        <img class="img-fluid" src="../assets/images/card-credit.png">
                    </div>
                    <div class="w-50">
                        <div class="form-group mb-2">
                            <label class="title" style="font-size: 15px;">Credit card</label>
                            <input type="text" class="form-control" name="card_number" id="credit-card" placeholder="Credit card number" required="required" maxlength="19" >
                        </div>
                        <div class="form-group mb-2">
                            <label class="title" style="font-size: 15px;">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name on card" required="required" maxlength="50">
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
                <button type="submit" class="btn btn-primary position-relative w-100">Save card</button>
            </form>
        </div>
        
        <div id="cards-content">
            @if ($cards->count())
            @foreach ($cards as $card)
            <div class="d-flex align-items-center mb-1">
                <div id="card-{{$loop->iteration}}" class="card-bank credit-card-1 mr-2" onclick="selectCreditCard('#card-{{$loop->iteration}}')">
                    <div id="card-1-selected" class="card-bank-selected title d-none">Selected</div>
                    <div class="d-flex justify-content-between align-items-center p-2">
                        <div>
                            @if ($card['card']['brand'] == 'visa')
                                <img src="../assets/images/icon-visa.png" class="img-fluid">
                            @elseif ($card['card']['brand'] == 'master')
                                <img src="../assets/images/icon-mastercard.png" class="img-fluid">
                            @endif
                        </div>
                        <div style="width: 60%;">
                            <p style="font-size: 20px; margin-bottom: 10px;">Final <span class="pl-1">{{$card['card']['last4']}}</span></p>
                            <div class="d-flex justify-content-between" style="font-size: 16px;">
                                <div>{{$card['card']['exp_month']}}/{{$card['card']['exp_year']}}</div>
                                <div>xxx</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="card-{{$loop->iteration}}-column-action" class="d-none card-column-action">
                    {{-- <div>
                        <button type="button" class="btn btn-edit position-relative w-100" style="margin-bottom: 8px;">edit</button>
                    </div> --}}
                    <div>
                        <button type="button" class="btn btn-exclude position-relative w-100" card_id="{{$card['id']}}">exclude</button>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div id="cards-no-content" class="text-center">
                <div>
                    <div class="fonticon-wrap">
                        <i class="bx bx-archive" style="font-size: 70px; color: #747E9F;"></i>
                    </div>
                    <p style="font-size: 13px;">No credit cards added</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<script type="text/javascript">

var frm = $('#card-form');
frm.submit(function (e) {

    e.preventDefault();

    $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: frm.serialize(),
        success: function (data) {
            if(data[0].status == 'success'){
                toastr.success("Card saved! ", "Success");
            }else if(data[0].status == 'error'){
                toastr.error(data[0].message, "Error");
            }
            // console.log('Submission was successful.');
            // console.log(data);
            // $("#retorno-ajax").html(data);
            $('#brand-cards').load('/brand-cards');
        },
        error: function (data) {
            toastr.error("An error occured! ", "Error");
        },
    });
    
});

$('.btn-exclude').click(function(){
    console.log($(this).attr('card_id'));
    $.ajax({
        type: 'POST',
        url: '/delete-card',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'card_id': $(this).attr('card_id')},
        success: function (data) {
            if(data[0].status == 'success'){
                toastr.success("Card deleted! ", "Success");
            }else if(data[0].status == 'error'){
                toastr.error("An error occured! ", "Error");
            }
            // console.log('Submission was successful.');
            // console.log(data);
            // $("#retorno-ajax").html(data);
            $('#brand-cards').load('/brand-cards');
        },
        error: function (data) {
            toastr.error(data[0].message, "Error");
        },
    });
});

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

function selectCreditCard(divCard) {
  if ($('> div', divCard).hasClass('d-none')) {
    $('> div', divCard).removeClass('d-none');
    $('+ div.card-column-action', divCard).removeClass('d-none');
  } else {
    $('> div', divCard).addClass('d-none');
    $('+ div.card-column-action', divCard).addClass('d-none');
  }
}

</script>