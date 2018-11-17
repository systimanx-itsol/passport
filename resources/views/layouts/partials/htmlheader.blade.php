<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/images/favicon.png') }}"/>
    @if(Auth::check() && Auth::user()->user_type == "A")
    <title>  @yield('htmlheader_title', 'Admin') </title>
    @elseif(Auth::check() && Auth::user()->user_type == "U")
    <title>  @yield('htmlheader_title', 'User') </title>
    @endif
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('/css/Admin.min.css?v=1.3') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->   
    <link href="{{ asset('/css/skins/custom.css?v=2.0') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css') }}">    
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel='stylesheet prefetch' href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">   
    <link rel="stylesheet" type="text/css" href="<?php echo asset('css/buttons.dataTables.min.css'); ?>">
    
    <script>
        var app_url =  '{{ url('') }}'; 
    </script>

    <!-- jQuery 2.1.4 --> 
    <script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script> 
    <script src="{{ asset('js/jquery.validate.js') }}"></script>     
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/jquery.treegrid.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery.treegrid.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.treegrid.bootstrap3.js') }}"></script>
    
</head>
