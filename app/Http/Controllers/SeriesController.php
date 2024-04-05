<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
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
        $series = $this->seriesRepository->add($request);

        $userList = User::all();
        foreach ($userList as $index => $user) {
            $email = new SeriesCreated(
                $series->id,
                $series->name,
                $request->seasonsQty,
                $request->episodesPerSeason,
            );

            $when = now()->addSeconds($index * 5);
            Mail::to($user)->later($when, $email);
        }

    
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
