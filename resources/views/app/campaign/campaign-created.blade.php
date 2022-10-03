@extends('layouts.newCampaign')
@section('content')
<div class="container">
    <div class="row" id="new-campaign-created">
        <div class="col-xl-12 col-md-6 col-12 text-center">
        <div class="m-3">
            <img src="../assets/images/logo-brand.png" class="img-fluid">
        </div>
        <div class="card">
            <div class="card-body p-5">
            <div class="mb-3 mt-5">
                <img src="../assets/images/icon-check.png" class="img-fluid">
            </div>
            <div>
                <p class="title" style="font-size: 35px">Your campaign has been created!</p>
            </div>
            <div class="m-5">
                <a href="{{ route('brand.campaign.list') }}"> <button type="button" id="btn-go-to-campaigns" class="btn btn-secondary position-relative mt-1" style="margin-bottom: 1px;">Go to campaigns</button> </a>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('view-js')

@endsection