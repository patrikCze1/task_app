<h2>Your newest posts</h2>
@foreach($workshops as $workshop)
    <div class="text-center">
        <a href="post/{{$workshop->id}}">
        {{$workshop->title}}</a><br>
        Date: {{$workshop->created_at}}
    </div>
    <hr>
@endforeach