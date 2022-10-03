<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/css/style.css')}}">
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
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                      <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascript:void(0);"><i class="ficon bx bx-menu"></i></a></li>
                    </ul>
                    <p id="dashboard-header-title" class="title mb-0" style="font-size: 35px;">@if(isset($headerTitle)){{$headerTitle}}@endif</p>
                  </div>
              <ul class="nav navbar-nav float-right">
                @include('layouts.notification-icon')
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!-- END: Header-->
  
  
      <!-- BEGIN: Main Menu-->
        @include('layouts.menu')
      <!-- END: Main Menu-->
  
      <!-- BEGIN: Content-->
      <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
          <div class="content-header row">
          </div>
          <div id="dashboard-body" class="content-body"><!-- Dashboard Ecommerce Starts -->
            @yield('content')
          </div>
        </div>
      </div>

      @include('layouts.notification')

      
      <!-- END: Content-->

      </div>
  
      <!-- BEGIN: Vendor JS-->
      <script src="{{URL::asset('/app-assets/vendors/js/vendors.min.js')}}"></script>
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
      {{-- <script src="../app-assets/js/scripts/configs/vertical-menu-light.min.js"></script> --}}
      {{-- <script src="../app-assets/js/scripts/components.min.js"></script> --}}
      {{-- <script src="../app-assets/js/scripts/footer.min.js"></script> --}}
      {{-- <script src="../app-assets/js/scripts/customizer.min.js"></script> --}}
      <!-- END: Theme JS-->

      <script src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js"></script>
      <script src="../assets/js/jquery.validate.min.js"></script>
      <script src="../assets/js/jquery.validate-additional-methods.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

      <!-- BEGIN: Custom JS-->
      <script src="{{URL::asset('/assets/js/scripts.js')}}"></script>
      <script src="{{URL::asset('/assets/js/scripts-brand.js')}}"></script>
      <!-- END: Custom JS-->
      <!-- END: Body-->
      @yield('view-js')
      @include('layouts.toastr')
      
  </body>
</html>
@include('layouts.websocket-conn-notifications')
<script>  
  $('#li-timeline-new-campaign-0').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-0" class="badge-circle badge-circle-lg badge-circle-primary mx-auto my-0"><img src="../assets/images/icon-flag.png" class="img-fluid"></div></div>');
  $('#li-timeline-new-campaign-1').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-1" class="badge-circle badge-circle-lg badge-circle-primary mx-auto my-0">1</div></div>');
  $('#li-timeline-new-campaign-2').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-2" class="badge-circle badge-circle-lg badge-circle-secondary mx-auto my-0">2</div></div>');
  $('#li-timeline-new-campaign-3').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-3" class="badge-circle badge-circle-lg badge-circle-secondary mx-auto my-0">3</div></div>');
  $('#li-timeline-new-campaign-4').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-4" class="badge-circle badge-circle-lg badge-circle-secondary mx-auto my-0">4</div></div>');
  $('#li-timeline-new-campaign-5').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-5" class="badge-circle badge-circle-lg badge-circle-secondary mx-auto my-0">5</div></div>');
  $('.li-timeline-review-new-campaign').prepend('<div class="marker-timeline-review-new-campaign"><div class="badge-circle badge-circle-lg badge-circle-check mx-auto my-0"><i class="bx bx-check font-medium-5"></i></div></div>');
</script>