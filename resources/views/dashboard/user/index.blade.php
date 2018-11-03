@extends('layouts.dashboard')

@section('content')
    @if($unlocked < 5)
        <section class="account-verification mb-3">
            <h2>Account unlock</h2>
            <h6 class="explanation">As a safety measure we ask you to unlock your account by rating at least 5 different
                memes ({{ $unlocked }}/5)</h6>
            <div class="progress">
                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ (100/5*$unlocked) }}%"
                     aria-valuenow="{{ (100/5*$unlocked) }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </section>
    @endif
    @include('dashboard.partials._posts-overview')
@endsection
