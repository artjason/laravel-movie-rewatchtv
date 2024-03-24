<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ config('app.name') }} </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.ico') }}" />
    @livewireStyles()
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/main.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-white bg-black">

    @include('layouts.nav')
    @yield('content')
    @livewireScripts()
</body>
<footer class="mt-20">
    <p class="mb-5 text-xs text-center xl:text-base md:text-sm lg:text-sm">Connect through our social media accounts: </p>
    <div class="flex justify-center gap-8 mb-5">
        <a href="#"> <img src="{{ asset('images/fb.svg') }}"></a>
        <a href="#"> <img src="{{ asset('images/twitter.svg') }}"></a>
        <a href="#"> <img src="{{ asset('images/linkedin.svg') }}"></a>
        <a href="#"><img src="{{ asset('images/insta.svg') }}"></a>
    </div>
    <p class="text-xs text-center xl:text-sm md:text-sm lg:text-sm">&copy; 2024 RewatchTV</p>
</footer>

</html>
