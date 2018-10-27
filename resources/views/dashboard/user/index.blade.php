@extends('layouts.dashboard')

@section('content')
    <section class="account-verification mb-3">
        <h2>Account unlock</h2>
        <h6 class="explanation">As a safety measure we ask you to unlock your account by loging in at 4 different days. (1/4)</h6>
        <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </section>

    @include('dashboard.partials._posts-overview')
@endsection
