@extends('layouts.app')

@section('content')
 <!--ClickMeter.com page views tracking: pixel1kzqo --> <script type='text/javascript'> var ClickMeter_pixel_url = '//pixel.watch/kzqo'; </script> <script type='text/javascript' id='cmpixelscript' src='//s3.amazonaws.com/scripts-clickmeter-com/js/pixelNew.js'></script> <noscript> <img height='0' width='0' alt='' src='http://pixel.watch/kzqo' /> </noscript>

<div class="container">
    <div class="row justify-content-center row-cols-1 row-cols-md-2">
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <form method="POST" action="{{ url('/conversion-success') }}">
                        @csrf
                        <div class="form-group">
                            <label for="amount">{{ __('Amount') }}</label>
                            <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="" required autocomplete="amount" autofocus>
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">
                            {{ __('Next') }}
                        </button>

                    </form>
                </div>
            </div>
        </div>
         
    </div>
</div>
@endsection
