<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ISO Aurinka</title>

    <link rel="icon" href="{{asset('/images/laravel-icon.png')}}">

    <!--
    <link href="{{ asset('/css/app.css')}}" rel="stylesheet">
    -->

    <link href="{{ asset('/css/themes/' .(App\Profile::loginProfile()->theme).'/bootstrap.css') }}"
          rel="stylesheet" >
    <link href="{{ asset('/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('/js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>
<div class="__container" style="margin-left: 1%;margin-right: 1%;margin-top: 0.5%;">
    @include('partials.nav')
    <div id="top"></div>
    @yield('headings')
    @yield('breadcrumbs')
    <div id="top"/>
    @include('partials.messages')
    @include('flash::message')
    @yield('content')
    @yield('footer')
</div>
<!-- Scripts -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
@yield('scripts')

</body>
</html>
