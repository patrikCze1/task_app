@extends('layouts.app')
@section('content')

    <div class="container container-height">
        <h1>Create:</h1>
        <div class="form-group" style="margin-bottom: 10%">
            {!! Form::open(['action' => 'WorkshopController@store', 'method' => 'POST']) !!}
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}

                {{Form::label('info', 'About workshop')}}
                {{Form::textarea('info', '', ['class' => 'form-control','id' => 'arti', 'placeholder' => 'Write something about job.'])}}
                <div class="col-md-4">
                {{Form::label('price', 'Price')}}
                {{Form::number('price', '', ['class' => 'form-control pull-left'])}}
                    {{Form::submit('Submit', ['class' => 'btn btn-primary pull-left'])}}
                </div>
                <div class="col-md-4">
                    {{Form::label('place', 'Place')}}
                    {{Form::number('place', '', ['class' => 'form-control pull-left'])}}
                </div>
                <div class="col-md-4">
                {{Form::label('date', 'Date')}}
                {{Form::date('date', '', ['class' => 'form-control'])}}
                </div>

            {!! Form::close() !!}
<br>
        </div>
        <a href="/workshop" class="btn btn-link">Back</a>
    </div>
    <script>
        CKEDITOR.replace('arti');
    </script>
@endsection