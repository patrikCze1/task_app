@extends('layouts.app')
@section('content')

    <div class="container container-height">
        <h1>Create:</h1>
        <div class="form-group">
            {!! Form::open(['action' => 'PostController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}

                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Your problem...'])}}

                {{Form::file('img')}}

                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
        <a href="/post" class="btn btn-link">Back</a>
    </div>
@endsection