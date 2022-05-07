<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveyStudent;
use App\Models\Custom;
use Auth;

class BukuTamuController extends Controller
{
    public function bukuTamu()
    {
      $data = SurveyStudent::where('is_student','=',0)->get();
      return view('report.bukutamu')->with('data',$data);
    }

    public function Siswa()
    {
      $data = Custom::getSiswa(Auth::user()->nip);
      return view('report.siswa')->with('data',$data);
    }

    public function kesehatan()
    {
      $data = Custom::getKesehatan();
      return view('report.kesehatan')->with('data',$data);
    }
}
