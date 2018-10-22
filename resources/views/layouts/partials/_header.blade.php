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
         style="background-image: url(@if(isset($header_image)) '{{ asset('/storage/uploads/' . $header_image) }}'
         @else 'https://cmgt.hr.nl:8000/public/uploads/83d1ad2a-86d7-4963-8ca6-d907929dce1e.png'
         @endif);">
    <svg viewBox="0 0 1000 70" width="1000vw" height="70px" preserveAspectRatio="none" class="poly">
        <polygon points="{{ rand(200, 900) }} 0 1000 70 0 70"
                 class="@if(isset($header)) {{ $header . '-fill' }} @else {{ 'white-fill' }} @endif"></polygon>
    </svg>
    <div class="banner">
        @if(isset($header_image))
            <h1>{{ $post->title }}</h1>
        @elseif(isset($title))
            <h1>{{ $title }}</h1>
        @else
            <h1>MEMES</h1>
            <button>Wijze woorden van Leonardo</button>
        @endif
    </div>
</section>
