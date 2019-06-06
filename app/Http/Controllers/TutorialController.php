<?php

namespace App\Http\Controllers;

use App\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutorialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutorials = Tutorial::orderBy('created_at', 'asc')->paginate(9);

        return view('tutorial.index', ['title' => 'tutorials', 'tutorials' => $tutorials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutorial.create')->with('title', 'create tutorial');
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
            'title' => 'required',
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

        $tutorial = new Tutorial;
        $tutorial->title = $request->input('title');
        $tutorial->text = $request->input('description');
        $tutorial->user_id = auth()->user()->id;
        $tutorial->img = $fileNameToStore;
        $tutorial->save();

        return redirect('tutorial')->with('success', 'Tutorial created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tutorial = Tutorial::find($id);
        $likes = DB::table('tutorial_likes')->where('tutorial_id', $id)->sum('value');
        return view('tutorial.show', ['title' => 'Tutorial - '.$tutorial->title, 'tutorial' => $tutorial, 'likes' => $likes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tutorial = Tutorial::find($id);

        if($tutorial->user_id == auth()->user()->id || auth()->user()->role == 1){
            return view('tutorial.update', ['tutorial' => $tutorial, 'title' => 'Edit']);
        }
        return redirect('/tutorial')->with('error', 'Unauthorized access');
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
            'title' => 'required',
            'description' => 'required',
            'img' => 'image|nullable|max:1999'
        ]);

        $tutorial = Tutorial::find($id);
        $tutorial->title = $request->input('title');
        $tutorial->text = $request->input('description');

        if($request->hasFile('img')){
            $fileNameToStore = time().'_'.$request->file('img');

            $fileNameToStore =$request->file('img')->getClientOriginalName();
            $fileNameToStore = time().'_'.$fileNameToStore;

            $request->file('img')->storeAs('public/img', $fileNameToStore);

            $tutorial->img = $fileNameToStore;
        }
        $tutorial->save();

        return redirect('/tutorial')->with('success', 'Tutorial updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tutorial = Tutorial::find($id);
        if($tutorial->user_id == auth()->user()->id || auth()->user()->role == 1) {
            $tutorial->delete();

            Storage::delete('public/img/' . $tutorial->img);

            return redirect('tutorial')->with('success', 'Tutorial deleted');
        }else{
            return redirect('/tutorial')->with('error', 'Unauthorized access');
        }
    }

    public function search(Request $request)
    {
        $value = $request->val;

        $tutorials = Tutorial::where('title', 'like', '%' . $value . '%')
            ->paginate(9);

        return view('tutorial.index', ['title' => 'tutorials', 'tutorials' => $tutorials]);
    }
}
