@extends('layouts.app')
@section('content')
    <div class="container container-height">
        <h1>{{$tutorial->title}}</h1>
        <div>
            By: <a href="/user/{{$tutorial->user_id}}">{{$tutorial->user->name}}
                <img src="/storage/profile_img/{{$tutorial->user->img}}" width="30" height="20"></a>
            <br>
            From: {{$tutorial->created_at->format('d/m/Y')}}
        </div>
        <div>
            <br>
            {!!  $tutorial->text!!}
            <br/><br/>
            <img src="/storage/img/{{$tutorial->img}}" alt="noImg" class="tutorial-img">
        </div>
        <br>

        <!-- Edit tutorial -->
        @if(auth()->id() == $tutorial->user_id)
            <a href="/tutorial/{{$tutorial->id}}/edit" class="btn btn-default">Edit tutorial</a>
        @endif
    <!-- Delete tutorial -->
        @if(auth()->id() == $tutorial->user_id)
            {!! Form::open(['action' => ['TutorialController@destroy', $tutorial->id], 'method' => 'POST']) !!}
            {{ Form::hidden('_method', 'DELETE')}}
            {{ Form::Submit('Delete tutorial', ['class' => 'btn btn-danger pull-right'])}}
            {!! Form::close()!!}
        @endif
        <hr>
        <h3>Likes: {{$likes}}</h3>
        @if(auth()->check())
            {!! Form::open(['action' => ['TutorialLikeController@like'], 'method' => 'POST']) !!}
                {{ Form::hidden('id', $tutorial->id)}}
                {{ Form::Submit('This is good! &#10003;', ['class' => 'btn btn-link'])}}
            {!! Form::close()!!}

            {!! Form::open(['action' => ['TutorialLikeController@dislike'], 'method' => 'POST']) !!}
                {{ Form::hidden('id', $tutorial->id)}}
                {{ Form::Submit('This is bad! &#10007;', ['class' => 'btn btn-link'])}}
            {!! Form::close()!!}
        @else
            For likes, you have to be log in.
            <br>
        @endif
        <a href="/tutorial" class="btn btn-link">Back</a>
    </div>
@endsection
