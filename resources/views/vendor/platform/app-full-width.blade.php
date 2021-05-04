<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-controller="layouts--html-load">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','ICPAC') - @yield('description','ICPAC Intranet')</title>
    <meta name="csrf_token" content="{{  csrf_token() }}" id="csrf_token" data-turbolinks-permanent>
    <meta name="auth" content="{{  Auth::check() }}" id="auth" data-turbolinks-permanent>
    @if(file_exists(public_path('/css/orchid/orchid.css')))
        <link rel="stylesheet" type="text/css" href="{{  mix('/css/orchid/orchid.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{  orchid_mix('/css/orchid.css','orchid') }}">
    @endif
    @stack('head')
    <meta name="turbolinks-root" content="{{  Dashboard::prefix() }}">
    <meta name="dashboard-prefix" content="{{  Dashboard::prefix() }}">
    <script src="{{ mix('/js/manifest.js') }}" type="text/javascript"></script>
    <script src="{{ mix('/js/vendor.js') }}" type="text/javascript"></script>
    <script src="{{ mix('/js/orchid.js') }}" type="text/javascript"></script>
    @foreach(Dashboard::getResource('stylesheets') as $stylesheet)
        <link rel="stylesheet" href="{{$stylesheet}}">
    @endforeach
    @stack('stylesheets')
    @foreach(Dashboard::getResource('scripts') as $scripts)
        <script src="{{  $scripts }}" defer type="text/javascript"></script>
    @endforeach
</head>

<body>
<div class="app row m-n" id="app" data-controller="@yield('controller')" @yield('controller-data')>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md col-xl col-xxl-9 bg-white b-l b-r box-shadow-lg no-padder min-vh-100">
                @yield('body-center')
            </div>
        </div>
    </div>
    @include('platform::partials.toast')
</div>
@stack('scripts')
</body>

</html>
