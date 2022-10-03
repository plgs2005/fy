@extends('layouts.brand')

@section('content')
<section id="dashboard-ecommerce">
    <div id="div-welcome" class="text-center mx-auto w-40">
        <div class="fonticon-wrap">
            <img src="../assets/images/icon-smile.png" class="img-fluid">
        </div>
        <p class="text-center title pt-2 pb-2 mb-0" style="font-size: 35px;">Welcome, {{$user->name}}</p>
    </div>
    <div class="row mt-3 d-flex justify-content-center">
        <!-- Greetings Content Starts -->
        <div class="col-xl-4 col-md-6 col-12 dashboard-greetings">
            <div class="card">
                <div class="card-header">
                    <p class="title">1. Upload your company logo</p>
                    
                </div>
                <div class="card-body pt-0 pb-0 pr-0">
                    <p class="mb-0">This will help influencers identify your brand</p>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="dashboard-content-left pb-2">
                            <input type="button" class="btn btn-primary" value="Upload logo"></input>
                        </div>
                        <div class="dashboard-content-right">
                            <img src="../assets/images/home-img-block1.png" class="img-fluid w-100" style="max-width: 140px; max-height: 110px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-12 dashboard-greetings">
            <div class="card">
                <div class="card-header">
                    <p class="title">2. Create a Campaign</p>
                    
                </div>
                <div class="card-body pt-0 pb-0 pr-0">
                    <p class="mb-0">Let the games begin! Start reaching new clients now.</p>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="dashboard-content-left pb-2">
                            <input type="button" class="btn btn-primary" style="min-width: 220px" value="Create my first campaign"></input>
                        </div>
                        <div class="dashboard-content-right">
                            <img src="../assets/images/home-img-block2.png" class="img-fluid w-100" style="max-width: 140px; max-height: 110px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Dashboard Ecommerce ends -->
@endsection