<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Series::query()->orderBy("name")->get();
        $successMessage = $request->session()->get("message.success");

        return view('series.index')
            ->with('series', $series)
            ->with('successMessage', $successMessage);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $series = Series::create($request->all());

        return to_route('series.index')
            ->with('message.success',"Series '{$series->name}' added succesfully!");
    }

    public function destroy(Series $series)
    {
        $series->delete();
        
        return to_route('series.index')
            ->with('message.success',"Series '{$series->name}' removed succesfully!");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('series', $series);
    }

    public function update(Series $series, Request $request)
    {
        $series->name = $request->name;
        $series->save();

        return to_route('series.index')
            ->with('message.success',"Series edited succesfully!");;
    }
}
