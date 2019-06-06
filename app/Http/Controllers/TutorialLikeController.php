<?php

namespace App\Http\Controllers;

use App\TutorialLike;
use Illuminate\Http\Request;

class TutorialLikeController extends Controller
{
    public function like(Request $r){
        $count = TutorialLike::where('user_id', auth()->user()->id)
            ->where('tutorial_id', $r->id)->count();

        if($count > 0){
            return redirect()->action(
                'TutorialController@show', ['id' => $r->id]
            )->with('error', 'You already liked');
        }

        $like = new TutorialLike;
        $like->user_id = auth()->user()->id;
        $like->tutorial_id = $r->id;
        $like->value = 1;
        $like->save();

        return redirect()->action(
            'TutorialController@show', ['id' => $like->tutorial_id]
        )->with('success', 'Like added');
    }

    public function dislike(Request $r){
        $count = TutorialLike::where('tutorial_id', $r->id)
            ->where('user_id', auth()->user()->id)->count();

        if($count > 0){
            return redirect()->action(
                'TutorialController@show', ['id' => $r->id]
            )->with('error', 'You already liked');
        }
        $like = new TutorialLike;
        $like->user_id = auth()->user()->id;
        $like->tutorial_id = $r->id;
        $like->value = -1;
        $like->save();

        return redirect()->action(
            'TutorialController@show', ['id' => $like->tutorial_id]
        )->with('success', 'Dislike added');
    }


}
