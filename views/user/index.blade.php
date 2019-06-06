@extends('layouts.app')
@section('content')

    <div class="container container-height">
        <h1>{{$user->name}}'s profile.</h1>
        <div class="user-right">
            <h2>About</h2>
            {!! $user->about !!}
        </div>

        <div class="user-left">
            <table>
                <tr>
                    <td>email:</td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td>
                        role:
                    </td>
                    <td>
            @if($user->role == 1)
                Administrator
            @else
                User
            @endif
                    </td>
                </tr>
            </table>
            <br>

            <img src="/storage/profile_img/{{$user->img}}" alt="profile-image" width="250" height="200" title="profile img">
        </div>

        @if(auth()->id() == $user->id)
            <a href="/user/{{$user->id}}/edit" class="btn btn-primary">Edit profile</a>
        @endif
        <br>
        <a href="{{$_SERVER['HTTP_REFERER']}}" class="btn btn-link">Back</a>
    </div>
@endsection