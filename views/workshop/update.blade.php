@extends('layouts.app')
@section('content')
    <div class="container container-height">
        <H1>Edit</H1>

        {!! Form::open(['action' => ['WorkshopController@update', $workshop->id], 'method' => 'POST']) !!}
        <div class="form-group text-left">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $workshop->title, ['class' => 'form-control'])}}
        </div>
        <div class="form-group text-left">
            {{Form::label('info', 'About workshop')}}
            {{Form::textarea('info', $workshop->info, ['id' => 'arti', 'class' => 'form-control'])}}
        </div>
        <div class="col-md-offset-6">
            {{Form::label('place', 'Place')}}
            {{Form::number('place', $workshop->place, ['class' => 'form-control'])}}
        </div>
        <div class="form-group text-left">
            {{Form::label('price', 'Price')}}
            {{Form::number('price', $workshop->price, ['class' => 'form-control'])}}
        </div>
        <div class="col-md-offset-6">
            {{Form::label('date', 'Date')}}
            {{Form::date('date', $workshop->date, ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
    <script>
        CKEDITOR.replace('arti');
    </script>
@endsection