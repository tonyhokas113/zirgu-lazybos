<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use Illuminate\Http\Request;
use Validator;

class HorseController extends Controller
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
    public function index(Request $request)
    {
        $dir = 'asc';
        $sort = 'name';
        $horses = Horse::all();

        if ($request->sort_by && $request->dir) {
            if ('name' == $request->sort_by && 'asc' == $request->dir) {
                $horses = Horse::orderBy('name')->get();
            } elseif ('name' == $request->sort_by && 'desc' == $request->dir) {
                $horses = Horse::orderBy('name', 'desc')->get();
                $dir = 'desc';
            } elseif ('wins' == $request->sort_by && 'asc' == $request->dir) {
                $horses = Horse::orderBy('wins')->get();
                $sort = 'wins';
            } elseif ('wins' == $request->sort_by && 'desc' == $request->dir) {
                $horses = Horse::orderBy('wins', 'desc')->get();
                $dir = 'desc';
                $sort = 'wins';
            } else {
                $horses = Horse::all();
            }
        }


        return view('horse.index', [
            'horses' => $horses,
            'dir' => $dir,
            'sort' => $sort,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'horse_name' => ['required', 'min:3', 'max:100'],
                'horse_runs' => ['required', 'min:1', 'max:4'],
                'horse_wins' => ['required', 'min:1', 'max:4'],
                'horse_about' => ['required'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $horse = new Horse;
        $horse->name = $request->horse_name;
        $horse->runs = $request->horse_runs;
        $horse->wins = $request->horse_wins;
        $horse->about = $request->horse_about;
        $horse->save();
        return redirect()->route('horse.index')->with('success_message', 'New horse was created');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(Horse $horse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(Horse $horse)
    {
        return view('horse.edit', ['horse' => $horse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horse $horse)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'horse_name' => ['required', 'min:3', 'max:100'],
                'horse_runs' => ['required', 'min:1', 'max:4'],
                'horse_wins' => ['required', 'min:1', 'max:4'],
                'horse_about' => ['required'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $horse->name = $request->horse_name;
        $horse->runs = $request->horse_runs;
        $horse->wins = $request->horse_wins;
        $horse->about = $request->horse_about;
        $horse->save();
        return redirect()->route('horse.index')->with('success_message', 'Information was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horse $horse)
    {
        if ($horse->horseHorse->count()) {
            return redirect()->back()->with('info_message', 'We can\'t delete this horse, because it has an active bet on him');
        }
        $horse->delete();
        return redirect()->route('horse.index')->with('success_message', 'Horse was deleted');
    }
}
