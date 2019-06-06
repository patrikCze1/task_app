<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\Like;
class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'text' => 'required'
        ]);

        $comment = new Comments;
        $comment->text = $request->input('text');
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->input('id');
        $comment->save();

        return redirect()->action(
            'PostController@show', ['id' => $comment->post_id]
        )->with('success', 'Comment added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $com = Comments::find($id);
        $com->delete();

        return redirect()->action(
            'PostController@show', ['id' => $com->post_id]
        )->with('success', 'Comment deleted');
    }

    public static function isLiked($id){
        $likes = Like::where('comments_id', '=', $id)->get();

        foreach ($likes as $like){
            if ($like->user_id == auth()->user()->id)
                return false;
        }
        return true;
    }
}
