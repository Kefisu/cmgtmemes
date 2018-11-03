@extends('layouts.dashboard')

@section('content')
    <!-- Latest post overview -->
    @include('inc.messages')

    <div class="card">
        <div class="card-header">
            {{ $account->name }}
        </div>
        <div class="card-body">
            {!! Form::open() !!}

            <div class="form-group">
                {{ Form::label('name', 'Naam') }} <br />
                {{ Form::text('name', $account->name, ['class' => 'full-width']) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', 'Email') }} <br />
                {{ Form::text('email', $account->email, ['class' => 'full-width']) }}
            </div>

            {{ Form::submit('Update', ['class' => 'btn btn-success']) }}

            {!! Form::close() !!}
        </div>
        <div class="card-footer">
            Laatste update: {{ $account->updated_at }}
        </div>
    </div>
@endsection
