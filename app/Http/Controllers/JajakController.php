<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Jajak;
use App\Models\Pernyataan;
use App\Models\Custom;

class JajakController extends Controller
{

  public function indexReport()
  {
    $count_total = Custom::getCountTotalElyon();
    $count_app = Custom::getCountTotalAccept();
    $count_rej = Custom::getCountTotalReject();
    $count_skip = Custom::getCountTotalNotFill();
    $count_pgkg_suko = Custom::getCountTotalPGKGSuko();
    $count_pgkg_kit = Custom::getCountTotalPGKGKIT();
    $count_prim_suko = Custom::getCountTotalPriSuko();
    $count_sec_darmo = Custom::getCountTotalSecDarmo();
    $count_hs_darmo = Custom::getCountTotalHsDarmo();
    $count_pgkg_suko_app = Custom::getCountTotalPGKGSUKOAccept();
    $count_pgkg_suko_rej = Custom::getCountTotalPGKGSUKOReject();
    $count_pgkg_kit_app = Custom::getCountTotalPGKGKitAccept();
    $count_pgkg_kit_rej = Custom::getCountTotalPGKGKitRefuse();
    $count_prim_suko_app = Custom::getCountTotalPriSukoAccept();
    $count_prim_suko_rej = Custom::getCountTotalPriSukoRefuse();
    $count_sec_darmo_app = Custom::getCountTotalSecDarmoAccept();
    $count_sec_darmo_rej = Custom::getCountTotalSecDarmoReject();
    $count_hs_darmo_app = Custom::getCountTotalHsDarmoAccept();
    $count_hs_darmo_rej = Custom::getCountTotalHsDarmoRefuse();
    $count_pgkg_suko_skip = Custom::getCountTotalPGKGSUKOSkip();
    $count_pgkg_kit_skip = Custom::getCountTotalPGKGKitSkip();
    $count_prim_suko_skip = Custom::getCountTotalPriSukoSkip();
    $count_sec_darmo_skip = Custom::getCountTotalSecDarmoSkip();
    $count_hs_darmo_skip = Custom::getCountTotalHsDarmoSkip();

    return view('report.reportjajak')->with('count_total',$count_total[0]->total)
    ->with('count_app',$count_app[0]->total)
    ->with('count_rej',$count_rej[0]->total)
    ->with('count_skip',$count_skip[0]->total)
    ->with('count_pgkg_suko',$count_pgkg_suko[0]->total)
    ->with('count_pgkg_kit',$count_pgkg_kit[0]->total)
    ->with('count_prim_suko',$count_prim_suko[0]->total)
    ->with('count_sec_darmo',$count_sec_darmo[0]->total)
    ->with('count_hs_darmo',$count_hs_darmo[0]->total)
    ->with('count_pgkg_suko_app',$count_pgkg_suko_app[0]->total)
    ->with('count_pgkg_suko_rej',$count_pgkg_suko_rej[0]->total)
    ->with('count_pgkg_kit_app',$count_pgkg_kit_app[0]->total)
    ->with('count_pgkg_kit_rej',$count_pgkg_kit_rej[0]->total)
    ->with('count_prim_suko_app',$count_prim_suko_app[0]->total)
    ->with('count_prim_suko_rej',$count_prim_suko_rej[0]->total)
    ->with('count_sec_darmo_app',$count_sec_darmo_app[0]->total)
    ->with('count_sec_darmo_rej',$count_sec_darmo_rej[0]->total)
    ->with('count_hs_darmo_app',$count_hs_darmo_app[0]->total)
    ->with('count_pgkg_suko_skip',$count_pgkg_suko_skip[0]->total)
    ->with('count_pgkg_kit_skip',$count_pgkg_kit_skip[0]->total)
    ->with('count_prim_suko_skip',$count_prim_suko_skip[0]->total)
    ->with('count_sec_darmo_skip',$count_sec_darmo_skip[0]->total)
    ->with('count_hs_darmo_skip',$count_hs_darmo_skip[0]->total)
    ->with('count_hs_darmo_rej',$count_hs_darmo_rej[0]->total);
  }
  public function index()
  {
    if (auth()->user()->id_level <= 4) {
      $check_period = DB::select("select * from periode_survey where
      ((? between start_date and end_date) or end_date = ?)
      and is_pgkg = 1
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));

    }elseif((auth()->user()->id_level >= 5) && (auth()->user()->id_level <= 10)){
      $check_period = DB::select("select * from periode_survey where
      ((? between start_date and end_date) or end_date = ?)
      and is_primary = 1
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }elseif((auth()->user()->id_level >= 11) and (auth()->user()->id_level <= 13))
    {
      $check_period = DB::select("select * from periode_survey where
      ((? between start_date and end_date) or end_date = ?)
      and is_secondary = 1
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }elseif ((auth()->user()->id_level >= 14) and (auth()->user()->id_level <= 16)) {
      $check_period = DB::select("select * from periode_survey where
      ((? between start_date and end_date) or end_date = ?)
      and is_hs = 1
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }

    // dd($check_period);
    if (empty($check_period)) {
      return redirect('home')->with('info','Bukan waktunya mengisi Jajak Pendapat');
    }
    $check = Jajak::where('no_induk_siswa_global','=',Auth::user()->no_induk_siswa_global)
    ->first();
    $check2 = Pernyataan::where('no_induk_siswa_global','=',Auth::user()->no_induk_siswa_global)->first();


    if (empty($check)) {
      return view('jajak.index');
    }else {
      if ($check->is_agree == 0 && empty($check2)) {
        return view('jajak.pernyataan');
      }else {
        return view('jajak.done');
      }
    }
  }

  public function storePernyataan(Request $r)
  {
    $input = $r->all();

    $r->validate([
      'parent_name' => 'required',
      'alamat' => 'required',
      'nik' => 'required',
      'pekerjaan' => 'required',
      'sig-dataUrl' => 'required',
      'alamat' => 'required',
      'nama_siswa' => 'required',
      'kelas' => 'required',
      'alamat_siswa' => 'required',
      'unit_sekolah' => 'required',
    ]);



    DB::beginTransaction();
    try {
      $s = new Pernyataan();
      $s->tgl = date('Y-m-d');
      $s->nama_parent = $input['parent_name'];
      $s->pekerjaan = $input['pekerjaan'];
      $s->alamat = $input['alamat'];
      $s->nik = $input['nik'];
      $s->no_induk_siswa_global = (Auth::user()->no_induk_siswa_global) ? Auth::user()->no_induk_siswa_global : null;
      $s->nama = $input['nama_siswa'];
      $s->alamat_siswa = $input['alamat_siswa'];
      $s->kelas = $input['kelas'];
      $s->unit = $input['unit_sekolah'];
      $s->user_id = Auth::user()->id;
      $s->signature_url= $input['sig-dataUrl'];
      $s->save();

      DB::commit();

      return redirect()->back()->with('success','Berhasil mengisi pernyataan');
    } catch (\Exception $e) {

      DB::rollback();
      return $e;
    }




  }

  public function store(Request $r)
  {

    $input = $r->all();

    $r->validate([
      'parent_name' => 'required',
      'alamat' => 'required',
      'sig-dataUrl' => 'required',
      'is_ijin'=>'required'
    ]);

    DB::beginTransaction();
    try {
      $s = new Jajak();
      $s->user_id = Auth::user()->id;
      $s->no_induk_siswa_global = Auth::user()->no_induk_siswa_global;
      $s->nama_parent = $input['parent_name'];
      $s->alamat = $input['alamat'];
      $s->nama_siswa = $input['nama_lengkap'];
      $s->kelas = Auth::user()->kelas;
      $s->grade = Auth::user()->grade;
      $s->is_agree = $input['is_ijin'];
      $s->signature_url = $input['sig-dataUrl'];
      $s->tgl = date('Y-m-d');
      $s->save();
      DB::commit();
      return redirect()->back()->with('success','Berhasil Mengisi Jajak Pendapat');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;

    }

  }
}
