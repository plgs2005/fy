@extends('layouts.brand')
@section('content')
<div class="row mt-1 d-flex justify-content-between align-items-baseline mt-2 mb-1">
    <div class="col-xl-12 col-md-4 col-sm-6">
    <p class="red-hat-display" style="font-size: 25px;">Company details</p>
    </div>
</div>

<div class="row">
    <div class="col-xl-2 col-md-4 col-sm-6 d-flex flex-column justify-content-between align-items-center">
        <img class="img-profile rounded-circle" src=" @if ($user->brand_logo)  {{URL::asset("/storage/$user->brand_logo")}}
        @else {{URL::asset('/assets/images/picture-settings.png')}}
        @endif" class="img-profile">
        <form id='foto' method="POST" action="{{ route('brand.logo.update') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" id="brand_logo" name="brand_logo" style="display:none"/>
            @error('brand_logo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="button" id="openImgUpload" class="btn btn-secondary position-relative mt-1"  style="margin-bottom: 1px;">Change logo</button>
        </form>
        <div>
            {{-- <img src="../assets/images/picture-settings.png" class="img-profile">
            <input type="button" class="btn btn-secondary position-relative mt-1" value="Change logo"></input> --}}
        </div>
    </div>
    <div class="col-xl-4 col-md-4 col-sm-6">
        <form method="POST" action="{{ route('brand.settings') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control input-secondary" name="brand_name" placeholder="Company Name" required="required" value="{{$user->brand_name}}">
            </div>
            <button type="submit" class="btn btn-primary position-relative">Save</button>
        </form>
    </div>
</div>
<hr class="my-3">

<div class="row mt-1 d-flex justify-content-between align-items-baseline mt-1 mb-1">
    {{-- Payments --}}
    <div class="col-xl-6 col-md-6 col-sm-12">
        <div>
            <p class="red-hat-display mb-2" style="font-size: 25px;">Payments</p>
        </div>
        <div id="payments-content" class="text-center">
            <ul class="timeline timeline-payment">
                  @if(!empty($payments))
                  @foreach ($payments as $key=>$paymentGroup)
                    <li id="li-timeline-payment-1" class="timeline-item timeline-icon-*color-palette* active pb-2">
                        @php
                          echo paymentTimelineDate($key);
                        @endphp
                        <div class="timeline-content">
                            @foreach ($paymentGroup as $payment)
                            <div class="card text-center mb-2 mr-2">
                                <div class="card-body d-flex">
                                    <div class="pr-2">
                                        @if ($payment['payment_method_details']['card']['brand'] == 'visa')
                                            <img src="../assets/images/icon-visa-b.png" class="img-fluid">
                                        @elseif ($payment['payment_method_details']['card']['brand'] == 'master')
                                            <img src="../assets/images/icon-mastercard.png" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="text-left">
                                        <p class="card-secondary--title mb-0">{{stripeNumFormat($payment['amount'])}}</p>
                                        <a href="#" style="text-decoration: underline;">@if (isset($payment->metadata->campaign_name)) {{$payment->metadata->campaign_name}} @endif</a>
                                        <p class="mb-0 mt-1">@if (isset($payment->metadata->datetime)) {{$payment->metadata->datetime}} @endif</p>
                                        <p class="mb-0">{{ucfirst($payment['payment_method_details']['card']['brand'])}} Card Final {{$payment['payment_method_details']['card']['last4']}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </li>
                  @endforeach
                  @else
                  <div>No payments</div>
                  @endif
              </ul>
        </div>
        <div id="payments-no-content" class="card text-center d-none p-1">
            <div class="card-body p-1">
                <div  class="text-center">
                    <div class="fonticon-wrap">
                        <i class="bx bx-archive" style="font-size: 70px; color: #747E9F;"></i>
                    </div>
                    <p style="font-size: 13px;">You haven't paid for any campaigns yet</p>
                </div>
            </div>
        </div>
    </div>
    {{-- saved credit cards --}}
    <div id="brand-cards" class="col-xl-6 col-md-6 col-sm-12">
        
    </div>
</div>

@endsection

@section('view-js')
<script>
$( document ).ready(function() {
    $('#brand-cards').load('/brand-cards');
});

$.validator.addMethod('filesize', function(value, element, param) {
    var length = ( element.files.length );
    var fileSize = 0;
    if (length > 0) {
        for (var i = 0; i < length; i++) {
            fileSize = element.files[i].size; // get file size
            fileSize = fileSize / 1024; //file size in Kb
            fileSize = fileSize / 1024; //file size in Mb
            if(fileSize > param){
                return false;
            }
        }
        return true;
    }
});

$("#foto").validate({
    ignore: "", //required or validator won't work

    rules: {
        brand_logo: { required: true, extension: "png|jpeg|jpg|bmp", filesize: 10 },
    },
    messages: {
        brand_logo: {
            extension: function() {
                toastr.error('File must be PNG, JPEG, BMP')
            },
            filesize: function() {
                toastr.error('Max filesize 10mb')
            },
        },
    },
    
    invalidHandler: function(event, validator) {
        // 'this' refers to the form
        var errors = validator.numberOfInvalids();
        if (errors) {
            toastr.error('Error', "Error")
        }
    },

    submitHandler: function(form) {
      console.log('handler');
      form.submit();
    },

});

$('#openImgUpload').click(function() {
  $('#brand_logo').trigger('click'); 
});

$('#brand_logo').on('change', function () {
    $('#foto').submit()
});
</script>
@endsection