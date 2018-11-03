@section('styles')
    <link href="{{ asset('css/dashboard.css', env('APP_USE_HTTPS')) }}" rel="stylesheet">
@endsection
@include('layouts.partials._head')
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">CMGTMemes
        - {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();{{ __('Logout') }}">Sign
                out</a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin') || Request::is('user') ? 'active' : '' }}"
                           href="@isset($admin) @if($admin == 1){{ url('/admin') }}@else{{ url('/user') }}@endif @endisset">
                            <span data-feather="home"></span>
                            Dashboard
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Account settings</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/account') || Request::is('user/account') ? 'active' : '' }}"
                           href="{{ url('/admin/account') }}">
                            <span data-feather="book-open"></span>
                            Edit account
                        </a>
                    </li>
                    @if(Request::is('admin/account') || Request::is('user/account'))
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#deleteAccountModel">
                                <span data-feather="settings"></span>
                                Delete account
                            </a>
                        </li>
                    @endif
                </ul>
                @isset($admin)
                    @if($admin == 1)
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Analytics</span>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/analytics') || Request::is('user/analytics') ? 'active' : '' }}"
                                   href="{{ route('analytics') }}">
                                    <span data-feather="activity"></span>
                                    Site statistics
                                </a>
                            </li>
                        </ul>
                    @endif
                @endisset
                <hr>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <span data-feather="chevron-left"></span>
                            Back to homepage
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">{{ $title }}</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-outline-secondary">Share</button>
                        <button class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                    </button>
                </div>
            </div>
            @yield('content')
        </main>
    </div>
</div>
@if(Request::is('admin/account') || Request::is('user/account'))
    <!-- Delete account modal -->
    <div class="modal fade" id="deleteAccountModel" tabindex="1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete account?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>This options will delete your account. Are you sure? This is irreversible</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Scripts -->
<script src="{{ asset('js/app.js', env('APP_USE_HTTPS')) }}" defer></script>
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace();

</script>
</body>
</html>
