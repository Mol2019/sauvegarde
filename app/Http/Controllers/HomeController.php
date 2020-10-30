<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Repertoire;
use App\Models\User;
use App\Models\Trace;
use Illuminate\Support\Collection;

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
        $data = new Collection;

        $view = "app.se.home";

        if(Auth::user()->role == "ad") :
          $data->count_users = User::all()->count();
          $data->rep_count = Repertoire::all()->count();
          $data->traces = Trace::latest()->get();
          $view = "app.ad.home";
        endif;

        return view($view,compact('data'));
    }
}
