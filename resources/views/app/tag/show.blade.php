@extends('layouts.app')

@section('content')

    <section class="browser-bg">
        <div class="title">
            <h3>{{ ucfirst($posts->first()->name) }} memes</h3>
        </div>
        <div class="browser">
            <div class="row">
                @if(count($posts->first()->posts) > 0)
                    @foreach($posts->first()->posts as $post)
                        @include('app.partials._singlecase')
                    @endforeach
                    {{ $posts->links() }}
                @else
                    <p>Er zijn geen posts met de tag {{ $posts->first()->name }} </p>
                @endif
            </div>
        </div>
    </section>

@endsection
