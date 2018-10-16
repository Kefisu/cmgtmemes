@extends('layouts.app')

@section('content')

    <section class="browser-bg">
        <div class="title">
            <h3>{{ ucfirst($posts->first()->name) }} memes</h3>
        </div>
        <div class="browser">
            <div class="row">
                @foreach($posts->first()->posts as $post)
                    @include('app.partials._singlecase')
                @endforeach
            </div>
        </div>
    </section>

@endsection
