<?php

namespace App\Http\Controllers;

use App\UserWorkshop;
use Illuminate\Http\Request;
use App\Workshop;
use Carbon\Carbon;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workshops = Workshop::whereDate('date', '>', Carbon::now())
            ->paginate(8);
        return view('workshop.index', ['title' => 'Workshops', 'workshops' => $workshops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workshop.create')->with('title', 'Create');
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
            'info' => 'required',
            'price' => 'required',
            'place' => 'required',
            'date' => 'required'
        ]);

        $workshop = new Workshop;
        $workshop->title = $request->input('title');
        $workshop->info = $request->input('info');
        $workshop->price = $request->input('price');
        $workshop->date = $request->input('date');
        $workshop->place = $request->input('place');
        $workshop->user_id = auth()->user()->id;
        $workshop->save();

        return redirect('workshop')->with('success', 'Workshop created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $join = UserWorkshop::where('user_id', auth()->user()->id)
            ->where('workshop_id', $id)
            ->count();
        $data = UserWorkshop::where('workshop_id', $id)->get();
        $workshop = Workshop::find($id);
        return view('workshop.show', ['title' => $workshop->title,
            'workshop' => $workshop,
            'data' => $data,
            'join' => $join]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workshop = Workshop::find($id);

        return view('workshop.update', ['workshop' => $workshop, 'title' => 'Edit']);
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
            'info' => 'required',
            'price' => 'required',
            'place' => 'required',
            'date' => 'required'
        ]);

        $workshop = Workshop::find($id);
        $workshop->title = $request->input('title');
        $workshop->info = $request->input('info');
        $workshop->price = $request->input('price');
        $workshop->date = $request->input('date');
        $workshop->place = $request->input('place');
        $workshop->save();

        return redirect('/workshop')->with('success', 'Workshop updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserWorkshop::where('workshop_id', $id)->delete();

        $workshop = Workshop::find($id);
        $workshop->delete();

        return redirect('workshop')->with('success', 'Workshop deleted');
    }

    public function join($id)
    {
        $workshop = Workshop::find($id);
        $count = UserWorkshop::where('workshop_id', $id)->count();
        if($workshop->place <= $count){
            return redirect('workshop')->with('error', 'No more place');
        }

        $userwork = new UserWorkshop();
        $userwork->user_id = auth()->user()->id;
        $userwork->workshop_id = $id;
        $userwork->created_at = Carbon::now();
        $userwork->save();

        return redirect('workshop')->with('success', 'Joined successfly');
    }

    public function leave($id)
    {
        $userwork = UserWorkshop::where('workshop_id', $id)->where('user_id', auth()->user()->id);
        $userwork->delete();

        return redirect('workshop')->with('success', 'Leave successfly');
    }
}
