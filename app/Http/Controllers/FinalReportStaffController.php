<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Syscabang;
use App\Models\FitTimeStaff;
use App\Models\FinalRubrickStaff;
use DB;
use Auth;
use DateTime;

class FinalReportStaffController extends Controller
{
  public function index()
  {
    $data = DB::connection('mysql2')->select('select *,
    (select nama from syscabang where id = (select syscabang_id from users where nik = final_rubrick.nik
    and id = final_rubrick.user_id)) as lokasi,
    (select total_point from fit_test where id = final_rubrick.fit_test_id_start
    and fit_time_id = final_rubrick.fit_time_id) as score_sebelum
    from final_rubrick where deleted_at is null');
    $cls = Syscabang::get();
    $fit_time = FitTimeStaff::get();
    return view('final_staff.index')->with('data',$data)->with('cls',$cls)
    ->with('kelas','')
    ->with('time','')
    ->with('fit_time',$fit_time);
  }

  public function create()
  {
    $time = FitTimeStaff::get();
    return view('final_staff.create')->with('time',$time);

  }

  public function filter(Request $r)
  {
    $input = $r->all();
    // dd($input);
    $period = FitTimeStaff::find($input['fit_time_id']);
    $fdate = $period->start_date;
    $tdate = $period->end_date;
    $datetime1 = new DateTime($fdate);
    $datetime2 = new DateTime($tdate);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->format('%a');//now do whatever you like with $days

    $data = DB::connection('mysql2')->
    select('select *,
    (select nama_lengkap from users where nik = fit_test.nik
    and id = fit_test.user_id) as nama,
    (select nama_lengkap from users where nik = fit_test.nik
    and id = fit_test.user_id) as nip,
    (select nama from syscabang where id = (select syscabang_id from users where nik = fit_test.nik
    and id = fit_test.user_id)) as lokasi,

    (select count(id) from fit_daily where fit_test_id = fit_test.id) as total_daily
    from fit_test where fit_time_id = ?
    and (date(created_at) < ?)
    and id not in (select fit_test_id_start from final_rubrick where deleted_at is null)
    ',array($input['fit_time_id'],$period->end_date));

    $countLast = 0;
    foreach ($data as $key => $value) {
      $data2 = DB::connection('mysql2')->
      select('select * from fit_test where fit_time_id = ?
      and nik = ? and user_id = ?
      and date(created_at) = ?',
      array($input['fit_time_id'],$value->nik,$value->user_id,$period->end_date));
      $data[$key]->indexTKJI = 0;
      $data[$key]->indexTKJI2 = 0;
      $data[$key]->effort = 0;
      $data[$key]->total_score = 0;
      $data[$key]->fit_test_id_2 = 0;

      if ($value->category == 'Underweight' || $value->category == 'Overweight') {
        $data[$key]->bmiscore = 2;
      }elseif ($value->category == 'Obese') {
        $data[$key]->bmiscore = 1;
      }elseif ($value->category == 'Marginally overweight') {
        $data[$key]->bmiscore = 3;
      }elseif ($value->category == 'Normal') {
        $data[$key]->bmiscore = 4;
      }else {
        $data[$key]->bmiscore = 0;
      }


      if ($data[$key]->nilai_test_1 == 4) {
        $data[$key]->indexTKJI = $data[$key]->indexTKJI + 1;
      }

      if ($data[$key]->nilai_test_2 == 4) {
        $data[$key]->indexTKJI = $data[$key]->indexTKJI + 1;
      }

      if ($data[$key]->nilai_test_3 == 4) {
        $data[$key]->indexTKJI = $data[$key]->indexTKJI + 1;
      }

      if ($data[$key]->nilai_test_4 == 4) {
        $data[$key]->indexTKJI = $data[$key]->indexTKJI + 1;
      }

      if ($data[$key]->nilai_test_4_2 == 4) {
        $data[$key]->indexTKJI = $data[$key]->indexTKJI + 1;
      }


      //fendy
      $days = floor($days/7);
      if($data[$key]->hasil == 4){
        $days = $days * 3;
     }else if($data[$key]->hasil == 3){
         $days = $days * 4;
     }else if($data[$key]->hasil == 2){
         $days = $days * 5;
     }else{
         $days = $days * 6;
     }

      if (!empty($data2)) {
        foreach ($data2 as $keys => $values) {
          if ($data[$key]->nik == $data2[$keys]->nik) {

            $data[$key]->fit_test_id_2 = $data2[$keys]->id;
            $data[$key]->hasil2 = $data2[$keys]->hasil;
            $data[$key]->bmi2 = $data2[$keys]->bmi;
            $data[$key]->total_point2 = $data2[$keys]->total_point;

            $data[$key]->category2 = $data2[$keys]->category;
            if ($data2[$keys]->nilai_test_1 == 4) {
              $data[$key]->nilai_akhir_1 = $data2[$keys]->nilai_test_1;
              $data[$key]->indexTKJI2++;
            }

            if ($data2[$keys]->nilai_test_2 == 4) {
              $data[$key]->nilai_akhir_2 = $data2[$keys]->nilai_test_2;
              $data[$key]->indexTKJI2++;
            }

            if ($data2[$keys]->nilai_test_3 == 4) {
              $data[$key]->nilai_akhir_3 = $data2[$keys]->nilai_test_1;
              $data[$key]->indexTKJI2++;
            }

            if ($data2[$keys]->nilai_test_4 == 4) {
              $data[$key]->nilai_akhir_4 = $data2[$keys]->nilai_test_4;
              $data[$key]->indexTKJI2++;
            }

            if ($data2[$keys]->nilai_test_4_2 == 4) {
              $data[$key]->nilai_akhir_5 = $data2[$keys]->nilai_test_4_2;
              $data[$key]->indexTKJI2++;
            }

            $data[$key]->total_score = $data[$key]->total_score + ($data[$key]->indexTKJI2 / 5);

            if ($values->category == 'Underweight' || $values->category == 'Overweight') {
              $data[$key]->bmiscore2 = 2;
              $data[$key]->total_score = $data[$key]->total_score + 2;

            }elseif ($values->category == 'Obese') {
              $data[$key]->bmiscore2 = 1;
              $data[$key]->total_score = $data[$key]->total_score + 1;

            }elseif ($values->category == 'Marginally overweight') {
              $data[$key]->bmiscore2 = 3;
              $data[$key]->total_score = $data[$key]->total_score + 3;

            }elseif ($values->category == 'Normal') {
              $data[$key]->bmiscore2 = 4;
              $data[$key]->total_score = $data[$key]->total_score + 4;
            }else {
              $data[$key]->total_score = $data[$key]->total_score + 1;
              $data[$key]->bmiscore2 = 0;
            }

          }else{
            $data[$key]->hasil2 = 0;
            $data[$key]->bmi2 = 0;
            $data[$key]->fit_test_id_2 = 0;
            $data[$key]->nilai_akhir_1 = 0;
            $data[$key]->nilai_akhir_2 = 0;
            $data[$key]->nilai_akhir_3 = 0;
            $data[$key]->nilai_akhir_4 = 0;
            $data[$key]->nilai_akhir_5 = 0;
            $data[$key]->category2 = 0;
            $data[$key]->effort = 1;
          }

          //daily counting
          if( (($data[$key]->total_daily/$days) * 100) <= 24 ){
            $data[$key]->total_score = $data[$key]->total_score + 1;
          }elseif(((  $data[$key]->total_daily/$days) * 100) > 24 && ((  $data[$key]->total_daily/$days) * 100) <= 50)
          {
            $data[$key]->total_score = $data[$key]->total_score + 2;
          }elseif(((  $data[$key]->total_daily/$days) *  100) > 50 && (( $data[$key]->total_daily/$days) * 100) <= 99)
          {
            $data[$key]->total_score = $data[$key]->total_score + 3;
          }else{
            $data[$key]->total_score = $data[$key]->total_score + 4;
          }

          //effort counting
          if(  $data[$key]->hasil2 == 4)
          {
            $data[$key]->effort =  4;
            $data[$key]->total_score = $data[$key]->total_score + 4;
          }
          elseif(  $data[$key]->total_point2 >   $data[$key]->total_point &&   $data[$key]->bmiscore <   $data[$key]->bmiscore2 &&   $data[$key]->hasil2 != 4)
          {
            $data[$key]->effort =  3;
            $data[$key]->total_score = $data[$key]->total_score + 3;
          }elseif(  $data[$key]->hasil2 ==   $data[$key]->hasil && ((   $data[$key]->total_point2 >   $data[$key]->total_point ) || (  $data[$key]->bmiscore <   $data[$key]->bmiscore2)))
          {
            $data[$key]->effort =  2;
            $data[$key]->total_score = $data[$key]->total_score + 2;
          }else{
            $data[$key]->effort =  1;
            $data[$key]->total_score = $data[$key]->total_score + 1;
          }


        }
      }else {
        $data[$key]->hasil2 = 0;
        $data[$key]->bmi2 = 0;
        $data[$key]->nilai_akhir_1 = 0;
        $data[$key]->nilai_akhir_2 = 0;
        $data[$key]->nilai_akhir_3 = 0;
        $data[$key]->nilai_akhir_4 = 0;
        $data[$key]->nilai_akhir_5 = 0;
        $data[$key]->category2 = 0;
        $data[$key]->effort = 1;
        $data[$key]->total_point2 = 0;
        $data[$key]->bmiscore2 = 0;
        $data[$key]->total_score = 1;
      }



    }

    // dd($data);

    return view('final_staff.filter')->with('data',$data)->with('day',$days);

  }

  public function submit(Request $r)
  {
    $input = $r->all();
    // dd($input);
    DB::beginTransaction();
    try {

      foreach ($input['item'] as $key => $value) {
        if ($input['item'][$key] != 0) {

          $cr = DB::connection('mysql2')->select("
          select * from corpus_fitnes where deleted_at is null
          and (? between start and end) limit 1",array($input['total_score'][$key]));
          $a = new FinalRubrickStaff();
          $a->tgl = date('Y-m-d');
          $a->fit_time_id = $input['fit_time_id'][$key];
          $a->fit_test_id_start = $input['fit_test_id_start'][$key];
          $a->fit_test_id_end = $input['fit_test_id_end'][$key];
          $a->level_bmi = $input['level_bmi'][$key];
          $a->level_tkji = $input['level_tkji'][$key];
          $a->daily_practice = $input['daily_practice'][$key];
          $a->effort = $input['effort'][$key];
          $a->total_score = $input['total_score'][$key];
          $a->user_id = $input['id_user'][$key];
          $a->nik = $input['nik'][$key];
          $a->nama = $input['nama'][$key];
          $a->gender = $input['gender'][$key];
          $a->nip = $input['nip'][$key];
          $a->syscabang_id = $input['syscabang_id'][$key];
          $a->creativity = $cr[0]->category;
          $a->desc_creativity = $cr[0]->text_1;

          $a->save();

        }
      }
      DB::commit();
      return redirect('/staff/final/report')->with('success','Berhasil Melakukan Input Final Report');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;

    }
  }
}
