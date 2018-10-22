@extends('layouts.app')

@section('content')
    <section class="browser-bg">
        <div class="title">

            <div class="row mb-3">
                <div class="col-12">
                    <h4>Gebruik het formulier om te zoeken door CMGTMemes</h4>
                    <h6 class="explanation">Door te zoeken krijg je twee resultaten terug: Alle posts en alle Tags gekoppeld aan jouw zoek resultaat.</h6>
                    {!! Form::open(['action' => 'SearchController@index', 'method' => 'POST']) !!}
                    <div class="input-group">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="submit()">Search</button>
                          </span>
                        <input type="text" class="form-control" placeholder="Search for..." name="searchKey">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            @isset($posts)
                @if(count($posts) > 0)
                    <table class="table table-bordered table-hover white">
                        <thead>
                        <tr>
                            <th>Gevonden Posts:</th>
                        </tr>
                        </thead>
                        @foreach($posts as $post)
                            <tr>
                                <td onclick="location.href='{{ url('/post', [$post->slug]) }}'">
                                    <p class="m-0">{{ $post->title }}</p>
                                    <span class="explanation">Gevonden in: cmgtmemes.nl/post/{{ $post->slug }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            @endisset
            @isset($tags)
                @if(count($tags) > 0)
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Gevonden Tags:</th>
                        </tr>
                        </thead>
                        @foreach($tags as $tag)
                            <tr>
                                <td onclick="location.href='{{ url('/tag', [$tag->name]) }}'">
                                    <p class="m-0">{{ $tag->name }}</p>
                                    <span class="explanation">Gevonden in: cmgtmemes.nl/tag/{{ $tag->name }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            @endisset
            <section class="float-right">
                <img src="{{ asset('/storage/img/search-by-algolia-light-background-8762ce8b.svg') }}" alt="">
            </section>
        </div>
    </section>
@endsection
