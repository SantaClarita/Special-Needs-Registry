<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <title>SNR @yield('title')</title> 

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/latofont.css') }}">
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
    
    <style type="text/css">body {padding-top: 50px;}</style> <!-- Must be before our css but after bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lsidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/rsidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/id.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/heightbootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/panel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/error.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <div id="header" class="row  hidden-print">
        @include('layouts.header')
    </div>
    <div class="container-fluid" id="wrapper">
        <div id="content" class="row">
            <div class="col-md-2 hidden-print">
                @include('layouts.leftsidebar')
            </div>
            <div class="col-md-8" style="margin-top:15px;">
                @yield('content')
            </div>
            <div class="col-md-2 hidden-print" id="rsidebar">
                @include('layouts.rightsidebar')
            </div>  
        </div>
        <div id="footer" class="hidden-print">
            @include('layouts.footer')
        </div>
    </div>
</body>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap-select.js') }}"></script>
    <script type="text/javascript">
        $('.selectpicker').selectpicker();
        @if (count($errors) > 0)
            $('#create-modal').modal('show');
        @endif
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
        @if(session('idPrompt'))
            $('#prompt').modal('show')
        @endif
    </script>
</html>
