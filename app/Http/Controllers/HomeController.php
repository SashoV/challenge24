<?php

namespace App\Http\Controllers;

use App\Vehicle;
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
        return view('home');
    }

    public function create()
    {
        return view('create');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('edit',['vehicle' => $vehicle]);
    }
}
