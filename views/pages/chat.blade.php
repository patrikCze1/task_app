@extends('layouts.app')

@section('content')
    <div class="container container-height">
        <h1>Chat</h1>
        <div class="text-left">
            <input type="text" class="input-chat" id="txt" placeholder="Your message...">
            <button name="btn" class="btn btn-default inline" onclick="getMessage()">Send</button>
        </div>
        <br>
        <div class="chat">
            <table class="table-chat">
                @foreach($msg as $message)
                    <tr>
                        <td style="width: 12%">
                            <a href="/user/{{$message->user_id}}">{{$message->user->name}}
                                <img src="/storage/profile_img/{{$message->user->img}}" width="30" height="20"></a> :
                            <br>
                            {{$message->created_at->diffForHumans()}}
                        </td>
                        <td valign="top">
                            <i>{{$message->text}}</i>
                        </td>
                    </tr>

                @endforeach
            </table>
        </div>


    </div>
    <!-- refresh page -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function getMessage(){
            var message;
            message = document.getElementById("txt").value;
            if(message.length == 0){
                alert("Message can't be null!");
            }else {
                $.ajax({
                    url:'chat/send',
                    data: {message: message},
                    success:function(data){
                        $(".chatt").html(data);
                    }
                });
            }
        }
    </script>
@endsection
