<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Lomba;
use DB;
use App\Models\Custom;

class LombaController extends Controller
{
  public function index()
  {
    $check = Lomba::where('no_induk_siswa_global','=',Auth::user()->no_induk_siswa_global)->first();

    // dd($check);
    return view('lomba.index')->with('check',$check);
  }

  public function store(Request $request)
  {
    $input = $request->all();

    if ($input['lomba'] == '2' && $input['kelas_lomba'] == 'B') {
      return redirect()->back()->with('error','Sorry No Class B for Mandarin !');
    }

    $check = DB::select("select count(l.id) as hasil from lomba l where l.lomba = ?",array($input['lomba']));


    if ($check[0]->hasil > 30) {
      return redirect()->back()->with('error','Sorry Quota Full !');
    }
    // dd('error here');

    DB::beginTransaction();
    try {
      $s = new Lomba();
      $s->tgl = date('Y-m-d');
      $s->no_induk_siswa_global = Auth::user()->no_induk_siswa_global;
      $s->kelas = $input['kelas'];
      $s->nama = $input['nama_lengkap'];
      $s->lokasi = Auth::user()->lokasi;
      $s->lomba = $input['lomba'];
      $s->kelas_lomba = $input['kelas_lomba'];
      $s->created_by = Auth::user()->id;
      $s->save();
      DB::commit();
      return redirect()->back()->with('success','You Success Fill The Competion Register');

    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }


  }

  public function indexReport()
  {
    $d = Custom::getDetailLaporanLomba();
    $d2 = Custom::getDetailLaporanLomba2();
    return view('report.lomba')
    ->with('data2',$d2)
    ->with('data',$d);
  }


}
