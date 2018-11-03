@extends('layouts.app')

@section('content')

    <section class="browser-bg">
        <div class="title">
            <!-- Featured switch -->
            @auth
                @if ($admin !== false)
                    {!! Form::open(['action' => ['PostsController@featured', $post->id], 'method' => 'POST', 'id' => 'featuredForm']) !!}
                    <label class="bs-switch float-right">
                        <input type="checkbox" name="featured" id="featured" value="1" onclick="featuredCheck()"
                               @if($post->featured == 1) checked @endif>
                        <span class="slider round"></span>
                    </label>
                    @method('PUT')
                    {!! Form::close() !!}
                @endif
            @endauth

        <!-- Tagline -->
            <h3>{{ $post->tagline }}</h3>
            <p class="mb-3"><i class="far fa-user"></i> {{ $post->author }} <i
                    class="far fa-clock"></i> {{ $post->created_at }} <i class="far fa-calendar-alt"></i>
                Jaar {{ $post->year }} <i class="far fa-star"></i> {{ $rating }}</p>
            @foreach($post->tags as $tag)
                <div class="tag">
                    <a href="{{ url('tag/' . $tag->name) }}">{{ $tag->name }}</a>
                </div>
            @endforeach
        </div>
        <div class="spacer"></div>
        <div class="container p-0">
            <p>{{ $post->description }}</p>
            <h4 class="pt-3">De meme</h4>
            <div class="row">
                <div class="col-sm-12">
                    <img src="{{ asset('/storage/uploads/' . $post->meme_image) }}" alt="meme image"
                         class="responsive-image">
                </div>
            </div>
            <a href="{{ url('/') }}">
                <button class="mt-3">Terug naar showcase</button>
            </a>
            @auth
                @if(Auth::user()->id == $post->user_id)
                    <div class="float-right mt-3">
                        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST']) !!}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', ['class' => 'button']) }}
                        {!! Form::close() !!}
                    </div>
                    <div class="float-right mt-3">
                        <button onclick="location.href='{{ route('editPost', [$post->slug]) }}'">Edit</button>
                    </div>
                @else
                    @if($rated)
                        <div class="float-right mt-3">
                            <span>Je kan maar 1 rating per meme geven.</span>
                        </div>
                    @else
                        <div class="float-right mt-3">
                            {!! Form::open(['action' => ['RatingsController@add', $post->id],'method' => 'POST', 'class' => 'form-inline']) !!}
                            {{ Form::number('rating', '', ['min' => 1, 'max' => 10, 'class' => 'rating-input', 'required']) }}
                            {{ Form::submit('Voeg rating toe', ['class' => 'button']) }}
                            {{ Form::hidden('slug', $post->slug) }}
                            {!! Form::close() !!}
                        </div>
                    @endif
                @endif
            @endauth
        </div>
    </section>

@endsection
