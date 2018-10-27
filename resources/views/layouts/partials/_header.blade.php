<!-- Navigation -->
<div class="container p-0" id="nav">
    <a href="{{ route('homepage') }}">
        <div class="logo">
            <img src="https://cmgt.hr.nl/./images/hr_logo.svg " alt="hr_logo">
            <h3 class="white-text mt-2">CREATIVE MEDIA AND GAME TECHNOLOGIES</h3>
        </div>
    </a>
    <div class="spacer"></div>
    <div class="search login">
        <a href="{{ url('search') }}"><img src="{{ asset('/svg/search.svg') }}" alt="search"></a>
    </div>
    <div class="login">
        @guest
            <a href="{{ route('login') }}"><img src="{{ asset('/svg/login.svg') }}" alt="login" class="red-fill"></a>
        @else
            <a href="{{ url('admin') }}"><img src="{{ asset('/svg/account.svg') }}" alt="dashboard"></a>
        @endguest
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
<!-- ./Navigation -->

<section class="banner-bg"
         style="background-image: url(@if(isset($header_image)) '{{ asset('/storage/uploads/' . $header_image) }}'
         @elseif($randomHeader != null)'{{ asset('/storage/uploads/' . $randomHeader->meme_image) }}'@else {{ asset('/storage/img/noimage.jpg') }}
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
            @isset($randomHeader)
                <button
                    onclick="window.location.href='{{ url('post', [$randomHeader->slug]) }}'">{{ $randomHeader->title }}</button>
            @endisset
        @endif
    </div>
</section>
