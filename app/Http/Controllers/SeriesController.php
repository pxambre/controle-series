<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Series::query()->orderBy("name")->get();
        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        Series::create($request->all());

        return to_route('series.index');
    }

    public function destroy(Request $request)
    {
        Series::destroy($request->series);
        
        return to_route('series.index');
    }
}
