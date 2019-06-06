<?php

namespace App\Http\Controllers;

use App\Workshop;
use Illuminate\Http\Request;
use App\Post;
use App\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
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
        $posts = Post::orderBy('created_at', 'asc')->paginate(10);
        $workshops = Post::where('user_id', auth()->user()->id)
        ->limit(4)
        ->get();
        $postsCount = Post::all()->count();
        return view('post.index', ['title' => 'tasks', 'posts' => $posts, 'workshops' => $workshops, 'count' => $postsCount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
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
            'title' => 'required|max:20',
            'description' => 'required',
            'img' => 'image|nullable|max:1999'
        ]);
        $fileNameToStore = "";
        //handle file upload
        if($request->hasFile('img')){
            $fileNameToStore = time().'_'.$request->file('img');

            $fileNameToStore =$request->file('img')->getClientOriginalName();
            $fileNameToStore = time().'_'.$fileNameToStore;

            $path = $request->file('img')->storeAs('public/img', $fileNameToStore);
        }else{
            $fileNameToStore = 'noImg.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->text = $request->input('description');
        $post->user_id = auth()->user()->id;
        $post->img = $fileNameToStore;
        $post->save();

        return redirect('post')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', ['title' => 'Task - '.$post->title, 'post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if($post->user_id == auth()->user()->id || auth()->user()->role == 1){
            return view('post.update', ['post' => $post, 'title' => 'Edit']);
        }
        return redirect('/post')->with('error', 'Unauthorized access');
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
        $this->validate($request,[
            'title' => 'required|max:20',
            'description' => 'required',
            'img' => 'image|nullable|max:1999'
        ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->text = $request->input('description');

        if($request->hasFile('img')){
            $fileNameToStore = time().'_'.$request->file('img');

            $fileNameToStore =$request->file('img')->getClientOriginalName();
            $fileNameToStore = time().'_'.$fileNameToStore;

            $request->file('img')->storeAs('public/img', $fileNameToStore);

            $post->img = $fileNameToStore;
        }
        $post->save();

        return redirect('/post')->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->user_id == auth()->user()->id || auth()->user()->role == 1) {
            $post->delete();

            Storage::delete('public/img/' . $post->img);

            return redirect('post')->with('success', 'Post deleted');
        }else{
            return redirect('/post')->with('error', 'Unauthorized access');
        }
    }

    public function order(Request $request)
    {
        $val = $request->val;
        $posts = Post::orderBy('created_at', $val)->paginate(10);
        $workshops = Workshop::orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        $postsCount = Post::all()->count();
        return view('post/index', ['title' => 'tasks', 'posts' => $posts, 'workshops' => $workshops, 'count' => $postsCount]);
    }
}
