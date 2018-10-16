<!-- Include head section -->
@include('layouts.partials._head')

<body>
<div id="app">

    <!-- Include header -->
    @include('layouts.partials._header')

    @yield('content')
    <!-- Include lower half layout -->
    @include('layouts.partials._lower-half')

</div>
</body>
</html>
