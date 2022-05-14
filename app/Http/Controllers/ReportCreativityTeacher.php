<?php

namespace App\Http\Controllers;

use App\Models\CreativityTeacher;
use Illuminate\Http\Request;

class ReportCreativityTeacher extends Controller
{
    public function index()
    {
      //$cls = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
      //$fit_time = FitTime::get();
      // $data = Custom::getDataCreativity();
      $data = CreativityTeacher::get();
     
      return view('creativity_teacher.index')->with('data',$data);
    }
}
