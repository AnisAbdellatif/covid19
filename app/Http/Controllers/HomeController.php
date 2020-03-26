<?php

namespace App\Http\Controllers;

use App\Demand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd(asset('/'));
        $demands = Demand::where('user_id', auth()->user()->id)
                         ->orderBy('created_at', 'desc')
                         ->get();
        return view('home', compact('demands'));
    }
}
