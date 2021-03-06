<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ClearSCV - Opps!</title>

        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/latofont.css') }}">
        
        <!-- Styles -->
        <style type="text/css">body {padding-top: 50px;}</style> <!-- Must be before our css but after bootstrap css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        
        <style>
            body {
                font-family: 'Open Sans', Arial, sans-serif;
                font-size: 12px;
                font-weight: 500;
                overflow-y: scroll;
            }
            h1 {
                margin: 0;
                padding:0;
                width:100%;
                color:#B0BEC5;
                font-weight: 100;
                font-family:'Lato';
            }
            .fa-btn {
                margin-right: 6px;
            }
            .content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        </style>
        @include('layouts.header')
    </head>
    <body>
        <div class="container">
            <div class="content text-center">
                <h1>{{ $exception->getMessage() }} Contact <a href="mailto:{{config('app.adminEmail')}}">{{config('app.adminEmail')}}</a> and notify him/her of this action</h1>
            </div>
        </div>     
    </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</html>

