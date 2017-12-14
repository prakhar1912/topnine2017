<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta property="og:title" content="Top Nine 2017"/>
        <meta property="og:url" content="http://topnine2017.com"/>
        <meta property="og:image" content="http://topnine2017.com/favicon.ico"/>
        <meta property="og:site_name" content="Top Nine 2017"/>
        <meta property="og:description" content="Get your top nine Instagram posts at"/>
        <meta name="description" content="Get your top nine Instagram posts"/>
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
            <div class="links">
                <a href="http://www.facebook.com/sharer.php?u=http://topnine2017.com" style="background-color:#3b5998" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/share?url=http://topnine2017.com&amp;text=Get%20your%20top%20nine%20Instagram%20posts%20for%202017%20at%20&amp;hashtags=TopNine2017" style="background-color: #0084b4" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="https://plus.google.com/share?url=http://topnine2017.com" style="background-color: #d34836" target="_blank"><i class="fa fa-google-plus"></i></a>
            </div>
            <img class="ig-approved" src="{{ asset('images/site_assets/ig_approved.png') }}" />
            <a href="/"><img class="site-logo" src="{{ asset('images/site_assets/topninelogo.png') }}"/></a>
            <a href="https://www.hopperhq.com?utm_source=TopNine2017&utm_medium=poweredbyhopper&utm_
            campaign=logo" target="_blank"><img class="hopper" src="{{ asset('images/site_assets/pbh.png') }}" /></a>
        </header>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-12 col-lg-10 col-lg-offset-1 col-xs-12">
                @yield('content')
                <br>
                <br>
                <br>
            </div>
        </div>

        <footer class="footer">
            <p>
                <a href="/privacy-policy">Privacy Policy</a>
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