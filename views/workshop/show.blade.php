@extends('layouts.app')
@section('content')
    <div class="container container-height">
            <h1 style="text-align: center">{{$workshop->title}}</h1>
            <div>
                By: <a href="/user/{{$workshop->user_id}}">{{$workshop->user->name}}
                    <img src="/storage/profile_img/{{$workshop->user->img}}" width="30" height="20"></a>
                <br>
                Date: {{$workshop->date}}<br>
                Free places: {{$workshop->place - count($data)}}<br>
            </div>
            <div style="text-align: center">
                <h2>About:</h2>
                <p>
                    {!!  $workshop->info !!}
                </p>
                <br/>

                @if($join > 0)
                    {!! Form::open(['action' => ['WorkshopController@leave', $workshop->id], 'method' => 'POST']) !!}
                    {{ Form::Submit('Leave', ['class' => 'btn btn-default'])}}
                    {!! Form::close()!!}
                @else
                    {!! Form::open(['action' => ['WorkshopController@join', $workshop->id], 'method' => 'POST']) !!}
                    {{ Form::Submit('Join workshop', ['class' => 'btn btn-default'])}}
                    {!! Form::close()!!}
                @endif
            </div>
        <div>
                <h3>List of users ({{count($data)}})</h3>
                <table style="width: 80%; margin: 20px 50px">
                    <tr>
                        <Th>User</Th>
                        <Th>Registered</Th>
                        <Th>Email</Th>
                    </tr>
                    @foreach($data as $d)
                        <tr style="padding: 10px; border-bottom: solid grey 1px">
                            <td>
                        <a href="/user/{{$d->user_id}}">{{$d->user->name}}
                            <img src="/storage/profile_img/{{$d->user->img}}" width="30" height="20"></a>
                            </td>
                            <td>{{$d->created_at}}</td>
                            <td>{{$d->user->email}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>


        @if(Auth::user()->role == 1 || $workshop->user_id == auth()->user()->id)
                <a href="/workshop/{{$workshop->id}}/edit" class="btn btn-default">Edit event</a><br>
        <!-- Delete workshop -->
            <div class="pull-right">
            {!! Form::open(['action' => ['WorkshopController@destroy', $workshop->id], 'method' => 'POST']) !!}
            {{ Form::hidden('_method', 'DELETE')}}
            {{ Form::Submit('Delete event', ['class' => 'btn btn-danger right'])}}
            {!! Form::close()!!}
            </div>
        @endif

        <a href="/workshop" class="btn btn-link">Back</a>
    </div>
@endsection
