<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user/index', ['user' => $user, 'title' => $user->name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user/update', ['user' => $user, 'title' => 'Edit']);
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
        $user = User::find($id);

        $this->validate($request,[
            'name' => 'required',
            'img' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('profile_img')){
            $fileNameToStore = time().'_'.$request->file('profile_img');

            $fileNameToStore =$request->file('profile_img')->getClientOriginalName();
            $fileNameToStore = time().'_'.$fileNameToStore;

            $request->file('profile_img')->storeAs('public/profile_img', $fileNameToStore);

            $user->img = $fileNameToStore;
        }

        $user->about = $request->input('about');
        $user->name = $request->input('name');
        $user->save();

        return redirect('/home')->with('success', 'Profile edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
