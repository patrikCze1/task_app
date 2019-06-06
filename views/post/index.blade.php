@extends('layouts.app')
@section('content')

<div class="container container-height">
    <div class="post-right">
        @include('post.newworkshop')
    </div>

    <div class="post-left">
        <h1>Tasks: ({{$count}})</h1>
        <span class="post-order pull-right">
            {!! Form::open(['action' => 'PostController@order', 'method' => 'POST']) !!}
                {{Form::label('title', 'Order by: ')}}
                {{Form::select('val', array('desc' => 'Newest', 'asc' => 'Oldest'))}}
                {{Form::submit('Order', ['class' => 'btn btn-default'])}}
            {!! Form::close() !!}
        </span>
        @if(count($posts)>0)
            @foreach($posts as $post)
                <div class="post">
                    <span>
                        <h3><a href="post/{{$post->id}}">{{$post->title}}</a></h3>
                    </span>
                    <span class="pulka pull-right">
                        From date: {{$post->created_at->format('d/m/y')}};
                        by: <a href="/user/{{$post->user->id}}">{{$post->user->name}}
                        <img src="/storage/profile_img/{{$post->user->img}}" width="30" height="20"></a>
                    </span>
                </div>
            @endforeach
            {{$posts->links()}}
        @else
            There are no tasks.
        @endif
    </div>
    <a href="post/create" class="btn-primary btn">Create post.</a>
</div>
@endsection