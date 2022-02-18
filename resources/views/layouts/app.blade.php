@include('inc.function')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page_name }}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.png')}}"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    @include('inc.styles')
    @yield('additional_css')
</head>
{{-- <body {{ ($has_scrollspy) ? scrollspy($scrollspy_offset) : '' }} class=" {{ ($page_name === 'alt_menu') ? 'alt-menu' : '' }} {{ ($page_name === 'error404') ? 'error404 text-center' : '' }} {{ ($page_name === 'error500') ? 'error500 text-center' : '' }} {{ ($page_name === 'error503') ? 'error503 text-center' : '' }} {{ ($page_name === 'maintenence') ? 'maintanence text-center' : '' }}"> --}}
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    @include('inc.navbar')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('inc.sidebar')

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">

            @yield('content')

            @include('inc.footer')
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    @include('inc.scripts')
    @yield('additional_js')

</body>
</html>
