<section id="user-overview">
    <h2>User overview</h2>
    <div class="table-responsive">
        @if(count($users) > 0)
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Email verified</th>
                    <th>Account unlocked</th>
                    <th>Admin</th>
                    <th>Created at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->email_verified_at !== null)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                        <td>
                            @if($user->unlocked !== null && $user->unlocked == 1)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                        <td>
                            @isset($admin)
                                @if($admin !== false)
                                    {!! Form::open(['action' => ['DashboardController@switchRole', $user->id], 'method' => 'put', 'id' => 'featuredForm']) !!}
                                    <label class="bs-switch">
                                        <input type="checkbox" name="featured" id="featured" value="1"
                                               onclick="submit()"
                                               @if($user->roles->first()->pivot->role_id == 2) checked @endif @if($user->id == $thisUser) disabled="disabled" @endif>
                                        <span class="slider round"></span>
                                    </label>
                                    {!! Form::close() !!}
                                @endif
                            @endisset
                        </td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @endforeach
                @else
                    Er zijn geen users op CMGTMemes
                @endif
                </tbody>
            </table>
            {{ $users->links() }}
    </div>
</section>
