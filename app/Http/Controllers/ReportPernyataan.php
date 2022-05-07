<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pernyataan;

class ReportPernyataan extends Controller
{
    public function index()
    {
      $data = Pernyataan::get();
      return view('report.pernyataan')->with('data',$data);
    }

    public function show($id)
    {
      $data = Pernyataan::find($id);

      return view('report.showpernyataan')->with('data',$data);
    }
}
