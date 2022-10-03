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
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/plugins/extensions/drag-and-drop.css')}}">

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
    @role('Brand')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/css/style.css')}}">
    @endrole
    @role('Influencer')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/css/style-influencer.css')}}">
    @endrole
    <!-- END: Custom CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>

    <style>
      .header-navbar {
        left:0px !important;
      }
      nav .title {
        font-size: 35px !important;
      }
      .close-icon-campaign:hover {
        cursor: pointer;
      }
      .cursor-pointer:hover {
        cursor: pointer;
      }
    </style>
</head>

<body class=" navbar-sticky footer-static" >
      <!-- BEGIN: Header-->
      @if (isset($campaign))
      <nav class="header-navbar navbar fixed-top">
        <span class="navbar-brand ml-2 title" href="#"> @if(isset($campaign->id)) Edit @else Create @endif Campaign</span>
        <div class="mr-1">
        <span class="title close-icon-campaign"  data-toggle="modal" data-target="#exampleModal" >&times;</span>
        </div>
      </nav>
      @endif
      <!-- END: Header-->
  
      @yield('content')
         
      <!-- Start Modal New Upgrade -->

<div class="modal fade" id="modal-upgrade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-body text-center">
              <div>
                  <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close" style="margin-top: -75px; margin-right: -20px; background-color: transparent!important;">
                      <span aria-hidden="true" class="title" style="color: #FFFFFF;font-size: 32px;font-weight: normal;">×</span>
                  </button>
              </div>
              <div>
                <img src="../assets/images/influencify-logo-icon.svg" class="img-fluid mb-1" style="width: 50px; height:50px">
                  <p class="title" style="font-size: 30px; font-weight: 400; margin-bottom:35px;">Upgrade to PRO</p>
              </div>
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="margin-bottom: 10px;">
                  <label class="btn btn-toggle-update">
                    <input type="radio" name="options" id="toggle-update-monthly" checked="">
                    <div>monthly</div> 
                  </label>
                  <label class="btn btn-toggle-update active">
                    <input type="radio" name="options" id="toggle-update-annually">
                    <div>annually</div> 
                  </label>
              </div>
              <p class="title " style="font-size: 18px; font-weight: 500; margin-bottom:35px;">Pay annually & save up to 33%</p>
              <p id="cost" class="title text-center" style="font-size: 36px; font-weight: 500; color:#033FFF; margin-bottom:35px">$89 / month</p>
              <div class="card card-body text-left mb-2">
                  <div class="d-flex justify-content-left">
                      <i class="bx bx-check primary pr-1" style="font-size: 18px;"></i>
                      <p>3 gift-only campaigns monthly, up to 100,000 impressions each <i class="bx bx-info-circle" data-toggle="tooltip" data-placement="auto" title="Each gift-only campaign allows for up to 100,000 impressions. For gift-only campaigns we cannot garantee a minimum of impressions, as influencers will have to accept the product to promote the brand. Gift-only campaigns will always be distributed to micro and mid-tier influencers and that distribution will depend on the intrinsic value of your product. the more valuable your product is, the more it will be distributed to mid-tier influencers. Only paid campaigns can be distributed to large-size influencers"></i></p>
                  </div>
                  <div class="d-flex justify-content-left">
                      <i class="bx bx-check primary pr-1" style="font-size: 18px;"></i>
                      <p>Manually select suggested influencers <i class="bx bx-info-circle" data-toggle="tooltip" data-placement="auto" title="We will show you 4x times the number of influencers you will need. Example: if our system determines you'll need 2 influencers, we'll show you 8 influencers for you to choose from. You'll be able to see Influencers' handles and stats"></i></p>
                  </div>
                  <div class="d-flex justify-content-left">
                      <i class="bx bx-check primary pr-1" style="font-size: 18px;"></i>
                      <p>Campaign analytics broken down for each selected influencer <i class="bx bx-info-circle" data-placement="auto" data-toggle="tooltip" title="You'll be able to see how each influencer performed in your campaign instead of aggregate metrics"></i></p>
                  </div>
                  <div class="d-flex justify-content-left">
                      <i class="bx bx-check primary pr-1" style="font-size: 18px;"></i>
                      <p>User permission levels <i class="bx bx-info-circle" data-toggle="tooltip" data-placement="auto" title="Choose exactly what each of your users can do on your dashboard. Define roles such as account owner, manager, marketer etc"></i></p>
                  </div>
                  <a href="{{route('subscribe')}}" class="btn btn-primary font-weight-normal red-hat-display" style="font-weight: 900 !important; font-size: 20px; color: #FFFFFF !important; margin-bottom: -50px;">Upgrade to PRO</a>
              </div> 
          </div>
      </div>
  </div>
</div>

<!-- End Modal New Upgrade -->
      
      <!-- END: Content-->

  
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
      <script src="{{URL::asset('/assets/js/jquery.validate.min.js')}}"></script>
      <script src="{{URL::asset('/assets/js/jquery.validate-additional-methods.min.js')}}"></script>

      <!-- BEGIN: Custom JS-->
      <script src="{{URL::asset('/assets/js/scripts.js')}}"></script>
      @role('Brand')
      <script src="{{URL::asset('/assets/js/scripts-brand.js')}}"></script>
      @endrole
      @role('Influencer')
      <script src="{{URL::asset('/assets/js/scripts-influencer.js')}}"></script>
      @endrole

      <script src="https://js.stripe.com/v3/"></script>
      {{-- <script src="../assets/js/jquery.tokeninput.js"></script> --}}
      <!-- END: Custom JS-->
      <!-- END: Body-->
      @yield('view-js')
      @include('layouts.toastr')
  </body>
</html>

<script>
  // configureMapAnalytics(mapidmain);
  $('#li-timeline-new-campaign-0').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-0" class="badge-circle badge-circle-lg badge-circle-primary mx-auto my-0"><img src="../assets/images/icon-flag.png" class="img-fluid"></div></div>');
  $('#li-timeline-new-campaign-1').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-1" class="badge-circle badge-circle-lg badge-circle-primary mx-auto my-0">1</div></div>');
  $('#li-timeline-new-campaign-2').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-2" class="badge-circle badge-circle-lg badge-circle-secondary mx-auto my-0">2</div></div>');
  $('#li-timeline-new-campaign-3').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-3" class="badge-circle badge-circle-lg badge-circle-secondary mx-auto my-0">3</div></div>');
  $('#li-timeline-new-campaign-4').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-4" class="badge-circle badge-circle-lg badge-circle-secondary mx-auto my-0">4</div></div>');
  $('#li-timeline-new-campaign-5').prepend('<div class="marker-timeline-new-campaign"><div id="marker-timeline-new-campaign-5" class="badge-circle badge-circle-lg badge-circle-secondary mx-auto my-0">5</div></div>');

  $('.li-timeline-review-new-campaign').prepend('<div class="marker-timeline-review-new-campaign"><div class="badge-circle badge-circle-lg badge-circle-check mx-auto my-0"><i class="bx bx-check font-medium-5"></i></div></div>');

  $("#toggle-update-monthly").click(function(){
      $('#cost').html('$89 / month');
  });
  $("#toggle-update-annually").click(function(){
      $('#cost').html('$59 / month');
  });
</script>