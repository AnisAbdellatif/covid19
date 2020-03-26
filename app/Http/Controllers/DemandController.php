<?php

namespace App\Http\Controllers;

use App\Demand;
use Illuminate\Http\Request;

class DemandController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:access-demands-page', ['only' => ['index',]]);
    }

    public function index()
    {
        $demands = Demand::where('finished', '0')
                         ->where('taken', '0')
                         ->get()
                         ->sortByDesc('created_at');
        if(! auth()->user()->hasRole(... ['superadmin', 'admin'])) {
            $demands = $demands->filter(function ($demand) {
                return $demand->user()->first()->country == auth()->user()->country;
            });
        }
        return view('demands.index', compact('demands'));
    }

    public function create()
    {
        return view('demands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $demand = Demand::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);


        return redirect()->route('home');
    }

    public function update(Request $request, $lang, $id)
    {
        $demand = Demand::findOrFail($id);
        if(isset($request->take))
        {
            $demand->taken = 1;
            $demand->taken_by = auth()->user()->id;
        }
        elseif (isset($request->finish))
        {
            $demand->finished = 1;
        }
        $demand->save();

        return back();
    }

    public function taken(Request $request, $lang)
    {
        $demands = Demand::where('taken', '1')
                         ->where('finished', '0')
                         ->where('taken_by', auth()->user()->id)
                         ->get()
                         ->sortByDesc('created_at');

        return view('demands.index', compact('demands'));
    }

    public function destroy($lang, $id)
    {
        Demand::destroy($id);
        return back();
    }
}
