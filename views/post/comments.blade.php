<?php use App\Http\Controllers\CommentsController;?>

<h3>Comments ({{count($post->comments)}}):</h3>

@if(count($post->comments) > 0)
    @foreach($post->comments as $comment)
        <div class="list-group">
            <div class="post_comment">
                <ul class="media-list">
                    <li><a href="/user/{{$comment->user->id}}">{{$comment->user->name}}
                            <img src="/storage/profile_img/{{$comment->user->img}}" width="30" height="20"></a> :
                    <i>{{$comment->text}}</i></li>
                    {{count($comment->like)}} &#10084;
                </ul>
            </div>
            <!--Like-->
        @if(CommentsController::isLiked($comment->id))
            {!! Form::open(['action' => 'LikeController@store', 'method' => 'POST', 'class' => 'form-inline']) !!}
            {{ Form::hidden('id', $comment->id) }}
            {{ Form::Submit('&#10084;', ['class' => 'btn-link'])}}
            {!! Form::close()!!}
        @endif
        <!--Delete-->
            @if(Auth::user()->role == 1 || Auth::user()->id == $comment->user_id)
                {!! Form::open(['action' => ['CommentsController@destroy', $comment->id], 'method' => 'POST', 'class' => 'form-inline']) !!}
                {{ Form::hidden('_method', 'DELETE')}}
                {{ Form::Submit('Delete comment', ['class' => 'btn btn-link'])}}
                {!! Form::close()!!}
            @endif
        </div>
    @endforeach
@endif

<!-- Add comments -->
<div class="form-group text-left">
    {!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) !!}

    {{Form::label('text', 'Comment:')}}
    {{Form::text('text', '', ['class' => 'form-control', 'placeholder' => 'Your comment...'])}}
    {{Form::hidden('id', $post->id) }}

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
</div>