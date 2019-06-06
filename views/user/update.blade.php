@extends('layouts.app')
@section('content')
    <div class="container container-height">
        <H1>Edit</H1>
        <div class="form-group text-left">
            {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                {{Form::label('name', 'Name')}}
                {{Form::text('name', $user->name, ['class' => 'form-control'])}}

                {{Form::label('about', 'About you')}}
                {{Form::textarea('about', $user->about, ['id' => 'arti', 'class' => 'form-control'])}}

                Profile image
                {{Form::file('profile_img')}}
                {{Form::hidden('_method', 'PUT')}}

            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    <script>
        CKEDITOR.replace('arti');
    </script>
@endsection