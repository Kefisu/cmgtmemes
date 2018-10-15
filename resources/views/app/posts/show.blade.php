@extends('layouts.app')

@section('content')

    <section class="browser-bg">
        <div class="title">
            <h3>{{ $post->title }}</h3>
            <p class="mb-3"><i class="far fa-user"></i> {{ $post->author }} <i
                    class="far fa-clock"></i> {{ $post->created_at . ', Jaar ' . $post->year }}</p>
            @foreach($post->tags as $tag)
                <div class="tag">
                    <a href="{{ url('tag/' . $tag->name) }}">{{ $tag->name }}</a>
                </div>
            @endforeach
        </div>
        <div class="spacer"></div>
        <div class="container p-0">
            <p>{!! $post->description !!}</p>
            <h4 class="pt-3">De meme</h4>
            <div class="row">
            <div class="col-sm-12">
                <img src="{{ asset('/storage/uploads/' . $post->meme_image) }}" alt="meme image" class="responsive-image">
            </div>
            </div>
        </div>
    </section>

@endsection
