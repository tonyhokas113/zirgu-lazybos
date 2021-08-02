<?php

namespace App\Http\Controllers;

use App\Models\Better;
use Illuminate\Http\Request;
use App\Models\Horse;
use Validator;

class BetterController extends Controller
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
        $betters = Better::all();
        $horses = Horse::all();
        $defaultHorse = 0;
        $s = '';

        if ($request->sort_by && $request->dir) {
            if ('name' == $request->sort_by && 'asc' == $request->dir) {
                $betters = Better::orderBy('name')->get();
            } elseif ('name' == $request->sort_by && 'desc' == $request->dir) {
                $betters = Better::orderBy('name', 'desc')->get();
                $dir = 'desc';
            } elseif ('bet' == $request->sort_by && 'asc' == $request->dir) {
                $betters = Better::orderBy('bet')->get();
                $sort = 'bet';
            } elseif ('bet' == $request->sort_by && 'desc' == $request->dir) {
                $betters = Better::orderBy('bet', 'desc')->get();
                $dir = 'desc';
                $sort = 'bet';
            } else {
                $betters = Better::all();
            }
        } elseif ($request->horse_id) {
            $betters = Better::where('horse_id', (int)$request->horse_id)->get();
            $defaultHorse = (int)$request->horse_id;
        } elseif ($request->s) {
            $betters = Better::where('name', 'like', '%' . $request->s . '%')->get();
            $s = $request->s;
        } elseif ($request->do_search) {
            $betters = Better::where('name', 'like', '')->get();
        } else {
            $betters = Better::all();
        }

        return view('better.index', [
            'betters' => $betters,
            'dir' => $dir,
            'sort' => $sort,
            'horses' => $horses,
            'defaultHorse' => $defaultHorse,
            's' => $s,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horses = Horse::all();
        return view('better.create', ['horses' => $horses]);
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
                'better_name' => ['required', 'min:3', 'max:100'],
                'better_surname' => ['required', 'min:3', 'max:150'],
                'better_bet' => ['required', 'min:1', 'max:7'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $better = new Better;
        $better->name = $request->better_name;
        $better->surname = $request->better_surname;
        $better->bet = $request->better_bet;
        $better->horse_id = $request->horse_id;
        $better->save();
        return redirect()->route('better.index')->with('success_message', 'New bet was successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function show(Better $better)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function edit(Better $better)
    {
        $horses = Horse::all();
        return view('better.edit', ['better' => $better, 'horses' => $horses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Better $better)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'better_name' => ['required', 'min:3', 'max:100'],
                'better_surname' => ['required', 'min:3', 'max:150'],
                'better_bet' => ['required', 'min:1', 'max:7'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $better->name = $request->better_name;
        $better->surname = $request->better_surname;
        $better->bet = $request->better_bet;
        $better->horse_id = $request->horse_id;
        $better->save();
        return redirect()->route('better.index')->with('success_message', 'Information was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(Better $better)
    {
        $better->delete();
        return redirect()->route('better.index')->with('success_message', 'Bet was deleted');
    }
}
