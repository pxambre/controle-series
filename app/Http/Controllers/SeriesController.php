<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Http\Requests\SeriesFormRequest;
use App\Jobs\DeleteSeriesCover;
use App\Mail\SeriesCreated;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
        $this->middleware("auth")->except('index');
    }

    public function index(Request $request)
    {
        $series = Series::all();
        $successMessage = session()->get("success.message");

        return view('series.index')
            ->with('series', $series)
            ->with('successMessage', $successMessage);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $coverPath = $request->hasFile('cover') 
            ? $request->file('cover')->store('series_cover', 'public')
            : null;
        $request->coverPath = $coverPath;
        
        $series = $this->seriesRepository->add($request);
        SeriesCreatedEvent::dispatch(
            $series->id,
            $series->name,
            $request->seasonsQty,
            $request->episodesPerSeason
        );
    
        return to_route('series.index')
            ->with('success.message',"Series '{$series->name}' added succesfully!");
    }

    public function destroy(Series $series)
    {
        $series->delete();
        
        return to_route('series.index')
            ->with('success.message',"Series '{$series->name}' removed succesfully!");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('series', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('success.message',"Series edited succesfully!");;
    }
}
