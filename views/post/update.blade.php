@extends('layouts.app')
@section('content')
    <div class="container container-height">
        <H1>Edit</H1>

        {!! Form::open(['action' => ['PostController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group text-left">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control'])}}
        </div>
        <div class="form-group text-left">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', $post->text, ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::file('img')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection