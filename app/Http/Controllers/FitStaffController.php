<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custom;
use Auth;
use App\Models\FitTestStaff;
use DB;

class FitStaffController extends Controller
{

  public function index()
  {
    $check_period = DB::connection('mysql2')->select("select * from fit_time where ((? between start_date and end_date) or end_date = ?)
    and deleted_at is null order by id desc
    limit 1",array(date('Y-m-d'),date('Y-m-d')));

    if (empty($check_period)) {
      return redirect('teacher')->with('error','Jadwal Fit Belum Ada !');
    }else {
      $check_input = DB::connection('mysql2')->select("select * from fit_test
      where
      user_id = ?
      and deleted_at is null and fit_time_id = ?",array(
        auth()->user()->id,
        $check_period[0]->id));
        if (empty($check_input)) {
          return view('fit_staff.index')->with('fit_id',$check_period[0]->id)->with('success','Berhasil Mengisi test !');
        }else {
          return view('fit_staff.index')->with('fit_id',$check_period[0]->id)->with('data',$check_input);
        }
      }
    }

    public function create()
    {
      $check_period = DB::connection('mysql2')->select("
      select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));

      // dd($check_period);
      if (empty($check_period)) {
        $temp_fit = null;
        $deadline = null;
        $check_input = null;
        return view('fit.index')->with('error','Tidak ada jadwal test');
      }else {
        $temp_fit = $check_period[0]->id;
        $deadline = $check_period[0]->end_date;
        $check_input = DB::connection('mysql2')->select("select * from
        fit_test where user_id = ?
        and deleted_at is null and fit_time_id = ?",array(auth()->user()->id,
        $check_period[0]->id));
      }

      $count_input = DB::connection('mysql2')->select("select count(nik) as total from fit_test
      where deleted_at is null and (user_id = ? or nik = ?)
      GROUP BY nik",array(auth()->user()->id,auth()->user()->nik));

     // dd($count_input);
      return view('fit_staff.create')->with('fit_id',$temp_fit)
      ->with('deadline',$deadline)
      ->with('count_input',$count_input);

      // return view('fit_staff.create')->with('fit_id',$temp_fit)
      // ->with('deadline',$deadline)
      // ->with('data',$check_input);
    }

    public function store(Request $r)
    {
      $input = $r->all();

      $gender = ((auth()->user()->gender == 'WANITA/FEMALE') ? 1 : 0 );
      $nilai_1 = DB::connection('mysql2')->select("select * from penilaian_aktivitas
      where nama_penilaian = 'Shuttle_run'
      and (? BETWEEN usia_start and usia_end)
      and gender = ?
      and (? between start and end)",array($input['usia'],
      $gender,floatval($input['test_1'])));

      if (empty($nilai_1)) {
        $n1 = 1;
      }else {
        $n1 = $nilai_1[0]->skor;
      }



      $check1 = DB::connection('mysql2')->select("select * from penilaian_aktivitas where
      nama_penilaian = 'Stork_stand'
      and (? BETWEEN usia_start and usia_end)
      and gender = ?
      and (? >= start)
      ORDER BY start desc
      limit 1
      ",array($input['usia'],$gender,(float)$input['test_2']));

      $nilai_2 = DB::connection('mysql2')->select("select * from penilaian_aktivitas
      where nama_penilaian = 'Stork_stand'
      and (? BETWEEN usia_start and usia_end)
      and gender = ?
      and (? between start and end) limit 1",array($input['usia'],$gender,
      floatval($input['test_2'])));

      if (!empty($check1)) {
        $n2 = 4;
      }else {
        if (empty($nilai_2)) {
          $n2 = 1;
        }else {
          $n2 = $nilai_2[0]->skor;
        }
      }



      $temp3 = $input['test_3_1'];

      $nilai_3 = DB::connection('mysql2')->select("
      select * from penilaian_aktivitas
      where nama_penilaian = 'Push_up'
      and (? BETWEEN usia_start and usia_end)
      and gender = ?
      and (? between start and end)",array($input['usia'],$gender,floatval($temp3)));

      if (empty($nilai_3)) {
        $n3 = 1;
      }else {
        $n3 = $nilai_3[0]->skor;
      }






      $nilai4 = DB::connection('mysql2')->select("select *
      from penilaian_aktivitas
      where nama_penilaian = 'Plank'
      and (? BETWEEN usia_start and usia_end)
      and gender = ?
      and (? between start and end )",array($input['usia'],$gender,
      floatval($input['test_4_1'])));

      if (!empty($nilai4)) {
        $n4 = $nilai4[0]->skor;
      }else {
        $n4 = 1;
      }


      $check5 = DB::connection('mysql2')->select("select * from penilaian_aktivitas where
      nama_penilaian = 'Squat'
      and (? BETWEEN usia_start and usia_end)
      and gender = ?
      and (? >= start)
      ORDER BY start desc
      limit 1
      ",array($input['usia'],$gender,(float)$input['test_4_2']));

      $nilai_5 = DB::select("select * from penilaian_aktivitas
      where nama_penilaian = 'Squat'
      and (? BETWEEN usia_start and usia_end)
      and gender = ?
      and (? between start and end)",array($input['usia'],$gender,floatval($input['test_4_2'])));

      if (!empty($check5)) {
        $n5 = 4;
      }else {
        if (empty($nilai_5)) {
          $n5 = 1;
        }else {
          $n5 = $nilai_5[0]->skor;
        }
      }

      $total = $n1 + $n2 + $n3 + $n4 + $n5;
      if (($total >= 17) && ($total <= 20)) {
        $n6 = 4;
      }elseif (($total >= 13) && ($total <= 16)) {
        $n6 = 3;
      }elseif (($total >= 9) && ($total <= 12)) {
        $n6 = 2;
      }else {
        $n6 = 1;
      }


      $bmi= (floatval($input['berat_badan']) / (floatval($input['tinggi_badan']) * floatval($input['tinggi_badan'])));

      $obese = DB::connection('mysql2')->select("select *
      from penilaian_aktivitas where deleted_at is null and nama_penilaian='BMI'
      and (? >= start) and gender = ?
      ORDER BY start desc
      limit 1
      ",array($bmi,$gender));

      $underweight = DB::connection('mysql2')->select("select * from
      penilaian_aktivitas where deleted_at is null and nama_penilaian='BMI'
      and (? <= start) and gender = ?
      limit 1
      ",array($bmi,$gender));

      $hint = DB::connection('mysql2')->select("select * from penilaian_aktivitas where deleted_at is null and nama_penilaian='BMI'
      and gender = ? and (? between end and start)",array(auth()->user()->gender,$bmi));

      if (!empty($underweight)) {
        $cat = $underweight[0]->kriteria;
      }elseif (!empty($obese)) {
        $cat =  $obese[0]->kriteria;
      }else {
        $cat = $hint[0]->kriteria;
      }

      // dd($cat);
      DB::beginTransaction();
      try {
        $f = new FitTestStaff();
        $f->user_id = auth()->user()->id;
        $f->fit_time_id = $input['fit_id'];
        $f->jenis_kelamin = $input['jenis_kelamin'];
        $f->nik = auth()->user()->ktp;
        $f->nip = auth()->user()->nip;
        $f->syscabang_id =   auth()->user()->syscabang_id;
        $f->usia = $input['usia'];
        $f->tinggi_badan = $input['tinggi_badan'];
        $f->berat_badan = $input['berat_badan'];
        $f->bmi = $bmi;
        $f->test_1 = $input['test_1'];
        $f->nilai_test_1 = $n1;
        $f->test_2 = $input['test_2'];
        $f->nilai_test_2 = $n2;
        $f->nilai_test_3 = $n3;
        $f->test_3_1 = $input['test_3_1'];
        $f->nilai_test_4 = $n4;
        $f->test_4_1 = $input['test_4_1'];
        $f->test_4_2 = $input['test_4_2'];
        $f->nilai_test_4_2 = $n5;
        $f->total_point = $n1 + $n2 + $n3 + $n4 + $n5;
        $f->hasil = $n6;
        $f->category = $cat;
        if ($n6 == 1) {
          $f->classification = "Need Improvement";
        }elseif ($n6 == 2) {
          $f->classification = "Satisfactory";
        }elseif ($n6 == 3) {
          $f->classification = "Good";
        }else {
          $f->classification = "Excelent";
        }
        $f->save();
        DB::commit();
        return redirect('fit_staff')->with('success','filling form thank you');
      } catch (\Exception $e) {
        DB::rollback();
        return $e;
      }



    }
  }
