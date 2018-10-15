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
                <img src="https://cmgt.hr.nl/./images/hr_logo.svg " alt="">
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
        <svg viewBox="0 0 1000 70" width="1000vw" height="70px" preserveAspectRatio="none" class="poly">
            <polygon points="{{ rand(200, 900) }} 0 1000 70 0 70"
                     class="@if(isset($header)) {{ $header . '-fill' }} @else {{ 'white-fill' }} @endif"></polygon>
        </svg>
        <div class="banner">
            <h1>MEMES</h1>
            <button>Wijze woorden van Leonardo</button>
        </div>
    </section>
    @yield('content')
    <section id="lower-half">
        <div class="removespace">
            <svg width="1000px" height="70px" viewbox="0 0 1000 70" preserveAspectRatio="none" class="bg">
                <polygon id="svgtriangle" points="183 0 1000 70 0 70" class="medium"></polygon>
            </svg>
        </div>
        <section class="main-bg">
            <div class="main">
                <h3>Creative Media and Game Technologies</h3>
                <div class="item"><a href="https://cmgt.hr.nl/#/information/about">Studeren bij CMGT</a></div>
                <div class="item"><a href="https://cmgt.hr.nl/#/information/students">Studenten over CMGT</a></div>
                <div class="item"><a href="">Curriculum</a></div>
                <div class="item"><a href="https://cmgt.hr.nl/#/home">CMGT Showcase</a></div>
                <div class="item"><a href="https://cmgt.hr.nl/#/information/manifesto">Manifesto</a></div>
                <div class="item"><a href="">Alumni</a></div>
                <div class="item"><a href="">Instagram</a></div>
                <div class="item"><a href="{{ route('upload') }}">Upload meme</a></div>
            </div>
            <div class="verticalspacer">
            </div>
            <section class="footer-bg dark">
                <svg width="1000px" height="70px" viewBox="0 0 1000 70" preserveAspectRatio="none" class="bg-medium">
                    <polygon id="svgtriangle" points="0 0 680 30 1000 0 1000 70 0 70" class="dark"></polygon>
                </svg>
                <div class="footer links">
                    <div class="item"><a href="https://cle.cmgt.hr.nl">CLEVER</a></div>
                    <div class="item"><a href="https://hint.hr.nl">HINT</a></div>
                    <div class="item"><a href="https://lms.hr.nl">CUMLAUDE</a></div>
                    <div class="item"><a href="">GitHub</a></div>
                    <div class="item"><a href="">Stadslab</a></div>
                    <div class="item"><a href="{{ url('contact') }}">Contact</a></div>
                    <div class="item"><a href="{{ url('privacy') }}">Privacy</a></div>
                </div>
                <div class="footer sub">
                    <div class="item">
                        <a href="https://cmgtmemes.nl">
                            <img src="https://cmgt.hr.nl/./images/hr_logo.svg">
                            <br/>
                            <span class="copyright">&copy; {{ date('Y') }} CMGTMemes Rotterdam. Layout is totaal niet gestolen van CMGT Showcase.</span>
                        </a>
                    </div>
                    <div class="spacer"></div>
                    <div class="item">
                        <img src="https://cmgt.hr.nl/./images/payoff.svg" alt="" class="payoff">
                    </div>
                </div>
                <div class="verticalspacer"></div>
            </section>
        </section>
    </section>
</div>
</body>
</html>
