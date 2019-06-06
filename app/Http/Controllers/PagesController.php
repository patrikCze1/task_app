<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function posts(){
    }

    public function home(){
        return view('pages.home')->with('title', 'Homepage');
    }

    public function contact(){
        $title = 'Contact';
        return view('pages.contact')->with('title', $title);
    }
}
