@section('styles')
    <link href="{{ asset('css/auth.css', env('APP_USE_HTTPS')) }}" rel="stylesheet">
@endsection
@include('layouts.partials._head')
@yield('content')
