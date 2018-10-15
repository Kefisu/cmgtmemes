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
            {{ print_r($post) }}
        </div>
    </section>

@endsection
