<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        return view('pages/chat', ['title' => 'Chat', 'msg' => $messages]);
    }

    public function store(){
        $message = new Message();
        $message->text = $_GET['message'];
        $message->user_id = auth()->user()->id;
        $message->save();

        $msg = Message::orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
$mssg = "todle je sračka";
        return view('pages/chat')->with('msg', $msg);
        //return response()->json(array('msg' => $messages), 200);

        //return redirect('/chat')->with('success', 'Message sended');
    }
}
