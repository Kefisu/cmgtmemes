@extends('layouts.app')

@section('content')

    <section class="main-bg">
        <main>
            <p class="mt-3 mb-3">Welkom bij Creative Media and Game Technologies. Op deze website vind je een selectie
                van de beste memes
                en grappen over het studeren bij CMGT in Rotterdam.</p>
            <h3>Top memes</h3>
            <p class="mt-3 mb-3">Memes in de spotlight</p>
            <section class="spotlight-bg">
                <div class="row">
                    @foreach($posts as $post)
                        @if($post->featured != 1) @continue @endif
                        <div class="col-md-6 col-sm-12 mb-3">
                            <a href="{{ url('post', [$post->slug]) }}">
                                <article class="singlecase">
                                    <div class="thumbnail"
                                         style="background-image: url('{{ asset('storage/uploads/' . $post->meme_image) }}')">
                                        <div class="title">
                                            <h3>{{ $post->title }}</h3>
                                        </div>
                                    </div>
                                    <div class="description">
                                        {{ $post->tagline }}
                                        <br>
                                        @foreach($post->tags as $tag)
                                            <div class="tag">
                                                <a href="{{ url('tag/' . $tag->name) }}">{{ $tag->name }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </article>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
            <p>Bekijk hier alle uigelichte memes</p>
            {{--{{ $posts->links() }}--}}
            <p>Of zoek in alle memes via tags:</p>
            @foreach($tags as $tag)
                <div class="tag overview">
                    <a href="{{ url('tag/' . $tag->name) }}">{{ $tag->name }}</a>
                </div>
            @endforeach
        </main>
        <svg width="1000px" height="70px" viewBox="0 0 1000 70" preserveAspectRatio="none" class="poly bg-red">
            <polygon points="0 0 {{ rand(200, 850) }} 30 1000 0 1000 70 0 70" class="light-fill"></polygon>
        </svg>
    </section>

    <section class="browser-bg">
        <div class="title">
            <h3>Recente memes</h3>
        </div>
        <div class="browser">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-6 col-sm-12 mb-3">
                        <a href="{{ url('post', [$post->slug]) }}">
                            <article class="singlecase">
                                <div class="thumbnail"
                                     style="background-image: url('{{ asset('storage/uploads/' . $post->meme_image) }}')">
                                    <div class="title">
                                        <h3>{{ $post->title }}</h3>
                                    </div>
                                </div>
                                <div class="description">
                                    {{ $post->tagline }}
                                    <br>
                                    @foreach($post->tags as $tag)
                                        <div class="tag">
                                            <a href="{{ url('tag/' . $tag->name) }}">{{ $tag->name }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </article>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
