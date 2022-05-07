<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custom;
use Auth;
use App\Models\FitTest;
use DB;

class FitController extends Controller
{

  public function index()
  {
    if (auth()->user()->id_level <= 4) {
      $check_period = DB::select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and is_kg = 1
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));

    }else {
      $check_period = DB::select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }

    if (empty($check_period)) {
      return redirect('home')->with('error','Jadwal Fit Belum Ada !');
    }else {
      $check_input = DB::select("select * from fit_test where user_id = ?
      and deleted_at is null and fit_time_id = ? and nik=?",array(auth()->user()->id,
      $check_period[0]->id,auth()->user()->nik));

      if (empty($check_input)) {
        return view('fit.index')->with('fit_id',$check_period[0]->id)->with('success','Berhasil Mengisi test !');
      }else {
        return view('fit.index')->with('fit_id',$check_period[0]->id)->with('data',$check_input);
      }
    }

  }

  public function create()
  {
    if (auth()->user()->id_level <= 4) {
      $check_period = DB::select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and is_kg = 1
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }else {
      $check_period = DB::select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }


    if (empty($check_period)) {
      $temp_fit = null;
      $deadline = null;
      $check_input = null;
      return view('fit.index')->with('error','Tidak ada jadwal test');

    }else {
      $temp_fit = $check_period[0]->id;
      $deadline = $check_period[0]->end_date;
      $check_input = DB::select("select * from fit_test where
      (user_id = ? or nik = ?)
      and deleted_at is null and fit_time_id = ?",array(auth()->user()->id,auth()->user()->nik,
      $check_period[0]->id));

    }

    $count_input = DB::select("select count(nik) as total from fit_test
    where deleted_at is null and (user_id = ? or nik = ?)
    GROUP BY nik",array(auth()->user()->id,auth()->user()->nik));

    // dd($count_input);
    return view('fit.create')->with('fit_id',$temp_fit)
    ->with('deadline',$deadline)
    ->with('count_input',$count_input)

    ->with('data',$check_input);
  }

  public function createKG()
  {
    if (auth()->user()->id_level <= 4) {
      // dd('i am here');
      $check_period = DB::select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and is_kg = 1
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
      // dd($check_period);
    }else {
      DB::select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }
    // dd($check_period);
    if (empty($check_period)) {
      $temp_fit = null;
      $deadline = null;
      $check_input = null;
      return view('fit.index')->with('error','Tidak ada jadwal test');

    }else {
      $temp_fit = $check_period[0]->id;
      $deadline = $check_period[0]->end_date;
      $check_input = DB::select("select * from fit_test where user_id = ?
      and deleted_at is null and fit_time_id = ?",array(auth()->user()->id,
      $check_period[0]->id));
    }

    return view('fit.createkg')->with('fit_id',$temp_fit)
    ->with('deadline',$deadline)
    ->with('data',$check_input);
  }

  public function store(Request $r)
  {
    $input = $r->all();

    //penilaian shuttle run
    $ck = DB::select("select * from penilaian_aktivitas
    where nama_penilaian = 'Shuttle_run'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? <= start)
    and skor = 4
    ORDER BY start desc
    limit 1",
    array($input['usia'],auth()->user()->gender,(float)$input['test_1']));


    $nilai_1 = DB::select("select * from penilaian_aktivitas
    where nama_penilaian = 'Shuttle_run'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? between start and end)",array($input['usia'],
    auth()->user()->gender,floatval($input['test_1'])));

    if (!empty($ck)) {
        $n1 = 4;
    }else {
      if (empty($nilai_1)) {
        $n1 = 1;
      }else {
        $n1 = $nilai_1[0]->skor;
      }
    }
    //ending penilaian shuttle run

    // $check1 = DB::select("select * from penilaian_aktivitas where
    // nama_penilaian = 'Sit Up'
    // and (? BETWEEN usia_start and usia_end)
    // and gender = ?
    // and (? >= start)
    // and skor = 4
    // ORDER BY start desc
    // limit 1
    // ",    array($input['usia'],auth()->user()->gender,floatval($input['test_2'])));

    // $nilai_2 = DB::select("select * from penilaian_aktivitas
    // where nama_penilaian = 'Sit Up'
    // and (? BETWEEN usia_start and usia_end)
    // and gender = ?
    // and (? between start and end)",array($input['usia'],auth()->user()->gender,(float)$input['test_2']));

    //penilaian plank
    $check1 = DB::select("select * from penilaian_aktivitas where
    nama_penilaian = 'Plank'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? >= start)
    and skor = 4
    ORDER BY start desc
    limit 1
    ",    array($input['usia'],auth()->user()->gender,floatval($input['test_2'])));

    $nilai_2 = DB::select("select * from penilaian_aktivitas
    where nama_penilaian = 'Plank'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? between start and end)",array($input['usia'],auth()->user()->gender,(float)$input['test_2']));


    if (!empty($check1)) {
      $n2 = 4;
    }else {
      if (empty($nilai_2)) {
        $n2 = 1;
      }else {
        $n2 = $nilai_2[0]->skor;
      }
    }

    //ending penilaian plank
        //$temp3 = 0;
     $temp3 = $input['test_3_1'];

    // if ($input['test_3_1'] >= $input['test_3_2'] && $input['test_3_1'] >= $input['test_3_3']) {
    //   $temp3 = $input['test_3_1'];
    // }elseif ($input['test_3_1'] <= $input['test_3_2'] && $input['test_3_2'] >= $input['test_3_3']) {
    //   $temp3 = $input['test_3_2'];
    // }else {
    //   $temp3 = $input['test_3_3'];
    // }

    //penilaian Standing_broad_jump
    //$temp3 = $input['test_3_1'];

    $check3 = DB::select("select * from penilaian_aktivitas where nama_penilaian = 'Standing_broad_jump'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? >= start)
    and skor = 4
    ORDER BY start desc
    limit 1
    ",    array($input['usia'],auth()->user()->gender,(float)$temp3));

    $nilai_3 = DB::select("select * from penilaian_aktivitas
    where nama_penilaian = 'Standing_broad_jump'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? between start and end)",array($input['usia'],auth()->user()->gender,(float)$temp3));


    if (!empty($check3)) {
      $n3 = 4;
    }else {
      if (empty($nilai_3)) {
        $n3 = 1;
      }else {
        $n3 = $nilai_3[0]->skor;
      }
    }
    //end penilaian standing_broad_jump



    //penilaian strockstand
    $check4 = DB::select("select * from penilaian_aktivitas where
    nama_penilaian = 'Strockstand'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? >= start)
    and skor = 4
    ORDER BY start desc
    limit 1
    ",array($input['usia'],auth()->user()->gender,(float)$input['test_4_1']));

    $nilai_4 = DB::select("select * from penilaian_aktivitas
    where nama_penilaian = 'Strockstand'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? between start and end) limit 1",array($input['usia'],auth()->user()->gender,
    (float)$input['test_4_1']));



    if (!empty($check4)) {
      $n4 = 4;
    }else {
      if (empty($nilai_4)) {
        $n4 = 1;
      }else {
        $n4 = $nilai_4[0]->skor;
      }
    }
    //ending penilaian strockstand

    // $check5 = DB::select("select * from penilaian_aktivitas where nama_penilaian = 'Strockstand'
    // and (? BETWEEN usia_start and usia_end)
    // and gender = ?
    // and (? >= start)
    // and skor = 4
    // ORDER BY start desc
    // limit 1
    // ",array($input['usia'],auth()->user()->gender,(float)$input['test_4_2']));

    // $nilai_5 = DB::select("select * from penilaian_aktivitas
    // where nama_penilaian = 'Strockstand'
    // and (? BETWEEN usia_start and usia_end)
    // and gender = ?
    // and (? between start and end)",array($input['usia'],auth()->user()->gender,(float)$input['test_4_2']));

    // if (!empty($check5)) {
    //   $n5 = 4;
    // }else {
    //   if (empty($nilai_5)) {
    //     $n5 = 1;
    //   }else {
    //     $n5 = $nilai_5[0]->skor;
    //   }
    // }


   // $total = $n1 + $n2 + $n3 + $n4 + $n5;
   $total = $n1 + $n2 + $n3 + $n4;

    // dd($total);
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

    $obese = DB::select("select * from penilaian_aktivitas where
    deleted_at is null and nama_penilaian='BMI'
    and (? >= start) and gender = ?
    ORDER BY start desc
    limit 1
    ",array($bmi,auth()->user()->gender));

    $underweight = DB::select("select * from penilaian_aktivitas where deleted_at is null and nama_penilaian='BMI'
    and (? <= start) and gender = ?
    limit 1
    ",array($bmi,auth()->user()->gender));

    $hint = DB::select("select * from penilaian_aktivitas where deleted_at is null and nama_penilaian='BMI'
    and gender = ? and (? between end and start)",array(auth()->user()->gender,$bmi));

    if (!empty($underweight)) {
      $cat = $underweight[0]->kriteria;
    }elseif (!empty($obese)) {
      $cat =  $obese[0]->kriteria;
    }else {
      $cat = $hint[0]->kriteria;
    }

    // dd($cat);

    $f = new FitTest();
    $f->user_id = auth()->user()->id;
    $f->nik = auth()->user()->nik;
    $f->id_kelas = auth()->user()->id_kelas;
    $f->homeroom = auth()->user()->nama_guru_home_room;
    $f->id_level = auth()->user()->id_level;
    $f->fit_time_id = $input['fit_id'];
    $f->jenis_kelamin = $input['jenis_kelamin'];
    $f->kelas = $input['kelas'];
    $f->lokasi = auth()->user()->lokasi;
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
    // $f->test_3_2 = $input['test_3_2'];
    // $f->test_3_3 = $input['test_3_3'];
    $f->nilai_test_4 = $n4;
    $f->test_4_1 = $input['test_4_1'];
    //$f->test_4_2 = $input['test_4_2'];
   // $f->nilai_test_4_2 = $n5;
  //  $f->total_point = $n1 + $n2 + $n3 + $n4 + $n5;
    $f->total_point = $n1 + $n2 + $n3 + $n4;
    $f->hasil = $n6;
    $f->category = $cat;
    $f->classification = (($n6 == 1) ? "Need Improvement" : ($n6 == 2) ?  "Satisfactory" : ($n6 == 3) ? "Good" : "Excelent");
    $f->save();

    return redirect('check_fit')->with('success','filling form thank you');
  }

  public function storeKG(Request $r)
  {
    $input = $r->all();

    // dd($input);
    $sd = DB::select("select * from penilaian_aktivitas where
    nama_penilaian = 'Shuttle_run_kg'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? <= start)
    and skor = 4
    ORDER BY start desc
    limit 1
    ",array($input['usia'],auth()->user()->gender,(float)$input['test_2']));

    $nilai_1 = DB::select("select * from penilaian_aktivitas
    where nama_penilaian = 'Shuttle_run_kg'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? between start and end)",array($input['usia'],
    auth()->user()->gender,floatval($input['test_1'])));


    if (!empty($sd)) {
      $n1 = 4;
    }else {
      if (empty($nilai_1)) {
        $n1 = 1;
      }else {
        $n1 = $nilai_1[0]->skor;
      }
    }

    $check1 = DB::select("select * from penilaian_aktivitas where
    nama_penilaian = 'Bear_crawl'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? <= start)
    and skor = 4
    ORDER BY start desc
    limit 1
    ",array($input['usia'],auth()->user()->gender,(float)$input['test_2']));

    $nilai_2 = DB::select("select * from penilaian_aktivitas
    where nama_penilaian = 'Bear_crawl'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? between start and end)",array($input['usia'],auth()->user()->gender,(float)$input['test_2']));

    if (!empty($check1)) {
      $n2 = 4;
    }else {
      if (empty($nilai_2)) {
        $n2 = 1;
      }else {
        $n2 = $nilai_2[0]->skor;
      }
    }

    $temp3 = floatval($input['test_3_1']);


    $check3 = DB::select("select * from penilaian_aktivitas where
    nama_penilaian = 'Sit_and_reach'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? <= start)
    and skor = 4
    ORDER BY start desc
    limit 1
    ",array($input['usia'],auth()->user()->gender,$temp3));

    $nilai_3 = DB::select("select * from penilaian_aktivitas
    where nama_penilaian = 'Sit_and_reach'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? between start and end)",
    array($input['usia'],auth()->user()->gender,$temp3));


    if (!empty($check3)) {
      $n3 = 4;
    }else {
      if (empty($nilai_3)) {
        $n3 = 1;
      }else {
        $n3 = $nilai_3[0]->skor;
      }
    }


    $check4 = DB::select("select * from penilaian_aktivitas where
    nama_penilaian = 'Flaminggo'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? <= start)
    and skor = 4
    ORDER BY start desc
    limit 1
    ",array($input['usia'],auth()->user()->gender,floatval($input['test_4_1'])));

    $nilai4 = DB::select("select * from penilaian_aktivitas
    where nama_penilaian = 'Flaminggo'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? between start and end)",
    array($input['usia'],auth()->user()->gender,floatval($input['test_4_1'])));

    if (!empty($check4)) {
      $n4 = 4;
    }else {
      if (empty($nilai4)) {
        $n4 = 1;
      }else {
        $n4 = $nilai4[0]->skor;
      }
    }



    $check5 = DB::select("select * from penilaian_aktivitas where
    nama_penilaian = 'Flaminggo'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? <= start)
    and skor = 4
    ORDER BY start desc
    limit 1
    ",array($input['usia'],auth()->user()->gender,floatval($input['test_4_2'])));

    $nilai_5 = DB::select("select * from penilaian_aktivitas
    where nama_penilaian = 'Flaminggo'
    and (? BETWEEN usia_start and usia_end)
    and gender = ?
    and (? between start and end)",array($input['usia'],auth()->user()->gender,floatval($input['test_4_2'])));

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

    $bmi= (floatval($input['berat_badan'])/
    (floatval($input['tinggi_badan']) * floatval($input['tinggi_badan'])));

    $obese = DB::select("select * from penilaian_aktivitas
    where deleted_at is null and nama_penilaian='BMI_KG'
    and (? >= start)
    ORDER BY start desc
    limit 1
    ",array($bmi));

    $underweight = DB::select("select * from penilaian_aktivitas where
    deleted_at is null and nama_penilaian='BMI_KG'
    and (? <= start)
    limit 1
    ",array($bmi));

    $hint = DB::select("select * from penilaian_aktivitas where
    deleted_at is null and nama_penilaian='BMI_KG'
     and (? between start and end )",array($bmi));

    if (!empty($underweight)) {
      $cat = $underweight[0]->kriteria;
    }elseif (!empty($obese)) {
      $cat =  $obese[0]->kriteria;
    }else {
      $cat = $hint[0]->kriteria;
    }

    $f = new FitTest();
    $f->user_id = auth()->user()->id;
    $f->nik = auth()->user()->nik;
    $f->id_kelas = auth()->user()->id_kelas;
    $f->homeroom = auth()->user()->nama_guru_home_room;
    $f->id_level = auth()->user()->id_level;
    $f->fit_time_id = $input['fit_id'];
    $f->jenis_kelamin = $input['jenis_kelamin'];
    $f->kelas = $input['kelas'];
    $f->lokasi = auth()->user()->lokasi;
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

    return redirect('check_fit')->with('success','filling form thank you');
  }


}
