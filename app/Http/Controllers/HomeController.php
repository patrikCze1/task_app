<?php

namespace App\Http\Controllers;

use App\Tutorial;
use App\UserWorkshop;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $last_log = auth()->user()->last_log;

        $newUsersCount = DB::table('users')
            ->whereDate('created_at', '>', $last_log)
            ->count('name');

        $newPostsCount = DB::table('posts')
            ->whereDate('created_at', '>', $last_log)
            ->count('title');

        $newEventsCount = DB::table('workshops')
            ->whereDate('created_at', '>', $last_log)
            ->count('title');

        $posts = Post::all();

        $workshops = UserWorkshop::where('user_id', auth()->user()->id)
            ->get();
        return view('pages.home', ['title' => 'Home',
            'posts' => $posts,
            'workshops' => $workshops,
            'newUsers' => $newUsersCount,
            'newPosts' => $newPostsCount,
            'newEvents' => $newEventsCount]);
    }
}
