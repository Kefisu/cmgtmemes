<h2>Latest posts</h2>
<div class="table-responsive">
    @if(count($posts) > 0)
        <table class="table table-hover table-sm">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>User</th>
                <th>Uploaded at</th>
                <th>Updated at</th>
                @isset($admin)
                    @if($admin == 1)
                        <th>Featured</th>
                    @endif
                @endisset
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ Auth::user()->name }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    @isset($admin)
                        @if($admin !== false)
                            <td>{!! Form::open(['action' => ['DashboardController@featured', $post->id], 'method' => 'POST', 'id' => 'featuredForm']) !!}
                                <label class="bs-switch">
                                    <input type="checkbox" name="featured" id="featured" value="1" onclick="submit()"
                                           @if($post->featured == 1) checked @endif>
                                    <span class="slider round"></span>
                                </label>
                                @method('PUT')
                                {!! Form::close() !!}</td>
                        @endif
                    @endisset
                    <td><a href="{{ url('post', [$post->slug]) }}">Show</a></td>
                </tr>
            @endforeach
            @else
                Je hebt geen posts op CMGTMemes.nl
            @endif
            </tbody>
        </table>
        {{ $posts->links() }}
</div>
