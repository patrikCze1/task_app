@extends('layouts.app')

@section('content')
<div class="container container-height" style="font-size: large; background-color: white">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div style="text-align: center">
                <h1>Home page - Info</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->role == 1)
                        Welcome {{Auth::user()->name}}, you have <a href="/post"> {{count($posts)}}</a> tasks to do.
                        <br>
                        There are new users: {{$newUsers}}<br>
                        and {{$newPosts}} new posts.
                    @else
                        Welcome user {{Auth::user()->name}}!<br>
                            New workshops count: <a href="/workshop">{{$newEvents}}</a><br>
                    @endif
                <br>
                Last sing in: {{auth()->user()->last_log}}<br>
                Your ip address: {{request()->ip()}}
            </div>
            <hr>
            <div class="col-md-4">
                <button class="btn btn-link" onclick="show('workshop')">Show your workshops</button>
            </div>
            <div class="col-md-7">
                <button class="btn btn-link" onclick="show('posts')">Show posts</button>
            </div>
            <div class="col-md-4 left-border" id="workshop">
                <h2>Workshops:</h2>
                @foreach($workshops as $workshop)
                    Title: <a href="workshop/{{$workshop->workshop->id}}">{{$workshop->workshop->title}}</a><br>
                    Date: {{$workshop->workshop->date}}<br>
                    Price: {{$workshop->workshop->price}} Kč<br>
                    <hr>
                @endforeach
                <br>
            </div>

            <div class="col-md-7 left-border" style="float: right; padding-left: 5px" id="posts">
                @if(auth()->user()->role == 1)
                    <h3>New posts:</h3>
                    @foreach($posts as $post)
                        @if($post->created_at >= auth()->user()->last_log)
                            <p>
                                Title: <a href="post/{{$post->id}}">{{$post->title}}</a><br>
                            </p>
                        @endif
                    @endforeach
                @else
                    <h2>Your posts:</h2>
                    <table style="border-left: grey solid 2px">
                        @foreach($posts as $post)
                            @if($post->user_id == Auth::user()->id)
                                <tr>
                                    <td valign="top">
                                        Title - <a href="post/{{$post->id}}">{{$post->title}}</a>
                                    </td>
                                    <td style="margin: 4px">
                                    @foreach($post->comments as $comment)
                                        @if($comment->created_at > auth()->user()->last_log)
                                            <a href="/user/{{$comment->user->id}}">{{$comment->user->name}}
                                                <img src="/storage/profile_img/{{$comment->user->img}}" width="30" height="20"></a>
                                             add comment <br>({{$comment->created_at->diffForHumans()}})
                                            <br>
                                        @endif
                                    @endforeach
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
            @endif
            </div>
        </div>
    </div>
</div>
<script>
    function show(name) {
        var x = document.getElementById(name);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
@endsection
