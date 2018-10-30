@extends('layouts.app')

@section('content')

    <section class="browser-bg">
        <div class="title">
            <h3>Meme uploaden</h3>
            <p>Op deze pagina kan je een meme uploaden. Om te kunnen uploaden moet je ingelogd
                zijn met je CMGTMemes account.</p>
        </div>
        <div class="spacer">
        </div>
        <div class="container p-0">
            {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{ Form::label('title', 'Titel') }}
                <br/>
                {{ Form::text('title', $post->title, ['id' => 'title', 'class' => 'full-width required']) }}
            </div>
            <div class="form-group">
                {{ Form::label('author', 'Naam') }}
                <br/>
                <span class="explanation">Jouw eigen naam, leeg is anoniem</span>
                <br/>
                {{ Form::text('author', $post->author, ['id' => 'author', 'class' => 'full-width required']) }}
            </div>
            <div class="form-group">
                {{ Form::label('year', 'Jaar') }}
                <br/>
                {{ Form::number('year', $post->year, ['min' => 1, 'max' => 4, 'id' => 'year', 'class' => 'full-width required']) }}
            </div>
            <div class="form-group">
                {{ Form::label('tagline', 'Tagline') }}
                <br/>
                <span class="explanation">Een korte regel die je meme beschrijft</span>
                <br/>
                {{ Form::text('tagline', $post->tagline, ['id' => 'tagline', 'class' => 'full-width required']) }}
            </div>
            <div class="form-group">
                {{ Form::label('description', 'Beschrijving') }}
                <br/>
                <span class="explanation">Beschrijf in een korte paragraaf waar je meme over gaat.</span>
                <br/>
                {{ Form::textarea('description', $post->description, ['cols' => 30, 'rows' => 7, 'class' => 'full-width required']) }}
            </div>
            <div class="spacer">
            </div>
            <div class="form-group">
                <p class="m-0">Tags</p>
                <span class="explanation">Selecteer hier de tags die bij jouw meme passen.</span>
                <select name="tags[]" class="full-width" size="3" multiple="multiple">
                    <option v-for="tag of tags" v-bind:value="tag.id">@{{tag.name}}</option>
                </select>
                <span class="explanation">Voeg een nieuwe tag toe</span>
                {{ Form::text('newtag', '', ['id' => 'newtag', 'class' => 'full-width']) }}
                <button class="disabled mt-2" v-on:click.prevent="addTag">Tag toevoegen</button>
            </div>
            <div class="form-group">
                <p class="m-0">Meme</p>
                <span class="explanation">Het is niet mogelijk de meme afbeelding te veranderen.</span>
                <br/>
            </div>
            <div class="form-group">
                <p>Heb je alles goed ingevuld? Klik dan op de knop om je meme te bewerken.</p>
                <button type="submit" name="submit">Upload</button>
            </div>
            {!! Form::close() !!}
        </div>
    </section>

@endsection
