<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>2017 Top Nine</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="primary-container">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
        <header class="header">
            <img class="site-logo" src="{{ asset('images/site_assets/topninelogo.png') }}"/>
            <img class="right" src="{{ asset('images/site_assets/pbh.png') }}"/>
        </header>
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12 col-lg-6 col-lg-offset-3 col-xs-12">
                @yield('content')
                <br>
                <br>
                <br>
            </div>
        </div>

        <footer class="footer">
            <p>
                <a href="#">Privacy Policy</a>
            </p>
        </footer>

        <script src="{{ asset('js/app.js') }}"></script>
        @if(Session::has('message'))
            <script>
                toastr.error("{{ Session::get('message') }}");
            </script>
        @endif 
    </body>
</html>