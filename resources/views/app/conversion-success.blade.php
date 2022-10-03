@extends('layouts.app')

@section('content')
<script>
    window.setTimeout(function() {
        window.location = 'http://influencify';
      }, 5000);
</script>
<img height='1' width='1' border='0' src='//www.clickmeter.com/conversion.aspx?id=1B1A0254FACA4021B27C50299B3B1E02&val=0.00&param=empty&com=0.00&comperc=0.00&pixel=true' />
<div class="container">
    <div class="row justify-content-center row-cols-1 row-cols-md-2">
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    Conversion succesfull
                </div>
            </div>
        </div>
         
    </div>
</div>
@endsection
