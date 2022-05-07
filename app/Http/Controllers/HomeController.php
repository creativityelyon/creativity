<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\SurveyStudent;

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
      // dd(Auth::user());
        $data = SurveyStudent::where('induk_global','=',Auth::user()->no_induk_siswa_global)
        ->whereDate('tgl',date('Y-m-d'))
        ->orderBy('created_at','desc')
        ->first();
        return view('home')->with('data',$data);
    }
}
