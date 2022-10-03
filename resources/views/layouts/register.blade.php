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

    <link rel="stylesheet" href="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-core/11.0.0/css/fabric.min.css"/>
    
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
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/css/style-influencer.css')}}">
    <!-- END: Custom CSS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
</head>

<body class=" navbar-sticky footer-static" >
    @yield('content')

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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{URL::asset('/assets/js/scripts-influencer.js')}}"></script>
</body>
</html>