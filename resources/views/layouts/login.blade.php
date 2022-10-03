<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if (isset($register)) Influencify - Register 
        @endif
        @if (isset($login)) Influencify - Login 
        @endif
    </title>

    <link rel="apple-touch-icon" href="{{URL::asset('/app-assets/images/ico/apple-icon-120.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('/assets/images/icon-logo.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Text:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    
    <!-- Vendor files -->
    <script src="{{URL::asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>

    <!-- Template files -->
    {{-- <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/plugins/forms/validation/form-validation.css')}}"> --}}

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/colors.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/components.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/themes/dark-layout.min.css')}}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/themes/semi-dark-layout.min.css')}}"> --}}
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/pages/authentication.css')}}"> --}}
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Custom JS-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{URL::asset('/assets/js/scripts.js')}}"></script>
    <!-- END: Custom JS-->

    <style type="text/css">
    .custom-switch .custom-control-label::after {
        width: 20px;
        height: 20px;
        background-color: #FFF !important;
        top: calc(0px + 7px);
        left: calc(-43px + 9px);
    }
    </style>
</head>
<body>
    <div class="mb-0 h-100 background-main">
        <div class="row m-0 h-100">
            <!-- register section left -->
            <div class="col-md-6 col-12 px-0 d-flex justify-content-between flex-column">
                <div class="login-header d-flex justify-content-between px-3 align-items-baseline">
                    <div class="login-header--logo">
                        <a class="navbar-brand" href="{{ url('/') }}"><img class="img-fluid" src="{{URL::asset('/assets/images/logo_horizontal_influencify_02.svg')}}"  alt="logo brand" style="width: 268px; height: 124px;"></a>
                    </div>
                    @if (isset($register) OR isset($login))
                    <div id="div-have-account" class="login-header--button d-flex align-items-baseline">
                        
                        @if (isset($register))
                            <p class="pr-1">Have an account?</p>
                        @else
                            <p class="pr-1">Don't have an account?</p>
                        @endif
                            @if (isset($register))
                                <a class="btn btn-secondary" style="font-size: 13px;"  role="button" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @else
                                <a class="btn btn-secondary" style="font-size: 13px;"  role="button" href="{{ route('registerBrand') }}">Register</a>
                            @endif
                    </div>
                    @endif
                </div>

                @yield('content')

                <div class="text-center mb-2">
                    <p>2021 Influencify® - All Rights Reserved</p>
                </div>
            </div>
            <!-- image section right -->
            <div id="brand-login-div-right" class="col-md-6 d-md-block d-none p-0"
            @if (isset($login) or isset($register))
                style="background-image: url('{{URL::asset('assets/images/background-login-brand.png')}}');" 
            @endif
            @if (isset($email))
                style="background-image: url('{{URL::asset('assets/images/background-login2-brand.png')}}');" 
            @endif
            @if (isset($completeProfile))
                style="background-image: url('{{URL::asset('assets/images/background-login3-brand.png')}}');" 
            @endif ></div>
        </div>
    </div>
    @yield('view-js')
    @include('layouts.toastr');
</body>
</html>