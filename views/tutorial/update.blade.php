@extends('layouts.app')
@section('content')
    <div class="container container-height">
        <H1>Edit</H1>
        <div class="form-group">
            {!! Form::open(['action' => ['TutorialController@update', $tutorial->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $tutorial->title, ['class' => 'form-control'])}}

                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', $tutorial->text, ['id' => 'arti', 'class' => 'form-control'])}}

                {{Form::hidden('_method', 'PUT')}}
                {{Form::file('img')}}
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
        <a href="{{url()->previous()}}" class="btn btn-link">Back</a>
    </div>
    <script>
        CKEDITOR.replace('arti');
    </script>
@endsection