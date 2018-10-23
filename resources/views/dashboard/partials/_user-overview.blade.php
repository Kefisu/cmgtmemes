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
                        <td>No</td>
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
