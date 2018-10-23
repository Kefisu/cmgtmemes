@extends('layouts.dashboard')

@section('content')
    <!-- Latest post overview -->
    @include('dashboard.partials._posts-overview')
    <!-- User overview -->
    @include('dashboard.partials._user-overview')
@endsection
