<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/icon-logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Text:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-core/11.0.0/css/fabric.min.css"/> --}}
    
    <!-- BEGIN: Vendor CSS-->
    {{-- {{URL::asset('/app-assets/vendors/css/vendors.min.css')}} --}}
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/extensions/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/extensions/nouislider.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/extensions/dragula.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/pickers/daterange/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/maps/leaflet.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/extensions/jquery.rateyo.min.css')}}">
    <!-- END: Vendor CSS-->

    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/plugins/extensions/noui-slider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/core/colors/palette-noui.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/plugins/extensions/drag-and-drop.css')}}"> --}}

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/bootstrap-extended.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="../app-assets/css/colors.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/components.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/dark-layout.min.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/semi-dark-layout.min.css"> --}}
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/dashboard-ecommerce.min.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/widgets.min.css"> --}}
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/css/style-influencer.css')}}">
    <!-- END: Custom CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>

</head>

<body class="vertical-layout 2-columns navbar-sticky footer-static pace-done menu-hide vertical-overlay-menu" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
    <div class="pace-progress-inner"></div>
  </div>
  <div class="pace-activity"></div></div>
  
      <!-- BEGIN: Header-->
      <div class="header-navbar-shadow"></div>
      <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top pt-2">
        <div class="navbar-wrapper">
          <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div id="container-navbar-mobile" class="bookmark-wrapper d-flex align-items-center w-100">
                    <ul class="nav navbar-nav d-none d-sm-block">
                      <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascript:void(0);"><i class="ficon bx bx-menu"></i></a></li>
                    </ul>
                    <ul id="btn-toggle-menu" class="nav navbar-nav d-block d-sm-none">
                      <li class="nav-item mobile-menu d-xl-none mr-auto"><a href="#" ><i class="ficon bx bx-menu"></i></a></li>
                    </ul>
                    <a id="btn-toggle-menu-back" class="mr-50 d-none">
                      <svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-arrow-back m-0">
                        <path d="M25 9.66667H5.552L12.6093 2.60933L10.724 0.723999L0.447998 11L10.724 21.276L12.6093 19.3907L5.552 12.3333H25V9.66667Z" fill="#010D33"></path>
                      </svg>
                    </a>
                    <a id="btn-back-campaigns" class="mr-50 d-none">
                      <svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-arrow-back m-0">
                        <path d="M25 9.66667H5.552L12.6093 2.60933L10.724 0.723999L0.447998 11L10.724 21.276L12.6093 19.3907L5.552 12.3333H25V9.66667Z" fill="#010D33"></path>
                      </svg>
                    </a>
                    <p id="dashboard-header-title" class="title mb-0" style="font-size: 35px;"></p>
                    <ul class="nav navbar-nav ml-auto">
                      @include('layouts.notification-icon')
                    </ul>
                </div>
            </div>
          </div>
        </div>
        <hr class="m-0 mt-auto w-100 d-block d-sm-none" style="height: 2px; background: #033FFF; border-radius: 0px 5px 5px 0px;">
      </nav>
      <!-- END: Header-->

      {{-- @include('layouts.influencer-welcome-modal') --}}
      @include('layouts.influencer-tutorial')
      @include('layouts.menu-influencer')
            
      <!-- BEGIN: Content-->
      <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
          <div class="content-header row">
          </div>
          <div id="dashboard-body" class="content-body">
            @yield('content')
          </div>
        </div>
      </div>

      @include('layouts.notification')
      
      <!-- END: Content-->

      </div>
  
      <!-- BEGIN: Vendor JS-->
      <script src="../app-assets/vendors/js/vendors.min.js"></script>
      <!-- BEGIN Vendor JS-->
  
      <!-- BEGIN: Page Vendor JS-->
      <script src="{{URL::asset('/app-assets/vendors/js/extensions/nouislider.min.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/extensions/dragula.min.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/extensions/swiper.min.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/file-uploaders/dropzone.min.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/maps/leaflet.min.js')}}"></script>
      <script src="{{URL::asset('/app-assets/vendors/js/extensions/jquery.rateyo.min.js')}}"></script>
      
      <!-- END: Page Vendor JS-->

      <!-- BEGIN: Theme JS-->
      <script src="{{URL::asset('/app-assets/js/core/app-menu.min.js')}}"></script>
      <script src="{{URL::asset('/app-assets/js/core/app.min.js')}}"></script>
      {{-- <script src="../app-assets/js/scripts/configs/vertical-menu-light.min.js"></script>
      <script src="../app-assets/js/scripts/components.min.js"></script>
      <script src="../app-assets/js/scripts/footer.min.js"></script>
      <script src="../app-assets/js/scripts/customizer.min.js"></script> --}}
      <!-- END: Theme JS-->

      <script src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js"></script>
      <script src="../assets/js/jquery.validate.min.js"></script>
      <script src="../assets/js/jquery.validate-additional-methods.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

      <!-- BEGIN: Custom JS-->
      <script src="{{URL::asset('/assets/js/scripts.js')}}"></script>
      <script src="{{URL::asset('/assets/js/scripts-influencer.js')}}"></script>
      <!-- END: Custom JS-->
      <!-- END: Body-->

      <script>
        // $('#modal-welcome').modal();
        // $('li.nav-item-influencer.settings a').click();
      </script>
      @yield('view-js')
      @include('layouts.toastr')
  </body>
</html>
@include('layouts.websocket-conn-notifications')