<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Showcase</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <!-- Navigation -->
    <div class="container p-0" id="nav">
        <a href="{{ route('homepage') }}">
            <div class="logo">
                <img src="{{ asset('images/hr_logo.svg') }}" alt="">
                <h3 class="white-text mt-2">CREATIVE MEDIA AND GAME TECHNOLOGIES</h3>
            </div>
        </a>
        <div class="spacer"></div>
        <div class="login">
            @guest
                <a href="{{ route('login') }}"><span class="white-text">LOG IN</span></a>
            @else
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();
                {{ __('Logout') }}"><span class="white-text">LOG OUT</span></a>
            @endguest
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    <!-- ./Navigation -->

    <section class="banner-bg"
             style="background-image: url('https://cmgt.hr.nl:8000/public/uploads/83d1ad2a-86d7-4963-8ca6-d907929dce1e.png');">
        <svg viewBox="0 0 1000 70" class="poly" width="1000vw" height="70px" preserveAspectRatio="none">
            <polygon points="{{ rand(100, 900) }} 0 1000 70 0 70" class="red-fill"></polygon>
        </svg>
        <div class="banner">
            <h1>MEMES</h1>
            <button>Wijze woorden van Leonardo</button>
        </div>
    </section>
    <section class="main-bg">
        <main>
            <p class="mt-3 mb-3">Welkom bij Creative Media and Game Technologies. Op deze website vind je een selectie van de beste memes
                en grappen over het studeren bij CMGT in Rotterdam.</p>
            <h3>Top memes</h3>
            <p class="mt-3 mb-3">Memes in de spotlight</p>
            <section class="spotlight-bg">
                @yield('content')
            </section>
            <p>Bekijk hier alle uigelichte memes</p>
            <p>Of zoek in alle memes via tags:</p>
        </main>
    </section>
    <svg width="1000px" height="70px" viewBox="0 0 1000 70" preserveAspectRatio="none" class="poly bg-red">
        <polygon points="0 0 {{ rand(200, 850) }} 30 1000 0 1000 70 0 70" class="light-fill"></polygon>
    </svg>
</div>
</body>
</html>
