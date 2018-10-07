@extends('layouts.app')

@section('content')

    <section class="browser-bg">
        <div class="title">
            <h3>{{ ucfirst($posts->first()->name) }} memes</h3>
        </div>
        <div class="browser">
            <div class="row">
                @foreach($posts->first()->posts as $post)
                    <div class="col-md-6 col-sm-12 mb-3">
                        <article class="singlecase">
                            <div class="thumbnail"
                                 style="background-image: url('https://cmgt.hr.nl:8000/public/uploads/c8a53880-99cd-4aec-9443-342aa80cbabd.jpeg')">
                                <div class="title">
                                    <h3>{{ $post->title }}</h3>
                                </div>
                            </div>
                            <div class="description">
                                {{ Str::words($post->body, 10) }}
                                <br>
                                @foreach($post->tags as $tag)
                                    <div class="tag">
                                        <a href="{{ url('tag/' . $tag->name) }}">{{ $tag->name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
