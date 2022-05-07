<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveyStudent;
use App\Models\SurveyTeacher;
use Auth;
use DB;

class SurveyController extends Controller
{
  public function listSiswa()
  {

  }
  public function storeStudent(Request $r)
  {
    $input = $r->all();

    // dd($input['q1_keterangan']);
    DB::beginTransaction();
    try {
      $s = new SurveyStudent();
      $s->tgl = date('Y-m-d H:i:s');
      $s->q1 = $input['q1'];
      $s->q1_keterangan = $input['q1_keterangan'];
      $s->q2 = $input['q2'];
      $s->q3 = $input['q3'];
      $s->q4 = $input['q4'];
      $s->suhu_tubuh = $input['suhu_tubuh'];
      $s->is_student = 1;
      $s->induk_global = Auth::user()->no_induk_siswa_global;
      $s->save();
      DB::commit();

      if ($input['q1'] == 1 && $input['q2'] == 1 && $input['q3'] == 1 && $input['suhu_tubuh'] <= 37.3) {
        $s->status = 1;
        DB::commit();
        return redirect('home')->with('success','You Pass the qualification for today');
      }else {
        $s->status = 0;
        DB::commit();
        return redirect('home')->with('error','Better take a rest for today');
      }
    } catch (\Exception $e) {
      return $e;
      DB::rollback();
    }


  }

  public function storeTeacher(Request $r)
  {
    $input = $r->all();

    // dd($input['q1_keterangan']);
    DB::beginTransaction();
    try {
      $s = new SurveyTeacher();
      $s->tgl = date('Y-m-d H:i:s');
      $s->q1 = $input['q1'];
      $s->q1_keterangan = $input['q1_keterangan'];
      $s->q2 = $input['q2'];
      $s->q3 = $input['q3'];
      $s->q4 = $input['q4'];
      $s->suhu_tubuh = $input['suhu_tubuh'];
      $s->is_student = 0;
      $s->user_id = Auth::user()->id;
      $s->save();
      DB::commit();

      if ($input['q1'] == 1 && $input['q2'] == 1 && $input['q3'] == 1 && $input['q4'] == 1) {
        $s->status = 1;
        DB::commit();
        return redirect('teacher')->with('success','Welcome to Elyon Christian School');
      }else {
        $s->status = 0;
        DB::commit();
        return redirect('teacher')->with('error','Better take a rest for today');
      }
    } catch (\Exception $e) {
      return $e;
      DB::rollback();
    }
  }
}
