<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
    {{-- style="background-image: url('images/bglogin.webp');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 100%;" --}}
    >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ str_replace('_', ' ', config('app.name', 'Backoffice')) }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/eki.css') }}">


    {!! ReCaptcha::htmlScriptTagJsApi() !!}

</head>
<body style="    background-color: transparent;">
    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
