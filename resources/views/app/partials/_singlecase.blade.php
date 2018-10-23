<div class="col-md-6 col-sm-12 mb-3">
    <a href="{{ url('post', [$post->slug]) }}">
        <article class="singlecase">
            <div class="thumbnail" alt="meme"
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
