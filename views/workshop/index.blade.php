@extends('layouts.app')
@section('content')
    <div class="container container-height">
        <div>
            <h1>Workshops: ({{count($workshops)}})</h1>
            @if(count($workshops)>0)
                @foreach($workshops as $workshop)
                    <div class="job text-center">
                        <h2><a href="workshop/{{$workshop->id}}">{{$workshop->title}}</a></h2>
                        <hr>
                        Date: {{$workshop->date}}<br>
                        Place: {{$workshop->place}}<br>
                        Price: {{$workshop->price}} Kč<br>
                        Created {{$workshop->created_at->diffForHumans()}}
                    </div>
                @endforeach
                {{$workshops->links()}}
            @else
                There are no workshops.
            @endif
        </div>

            <div style="float: left;width: 100%">
                <a href="workshop/create" class="btn-primary btn">New event.</a>
            </div>


    </div>
@endsection