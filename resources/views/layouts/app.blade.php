<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="author" content="Britech">
        <title>Backend :: Dashboard</title>
        <link rel="apple-touch-icon" sizes="152x172" href="{{asset('image/logo.png')}}">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('image/logo.png')}}">
        <link rel="shortcut icon" type="image/png" href="{{asset('image/logo.png')}}">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <link href="{{asset('master/app-assets/css/font.css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,400,500,700')}}" rel="stylesheet">
        @include('layouts.css')

        @livewireStyles
        <script defer src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
        @livewireScripts
        @yield('css')
        @stack('css')
    </head>
    <body class="vertical-layout vertical-mmenu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-mmenu" data-col="2-columns">

        @include('layouts.toolbar')

        @include('layouts.sidebar')
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                @yield('content')
            </div>
        </div>

        @include('layouts.js')

        @yield('scripts')
        @stack('scripts')

    </body>
</html>
