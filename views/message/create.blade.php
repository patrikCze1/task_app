@extends('layouts.app')
@section('content')

    <div class="container">
        <h1>Send message</h1>
        <div class="form-group">
            {!! Form::open(['action' => 'MessageController@store', 'method' => 'POST']) !!}
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}

            {{Form::label('text', 'Text')}}
            {{Form::textarea('text', '', ['class' => 'form-control', 'placeholder' => 'Your message...'])}}

            {{Form::submit('Send', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
        <a href="/home" class="btn btn-link">Back</a>
    </div>
@endsection