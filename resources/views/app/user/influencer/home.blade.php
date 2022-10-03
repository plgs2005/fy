@extends('layouts.influencer')

@section('content')
<section id="dashboard-ecommerce">
    <div id="div-home-dashboard-influencer" class="text-center m-auto">
        <div class="fonticon-wrap">
            <img src="../assets/images/icon-smile.png" class="img-fluid">
        </div>
        <p class="text-center title pt-2 pb-2 mb-0" style="font-size: 35px;">Welcome, {{$user->name}}</p>
        <input type="button" id="btn-show-hide-tutorial" class="btn btn-secondary position-relative" style="height: 31px; width: 176px; white-space: nowrap;  font-size: 13px; padding: 0px;" value="Hide tutorial">
          
      </input>
    </div>
</section>
@endsection