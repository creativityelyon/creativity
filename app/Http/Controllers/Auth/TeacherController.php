<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
//use Illuminate\Support\Facades\Hash;
use App\Models\SurveyTeacher;
use Auth;

class TeacherController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:teacher');
  }
  /**
  * show dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $data = SurveyTeacher::where('user_id','=',Auth::user()->id)
    ->whereDate('tgl',date('Y-m-d'))
    ->orderBy('created_at','desc')
    ->first();
    return view('teacher.dashboard')->with('data',$data);
  }
}
