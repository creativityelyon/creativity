<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kesehatan;
use Auth;
use DB;
use App\Models\KesehatanGuru;

class SurveyKesehatanController extends Controller
{
  public function indexGuru()
  {
    $check = KesehatanGuru::where('nip','=',Auth::user()->nip)->first();
    if (empty($check)) {
      return view('teacher.kesehatan');
    }else {
      return view('jajak.done');
    }
  }


  public function postGuru(Request $r)
  {
    $input = $r->all();

    $r->validate([
      'nama_lengkap' => 'required',
      'umur' => 'required',
      'is_covid' => 'required',
      'is_hipertensi' => 'required',
      'is_diabet' => 'required',
      'is_imuno' => 'required',
      'is_jantung' => 'required',
      'is_paru' => 'required',
      'is_cancer' => 'required',
      'q2' => 'required',
      'q3' => 'required',
      'q5' => 'required',
      'q4' => 'required'
    ]);


    DB::beginTransaction();
    try {

      $s = new KesehatanGuru();
      $s->tgl = date('Y-m-d');
      $s->user_id = Auth::user()->id;
      $s->nip = Auth::user()->nip;
      $s->nama = $input['nama_lengkap'];
      $s->is_covid = $input['is_covid'];
      $s->is_hipertensi= $input['is_hipertensi'];
      $s->is_diabet = $input['is_diabet'];
      $s->is_imuno = $input['is_imuno'];
      $s->is_jantung = $input['is_jantung'];
      $s->is_paru = $input['is_paru'];
      $s->is_cancer = $input['is_cancer'];
      $s->q2= $input['q2'];
      $s->q2_keterangan= $input['keterangan_riwayat'];
      $s->q5= $input['q5'];
      $s->q3= $input['q3'];
      $s->q4= $input['q4'];
      $s->save();
      DB::commit();

      return redirect()->back()->with('success','Thank you for filling the health survey');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }

  }

  public function index()
  {
    $check = Kesehatan::where('no_induk_siswa_global','=',Auth::user()->no_induk_siswa_global)->first();
    if (empty($check)) {
      return view('survey.index');
    }else {
      return view('jajak.done');
    }
  }

  public function store(Request $r)
  {
    $input = $r->all();

    $r->validate([
      'nama_lengkap' => 'required',
      'no_induk_siswa_global' => 'required',
      'umur' => 'required',
      'lokasi' => 'required',
      'is_covid' => 'required',
      'is_hipertensi' => 'required',
      'is_diabet' => 'required',
      'is_imuno' => 'required',
      'is_jantung' => 'required',
      'is_paru' => 'required',
      'is_cancer' => 'required',
      'q2' => 'required',
      'q3' => 'required',
      'q5' => 'required',
      'q4' => 'required'
    ]);


    DB::beginTransaction();
    try {

      $s = new Kesehatan();
      $s->tgl = date('Y-m-d');
      $s->user_id = Auth::user()->id;
      $s->no_induk_siswa_global = $input['no_induk_siswa_global'];
      $s->nama = $input['nama_lengkap'];
      $s->kelas = $input['kelas'];
      $s->unit = $input['lokasi'];
      $s->grade = $input['grade'];
      $s->is_covid = $input['is_covid'];
      $s->is_hipertensi= $input['is_hipertensi'];
      $s->is_diabet = $input['is_diabet'];
      $s->is_imuno = $input['is_imuno'];
      $s->is_jantung = $input['is_jantung'];
      $s->is_paru = $input['is_paru'];
      $s->is_cancer = $input['is_cancer'];
      $s->q2= $input['q2'];
      $s->q2_keterangan= $input['keterangan_riwayat'];
      $s->q5= $input['q5'];
      $s->q3= $input['q3'];
      $s->q3_ket= $input['q3_ket'];
      $s->q3_ket_ket= $input['q3_ket_ket'];
      $s->q4= $input['q4'];
      $s->ket_vaksin_1= $input['ket_vaksin_1'];
      $s->ket_vaksin_2= $input['ket_vaksin_2'];
      $s->why_not_vaksin= $input['why_not_vaksin'];
      $s->pcr_date_covid= date('Y-m-d',strtotime($input['pcr_date_covid']));
      $s->save();
      DB::commit();

      return redirect()->back()->with('success','Thank you for filling the health survey');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }

  }
}
