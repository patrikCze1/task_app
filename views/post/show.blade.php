@extends('layouts.app')
@section('content')
    <div class="container container-height">
        <h1>Task: {{$post->title}}</h1>
        <div>
            By: <a href="/user/{{$post->user_id}}">{{$post->user->name}}
                <img src="/storage/profile_img/{{$post->user->img}}" width="30" height="20"></a>
        </div>
        <br>
        <div class="align-baseline">
            <img src="/storage/img/{{$post->img}}" class="center-block" alt="noImg" width="50%" height="50%">
            <h3>Description:</h3>
            {!! $post->text !!}
        </div>
        <hr>
        <!-- Edit post -->
        @if(Auth::user()->role == 1 || Auth::user()->id == $post->user_id)
            <a href="/post/{{$post->id}}/edit" class="btn btn-default">Edit post</a>
        @endif
        <!-- Delete post -->
        @if(auth()->id() == $post->user_id || auth()->user()->role == 1)
            {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST']) !!}
                {{ Form::hidden('_method', 'DELETE')}}
                {{ Form::Submit('Delete post', ['class' => 'btn btn-danger pull-right'])}}
            {!! Form::close()!!}
        @endif


        @include('post.comments')

        <a href="/post" class="btn btn-link">Back</a>
    </div>
@endsection
