<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FitTime;
use DB;
use Auth;
use DateTime;
use App\Models\FinalRubrick;
use App\Models\CreativityStudent;
use App\Models\FitVideo;
use App\Models\FitDaily;
use App\Models\CreativityType;
use App\Models\Syskelas;
use App\Models\TempContainer;

class FinalReportController extends Controller
{
  public function index()
  {
    $data = DB::connection('mysql')->select('select *,
    (select total_point from fit_test where id = final_rubrick.fit_test_id_start
    and fit_time_id = final_rubrick.fit_time_id) as score_sebelum
    from final_rubrick where deleted_at is null');
    $cls = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
    $fit_time = FitTime::get();
    return view('final.index')->with('data',$data)->with('cls',$cls)
    ->with('kelas','')
    ->with('time','')
    ->with('fit_time',$fit_time);
  }

  public function show($time,$kelas)
  {
    $data = DB::connection('mysql')->select('select *,
    (select total_point from fit_test where id = final_rubrick.fit_test_id_start
    and fit_time_id = final_rubrick.fit_time_id) as score_sebelum
    from final_rubrick where deleted_at is null and fit_time_id = ? and
    id_kelas = (select kode_kelas from syskelas where id = ?)',array($time,$kelas));
    $cls = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
    $fit_time = FitTime::get();
    return view('final.index')->with('data',$data)->with('cls',$cls)
    ->with('kelas',$kelas)
    ->with('time',$time)
    ->with('fit_time',$fit_time);
  }
  public function create()
  {
    $time = FitTime::get();
    return view('final.create')->with('time',$time);
  }

  public function filter(Request $r)
  {
    $input = $r->all();
    // dd($input);
    $period = FitTime::find($input['fit_time_id']);
    $fdate = $period->start_date;
    $tdate = $period->end_date;
    $datetime1 = new DateTime($fdate);
    $datetime2 = new DateTime($tdate);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->format('%a');//now do whatever you like with $days

    // dd(floor($days/7));
    //fendy
    $days = floor($days/7);

    if ($input['gridRadios'] == 'is_pgkg') {
      $data = DB::connection('mysql')->
      select('select *,
      IFNULL((select name from active_student where nik = fit_test.nik
      and id = fit_test.user_id),
      (select name from active_student_sutorejo where nik = fit_test.nik
      and id = fit_test.user_id
      )) as nama,
      (select count(id) from fit_daily where fit_test_id = fit_test.id) as total_daily
      from fit_test where fit_time_id = ?
      and (date(created_at) < ?) and (id_level >= 3) and (id_level <= 4)
      and id not in (select fit_test_id_start from final_rubrick where deleted_at is null)
      ',array($input['fit_time_id'],$period->end_date));
    }elseif ($input['gridRadios'] == 'is_primary') {
      $data = DB::connection('mysql')->
      select('select *,
      IFNULL((select name from active_student where nik = fit_test.nik
      and id = fit_test.user_id),
      (select name from active_student_sutorejo where nik = fit_test.nik
      and id = fit_test.user_id
      )) as nama,
      (select count(id) from fit_daily where fit_test_id = fit_test.id) as total_daily
      from fit_test where fit_time_id = ?
      and date(created_at) < ? and (id_level >= 5) and (id_level <= 10)
      and id not in (select fit_test_id_start from final_rubrick where deleted_at is null)
      ',array($input['fit_time_id'],$period->end_date));
    }elseif ($input['gridRadios'] == 'is_secondary') {
      $data = DB::connection('mysql')->
      select('select *,
      IFNULL((select name from active_student where nik = fit_test.nik
      and id = fit_test.user_id),
      (select name from active_student_sutorejo where nik = fit_test.nik
      and id = fit_test.user_id
      )) as nama,
      (select count(id) from fit_daily where fit_test_id = fit_test.id) as total_daily
      from fit_test where fit_time_id = ?
      and date(created_at) < ? and (id_level >= 11) and (id_level <= 13)
      and id not in (select fit_test_id_start from final_rubrick where deleted_at is null)
      ',array($input['fit_time_id'],$period->end_date));
    }elseif ($input['gridRadios'] == 'is_highschool') {
      $data = DB::connection('mysql')->
      select('select *,
      IFNULL((select name from active_student where nik = fit_test.nik
      and id = fit_test.user_id),
      (select name from active_student_sutorejo where nik = fit_test.nik
      and id = fit_test.user_id
      )) as nama,
      (select count(id) from fit_daily where fit_test_id = fit_test.id) as total_daily
      from fit_test where fit_time_id = ?
      and date(created_at) < ? and (id_level >= 14) and (id_level <= 16)
      and id not in (select fit_test_id_start from final_rubrick where deleted_at is null)
      ',array($input['fit_time_id'],$period->end_date));
    }





    $countLast = 0;
    foreach ($data as $key => $value) {
      $data2 = DB::connection('mysql')->
      select('select * from fit_test where fit_time_id = ?
      and nik = ? and user_id = ?
      and date(created_at) = ?',
      array($input['fit_time_id'],$value->nik,$value->user_id,$period->end_date));
      $data[$key]->indexTKJI = 0;
      $data[$key]->indexTKJI2 = 0;
      $data[$key]->effort = 0;
      $data[$key]->total_score = 0;
      $data[$key]->fit_test_id_2 = 0;
      $data[$key]->bmiscore2 = 0;

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
            $data[$key]->total_point2 = 0;
            $data[$key]->category2 = 0;
            $data[$key]->effort = 1;
          }

         //fendy
         if($data[$key]->hasil == 4){
            $days = $days * 3;
         }else if($data[$key]->hasil == 3){
             $days = $days * 4;
         }else if($data[$key]->hasil == 2){
             $days = $days * 5;
         }else{
             $days = $days * 6;
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

    return view('final.filter')->with('data',$data)->with('day',$days);

  }


  public function submit(Request $r)
  {
    $input = $r->all();
    // dd($input);
    DB::beginTransaction();
    try {

      foreach ($input['item'] as $key => $value) {
        if ($input['item'][$key] != 0) {

          $cr = DB::connection('mysql')->select("
          select * from corpus_fitnes where deleted_at is null
          and (? between start and end) limit 1",array($input['total_score'][$key]));
          $a = new FinalRubrick();
          $a->tgl = date('Y-m-d');
          $a->fit_time_id = $input['fit_time_id'][$key];
          $a->fit_test_id_start = $input['fit_test_id_start'][$key];
          $a->fit_test_id_end = $input['fit_test_id_end'][$key];
          $a->level_bmi = $input['level_bmi'][$key];
          $a->level_tkji = $input['level_tkji'][$key];
          $a->daily_practice = $input['daily_practice'][$key];
          $a->effort = $input['effort'][$key];
          $a->total_score = $input['total_score'][$key];
          if ($input['lokasi'][$key ] == 'Sutorejo') {
            
            $a->user_id_sutorejo = $input['user_id_sutorejo'][0];
          }else {
            $a->user_id = $input['user_id'][$key];
          }
          $a->nik = $input['nik'][$key];
          $a->nama = $input['nama'][$key];
          $a->gender = $input['gender'][$key];
          $a->kelas = $input['kelas'][$key];
          $a->id_kelas = $input['id_kelas'][$key];
          $a->id_level =$input['id_level'][$key];
          $a->lokasi = $input['lokasi'][$key];
          $a->homeroom = $input['homeroom'][$key];
          $a->creativity = $cr[0]->category;
          $a->desc_creativity = $cr[0]->text_1;

          $a->save();

        }
      }
      DB::commit();
      return redirect('final/report')->with('success','Berhasil Melakukan Input Final Report');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;

    }


  }

  public function print($id)
  {
    $data = FinalRubrick::find($id);

    //fendy
    $tt_setting = null;
    $id_setting = 
    json_decode(json_encode(DB::connection('mysql')->select( 'select * from class_setting_report where id_class like "'.$data->id_kelas.'"') ), true)
    ;

    if(count($id_setting) >0){
      $id_setting = $id_setting[0];
      $tt_setting = DB::connection('mysql')->select('select * from setting_report where id = '.$id_setting['id_setting_report']);
    }

    
    


    // $creativity = CreativityStudent::where('user_id','=',$data->user_id)->where('fit_time_id','=',$data->fit_time_id)
    // ->where('id_kelas','=',$data->id_kelas)->where('id_level','=',$data->id_level)->where('lokasi','=',$data->lokasi)
    // ->first();
    // if (!empty($creativity)) {
    //   $cr1 = CreativityType::where('kode_creativity','=','cr1')->where('code','=',$creativity->creativity_1)
    //   ->where('level_min','<=',$creativity->id_level)->where('level_max','>=',$creativity->id_level)->first();
    //   $cr2 = CreativityType::where('kode_creativity','=','cr2')->where('code','=',$creativity->creativity_2)
    //   ->where('level_min','<=',$creativity->id_level)->where('level_max','>=',$creativity->id_level)->first();
    //   $cr3 = CreativityType::where('kode_creativity','=','cr3')->where('code','=',$creativity->creativity_1)
    //   ->where('level_min','<=',$creativity->id_level)->where('level_max','>=',$creativity->id_level)->first();
    //   $cr4 = CreativityType::where('kode_creativity','=','cr4')->where('code','=',$creativity->creativity_2)
    //   ->where('level_min','<=',$creativity->id_level)->where('level_max','>=',$creativity->id_level)->first();
    //   $cr5 = CreativityType::where('kode_creativity','=','cr5')->where('code','=',$creativity->creativity_1)
    //   ->where('level_min','<=',$creativity->id_level)->where('level_max','>=',$creativity->id_level)->first();
    //   $cr6 = CreativityType::where('kode_creativity','=','cr6')->where('code','=',$creativity->creativity_2)
    //   ->where('level_min','<=',$creativity->id_level)->where('level_max','>=',$creativity->id_level)->first();
    //   $creativity->cr1 = (empty($cr1)) ? '' : $cr1->text;
    //   $creativity->cr2 = (empty($cr2)) ? '' : $cr2->text;
    //   $creativity->cr3 = (empty($cr3)) ? '' : $cr3->text;
    //   $creativity->cr4 = (empty($cr4)) ? '' : $cr4->text;
    //   $creativity->cr5 = (empty($cr5)) ? '' : $cr5->text;
    //   $creativity->cr6 = (empty($cr6)) ? '' : $cr6->text;

    //   if($creativity->grade == 'KGA' || $creativity->grade == 'KGB' || $creativity->grade == 'PGB'
    //   || $creativity->grade == '1' || $creativity->grade == '2'){
    //     if ($creativity->creativity_1 == 2 && $creativity->creativity_2 == 1) {
    //       $creativity->text = $creativity->nama.' '.$creativity->cr1.' but '.(($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr2) : 'he '.str_replace("his/her","his",$creativity->cr2));
    //     }elseif ($creativity->creativity_1 == 1 && $creativity->creativity_2 == 2) {
    //       $creativity->text = $creativity->nama.' '.$creativity->cr2.'but'.(($creativity->gender == 1) ? 'She' : 'He').' '.($creativity->gender == 1) ? str_replace("his/her","her",$creativity->cr1) : str_replace("his/her","his",$creativity->cr1);
    //     }else {
    //       $creativity->text =
    //       $creativity->nama.' '.$creativity->cr1.' '.(($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr2) : 'he '.str_replace("his/her","his",$creativity->cr2));
    //     }
    //   }elseif ($creativity->grade >= 3 && $creativity->grade <= 6) {
    //     if ($creativity->creativity_1 + $creativity->creativity_2 + $creativity->creativity_3 + $creativity->creativity_4 == 8) {
    //       $creativity->text = $creativity->nama.' '.
    //       (($creativity->creativity_1 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr1) : 'he '.str_replace("his/her","his",$creativity->cr1)).' ' : '').
    //       (($creativity->creativity_2 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr2) : 'he '.str_replace("his/her","his",$creativity->cr2)).' ' : '').
    //       (($creativity->creativity_3 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr3) : 'he '.str_replace("his/her","his",$creativity->cr3)).' ' : '').
    //       (($creativity->creativity_4 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr4) : 'he '.str_replace("his/her","his",$creativity->cr4)).' ' : '');

    //     }else {
    //       $creativity->text = $creativity->nama.' '.
    //       (($creativity->creativity_1 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr1) : 'he '.str_replace("his/her","his",$creativity->cr1)).' ' : '').
    //       (($creativity->creativity_2 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr2) : 'he '.str_replace("his/her","his",$creativity->cr2)).' ' : '').
    //       (($creativity->creativity_3 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr3) : 'he '.str_replace("his/her","his",$creativity->cr3)).' ' : '').
    //       (($creativity->creativity_4 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr4) : 'he '.str_replace("his/her","his",$creativity->cr4)).' ' : '').
    //       'but '.
    //       (($creativity->creativity_1 == 1) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr1) : 'he '.str_replace("his/her","his",$creativity->cr1)).' ' : '').
    //       (($creativity->creativity_2 == 1) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr2) : 'he '.str_replace("his/her","his",$creativity->cr2)).' ' : '').
    //       (($creativity->creativity_3 == 1) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr3) : 'he '.str_replace("his/her","his",$creativity->cr3)).' ' : '').
    //       (($creativity->creativity_4 == 1) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr4) : 'he '.str_replace("his/her","his",$creativity->cr4)).' ' : '');

    //     }
    //   }else {
    //     if ($creativity->creativity_1 + $creativity->creativity_2 + $creativity->creativity_3 + $creativity->creativity_4 + $creativity->creativity_5 + $creativity->creativity_6 == 12) {
    //       $creativity->text = $creativity->nama.
    //       (($creativity->creativity_1 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr1) : 'he '.str_replace("his/her","his",$creativity->cr1)).' ' : '').
    //       (($creativity->creativity_2 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr2) : 'he '.str_replace("his/her","his",$creativity->cr2)).' ' : '').
    //       (($creativity->creativity_3 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr3) : 'he '.str_replace("his/her","his",$creativity->cr3)).' ' : '').
    //       (($creativity->creativity_4 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr4) : 'he '.str_replace("his/her","his",$creativity->cr4)).' ' : '').
    //       (($creativity->creativity_5 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr5) : 'he '.str_replace("his/her","his",$creativity->cr5)).' ' : '').
    //       (($creativity->creativity_6 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr6) : 'he '.str_replace("his/her","his",$creativity->cr6)).' ' : '');
    //     }else {
    //       $creativity->text = $creativity->nama.
    //       (($creativity->creativity_1 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr1) : 'he '.str_replace("his/her","his",$creativity->cr1)).' ' : '').
    //       (($creativity->creativity_2 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr2) : 'he '.str_replace("his/her","his",$creativity->cr2)).' ' : '').
    //       (($creativity->creativity_3 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr3) : 'he '.str_replace("his/her","his",$creativity->cr3)).' ' : '').
    //       (($creativity->creativity_4 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr4) : 'he '.str_replace("his/her","his",$creativity->cr4)).' ' : '').
    //       (($creativity->creativity_5 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr5) : 'he '.str_replace("his/her","his",$creativity->cr5)).' ' : '').
    //       (($creativity->creativity_6 == 2) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr6) : 'he '.str_replace("his/her","his",$creativity->cr6)).' ' : '').
    //       'but '.
    //       (($creativity->creativity_1 == 1) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr1) : 'he '.str_replace("his/her","his",$creativity->cr1)).' ' : '').
    //       (($creativity->creativity_2 == 1) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr2) : 'he '.str_replace("his/her","his",$creativity->cr2)).' ' : '').
    //       (($creativity->creativity_3 == 1) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr3) : 'he '.str_replace("his/her","his",$creativity->cr3)).' ' : '').
    //       (($creativity->creativity_4 == 1) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr4) : 'he '.str_replace("his/her","his",$creativity->cr4)).' ' : '').
    //       (($creativity->creativity_5 == 1) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr5) : 'he '.str_replace("his/her","his",$creativity->cr5)).' ' : '').
    //       (($creativity->creativity_6 == 1) ?  (($creativity->gender == 1) ? 'she '.str_replace("his/her","her",$creativity->cr6) : 'he '.str_replace("his/her","his",$d->cr6)).' ' : '');
    //     }
    //   }
    // }
      $id_usr= "";
      if($data->lokasi  == 'Sutorejo'){
        $id_usr = $data->user_id_sutorejo;
      }else{
        $id_usr = $data->user_id;
      }
      $creativity = CreativityStudent::where('user_id','=',$id_usr)->where('fit_time_id','=',$data->fit_time_id)
    ->where('id_kelas','=',$data->id_kelas)->where('id_level','=',$data->id_level)->where('lokasi','=',$data->lokasi)
    ->first();






      // dd($creativity);

    $fitVideo = FitVideo::where('fit_time_id','=',$data->fit_time_id)->get();
    foreach ($fitVideo as $key => $v) {
      $dailyFit = FitDaily::where('fit_video_id','=',$v->id)
      ->where('fit_test_id','=',$data->fit_test_id_start)
      ->where('fit_time_id','=',$data->fit_time_id)
      ->get();
      $fitVideo[$key]->detail = $dailyFit;
    }

    if (empty($data)) {
      return redirect()->back()->with('error','Data not Found');
    }
    return view('final.print')->with('data',$data)->with('exercise',$fitVideo)->with('creativity', $creativity)->with('tt_kepsek', json_decode(json_encode($tt_setting),true));
  }

  public function delete($id)
  {
    $data = FinalRubrick::find($id);
    if (empty($data)) {
      return redirect()->back()->with('error','Data not Found');
    }

    DB::beginTransaction();
    try {
      $data->deleted_by = Auth()->user()->id;
      $data->deleted_at = date('Y-m-d H:i:s');
      $data->save();
      DB::commit();
      return redirect()->back()->with('success','Data berhasil dihapus');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }

  }

  //fendy
  public function indexSetting(){
    $data = DB::connection('mysql')->select('select * from setting_report ');
    return view('final.index_setting')->with('data', json_decode(json_encode($data), true));
  }


  public function reportSetting($id){
    $class = DB::select("select DISTINCT id_kelas,kelas,lokasi from
    active_student where deleted_at is null
    union
    select DISTINCT id_kelas,kelas,lokasi from
    active_student_sutorejo where deleted_at is null
    ");
     $data = DB::connection('mysql')->select('select * from setting_report where id = '.$id);
     $data_class_selected = DB::connection('mysql')->select('select * from class_setting_report where id_setting_report = '. $id );
   //   $data = DB::connection('mysql')->select('select * from setting_report ');
  //     $data = [ 'nama_kepala_sekolah' => env('NAMA_KEPALA_SEKOLAH'), 'tanda_tangan_kepala_sekolah' => env('TANDA_TANGAN_KEPALA_SEKOLAH')];
    //dd($data);
    if(count($data)>0){

      //  return view('final.setting_report')->with('data',json_decode(json_encode( $data[0]), true));
      return view('final.setting_report')->with('data',json_decode(json_encode( $data[0]), true)) -> with('class', $class)->with('data_selected_class', json_decode(json_encode($data_class_selected), true));
    } else{
        return view('final.setting_report')->with('class', $class);
    }

   // return view('final.setting_report')->with('class', $class);
  }


  public function storeReportSetting(Request $request){
      $nama_kepala_sekolah = $request->nama_kepala_sekolah;
      $class = $request->class;
   //   $tmp = DB::connection('mysql')->select('select * from setting_report where id = 1');
      $id = intval($request->id);
      if($id != -1){
       // dd($id);
        $arr_update = array();
        $arr_update['nama_kepala_sekolah'] = $nama_kepala_sekolah;
        if(isset($request->image_path)){
            $filename = $request->file('image_path')->getClientOriginalName();
            $request->file('image_path')->move(public_path('img'), $filename);
            $arr_update['tt_kepala_sekolah']  = $filename;
        }
        DB::connection('mysql')->table('setting_report')->where('id', $id)->update($arr_update);

        //delete last inserted before insert again
        DB::connection('mysql')->table('class_setting_report') -> where('id_setting_report', $id)->delete();
        // insert again
        for($i=0; $i<count($class); $i++){
            DB::connection('mysql')->table('class_setting_report')->insert([
                'id_setting_report' => $id,
                'id_class' => $class[$i]
            ]);
        }

      } else{
        $filename = $request->file('image_path')->getClientOriginalName();
        $request->file('image_path')->move(public_path('img'), $filename);
        $cek = DB::connection('mysql')->table('setting_report')->insert([
            "nama_kepala_sekolah" => $nama_kepala_sekolah,
            "tt_kepala_sekolah" => $filename
        ]);
        
        $id_inserted = DB::getPdo()->lastInsertId();
        if($class != null){
          for($i=0; $i<count($class); $i++){
              DB::connection('mysql')->table('class_setting_report')->insert([
                  'id_setting_report' => $id_inserted,
                  'id_class' => $class[$i]
              ]);
          }
        }
      }
      return redirect('corpus/indexsetting');
  }

  public function destroy($id)
  {
    DB::connection('mysql')->table('class_setting_report')->where('id', $id)->delete();
    DB::connection('mysql')->table('setting_report')->where('id', $id)->delete();
    return redirect('corpus/indexsetting');
  }
 

}
