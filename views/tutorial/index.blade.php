@extends('layouts.app')
@section('content')
    <div class="container container-height">
        <div class="tut-top">
            <h1 style="width: 35%">Tutorials:</h1>
            <span class="tut-order pull-right">
                {!! Form::open(['action' => 'TutorialController@search', 'method' => 'POST']) !!}
                    {{Form::text('val', '', ['class' => 'form-control tut-input', 'placeholder' => 'Search..'])}}
                    {{Form::submit('&#128269;', ['class' => 'btn btn-default'])}}
                {!! Form::close() !!}
            </span>
        </div>
        @if(count($tutorials)>0)
            @foreach($tutorials as $tutorial)
                <div class="tutorial">
                    <h3><a href="tutorial/{{$tutorial->id}}">{{$tutorial->title}}</a></h3>
                    {{strip_tags(str_limit($tutorial->text, 40))}}
                    <a href="tutorial/{{$tutorial->id}}">(read more)</a>
                    <hr>
                    From: {{$tutorial->created_at->format('d/m/Y')}} ({{$tutorial->created_at->diffForHumans()}})
                    <br>
                    by: <a href="/user/{{$tutorial->user->id}}">{{$tutorial->user->name}}
                        <img src="/storage/profile_img/{{$tutorial->user->img}}" width="30" height="20"></a>
                </div>
            @endforeach
                <div class="btn-tutorial">
                    {{$tutorials->links()}}
                </div>
        @endif

        @if(Auth::guest() || Auth::user()->role != 1)

        @else
            <div class="btn-tutorial">
                <a href="tutorial/create" class="btn-primary btn">Create tutorial</a>
            </div>
        @endif
    </div>
@endsection