<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Custom;
use App\Models\FitDailyStaff;
use App\Models\FitVideoStaff;
use DateTime;

class DailyFitStaffController extends Controller
{
  public function index()
  {
    $fit_time = DB::connection('mysql2')->select("select * from fit_time where
    ((? between start_date and end_date) or end_date = ?)
    and deleted_at is null order by id desc
    limit 1",array(date('Y-m-d'),date('Y-m-d')));

    if (empty($fit_time)) {
      return redirect('teacher')->with('error','Tidak ada jadwal untuk workout silahkan kontak coach/teacher anda');
    }

    $data = DB::connection('mysql2')->select("
    select *,
    (select nama_lengkap from users where id = user_id) as nama
    from fit_daily where user_id = ? and deleted_at is null
    and fit_time_id = ?",
    array(auth()->user()->id,$fit_time[0]->id));
    return view('daily_staff.index')->with('data',$data);

  }

  public function create()
  {

    $fit_time = DB::connection('mysql2')->select("select * from fit_time where
    ((? between start_date and end_date) or end_date = ?)
    and deleted_at is null order by id desc
    limit 1",array(date('Y-m-d'),date('Y-m-d')));
    if (empty($fit_time)) {
      return redirect('daily_fit/staff')->with('error','Tidak ada jadwal untuk workout silahkan kontak coach/teacher anda');
    }

    // $fit_test = Custom::fit_test_latest(auth()->user()->id,$fit_time[0]->id);
    $fit_test = DB::connection('mysql2')->select("select * from fit_test where user_id = ?
    and deleted_at is null and fit_time_id = ? limit 1",array(auth()->user()->id,$fit_time[0]->id));

    $fit_video = DB::connection('mysql2')->select("select * from fit_video
    where deleted_at is null and
    (? between start_date and end_date)
    and fit_time_id = ?",array(date('Y-m-d'),$fit_time[0]->id));

    // dd($fit_video);
    if (empty($fit_video)) {
      return redirect('daily_fit/staff')->with('error','Kontak GURU PE untuk jadwal workout belum tersedia');
    }
    if (empty($fit_test)) {
      return redirect('daily_fit/staff')->with('error','Anda Belum mengisi test awal sebelum memulai workout anda harap di isi test terlebih dahulu');
    }



    //fendy -> cek untuk mengetahui banyak sudah melakukan berapa kali
    //fendy -> cek untuk mengetahui banyak sudah melakukan berapa kali
    $count_how_many_time= count(Custom::checkRepeatStaff(auth()->user()->id, $fit_time[0]->start_date, $fit_time[0]->end_date, $fit_time[0]->id));

    if($fit_test[0]->hasil == 4){
           if($count_how_many_time == 3){
               return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
           }
    }else if($fit_test[0]->hasil == 3){
       if($count_how_many_time == 4){
           return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
       }
    }else if($fit_test[0]->hasil == 2){
       if($count_how_many_time == 5){
           return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
       }
    }else{
       if($count_how_many_time == 6){
           return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
       }
    }

    // dd($fit_test[0]->hasil);
    $date = null;
    return view('daily_staff.create')
    ->with('v',$fit_video[0])
    ->with('fit_test_id',$fit_test[0]->id)
    ->with('fit_time_id',$fit_time[0]->id)
    ->with('results',$fit_test[0]->hasil)
    ->with('date',$date)
     //fendy
     ->with('repeat', $count_how_many_time);
  }

  public function createDate($date)
  {
    //check date if in range in a week or not
    if ($date > date('Y-m-d')) {
      return redirect('daily_fit/staff')->with('error','Tanggal Tidak Boleh Lebih Besar Dari Tanggal Sekarang');
    }
    $fit_time = DB::connection('mysql2')->select("select * from fit_time where
    ((? between start_date and end_date) or end_date = ?)
    and deleted_at is null order by id desc
    limit 1",array(date('Y-m-d'),date('Y-m-d')));

    if (empty($fit_time)) {
      return redirect('daily_fit/staff')->with('error','Tidak ada jadwal untuk workout silahkan kontak coach/teacher anda');
    }

    $fit_video = DB::connection('mysql2')->select("select * from fit_video
    where deleted_at is null and
    (? between start_date and end_date)
    and fit_time_id = ?",array(date('Y-m-d'),$fit_time[0]->id))[0];

    // dd($fit_video);
    if (empty($fit_video)) {
      return redirect('daily_fit/staff')->with('error','Kontak GURU PE untuk jadwal workout belum tersedia');
    }

    if (date('Y-m-d',strtotime($fit_video->start_date)) > $date) {
      return redirect('daily_fit/staff')->with('error','Tanggal Tidak Boleh Lebih Besar Dari Batasan');
    }
    $check = DB::connection('mysql2')->select("select * from fit_daily
    where deleted_at is null
    and user_id = ?
    and tgl = ?",array(auth()->user()->id,date('Y-m-d',strtotime($date))));


    if (!empty($check)) {
      return redirect('daily_fit/staff')->with('error','Anda sudah mengisi workout tanggal tersebut');
    }

    // $fit_test = Custom::fit_test_latest(auth()->user()->id,$fit_time[0]->id);
    $fit_test = DB::connection('mysql2')->select("select * from fit_test where user_id = ?
    and deleted_at is null and fit_time_id = ? limit 1",array(auth()->user()->id,$fit_time[0]->id));
    // $fit_video = Custom::getVideoNow()[0];

    if (empty($fit_test)) {
      return redirect('daily_fit/staff')->with('error','Anda Belum mengisi test awal sebelum memulai workout anda harap di isi test terlebih dahulu');
    }

     //fendy -> cek untuk mengetahui banyak sudah melakukan berapa kali
     $count_how_many_time=  count(Custom::checkRepeatStaff(auth()->user()->id, $fit_time[0]->start_date, $fit_time[0]->end_date, $fit_time[0]->id));

     if($fit_test[0]->hasil == 4){
            if($count_how_many_time == 3){
                return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
            }
     }else if($fit_test[0]->hasil == 3){
        if($count_how_many_time == 4){
            return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
        }
     }else if($fit_test[0]->hasil == 2){
        if($count_how_many_time == 5){
            return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
        }
     }else{
        if($count_how_many_time == 6){
            return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
        }
     }



    return view('daily_staff.create')
    ->with('v',$fit_video)
    ->with('fit_test_id',$fit_test[0]->id)
    ->with('fit_time_id',$fit_time[0]->id)
    ->with('results',$fit_test[0]->hasil)
    ->with('date',$date)
     //fendy
     ->with('repeat', $count_how_many_time);

  }
  public function store(Request $r)
  {
    $input = $r->all();

    $check = DB::connection('mysql2')->select("select * from fit_daily where deleted_at is null
    and user_id = ?
    and tgl = ?",array(auth()->user()->id,date('Y-m-d',strtotime($input['tanggal']))));
    // $check = Custom::checkDailyNow(auth()->user()->id,date('Y-m-d',strtotime($input['tanggal'])));

    $fit_time = DB::connection('mysql2')->select("select * from fit_time where
    ((? between start_date and end_date) or end_date = ?)
    and deleted_at is null order by id desc
    limit 1",array(date('Y-m-d'),date('Y-m-d')));


    if (empty($fit_time)) {
      return redirect('daily_fit/staff')->with('error','Tidak ada jadwal untuk workout silahkan kontak coach/teacher anda');
    }


    if (!empty($check)) {
      return redirect('daily_fit/staff')->with('error','Anda sudah mengisi workout tanggal tersebut');
    }

       //fendy -> cek untuk mengetahui banyak sudah melakukan berapa kali
       $fit_test = Custom::fit_test_latest(auth()->user()->id,$fit_time[0]->id);


       $count_how_many_time=  count(Custom::checkRepeatStaff(auth()->user()->id, $fit_time[0]->start_date, $fit_time[0]->end_date, $fit_time[0]->id));

       if($fit_test[0]->hasil == 4){
              if($count_how_many_time == 3){
                  return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
              }
       }else if($fit_test[0]->hasil == 3){
          if($count_how_many_time == 4){
              return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
          }
       }else if($fit_test[0]->hasil == 2){
          if($count_how_many_time == 5){
              return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
          }
       }else{
          if($count_how_many_time == 6){
              return redirect('daily_fit')->with('error','Anda sudah mengisi workout pada minggu ini');
          }
       }


    $head = new FitDailyStaff();
    $head->fit_test_id = $input['fit_test_id'];
    $head->user_id = auth()->user()->id;
    $head->fit_time_id = $input['fit_time_id'];
    $head->tgl= date('Y-m-d',strtotime($input['tanggal']));
    $head->tgl_input = date('Y-m-d H:i:s');
    $head->nama = auth()->user()->name;
    $head->kelas = auth()->user()->kelas;
    $head->lokasi = auth()->user()->lokasi;
    $head->created_by = auth()->user()->id;
    $head->fit_video_id = $input['fit_video_id'];
    $head->is_done = $input['is_done'];
    $head->save();

    return redirect('daily_fit/staff')->with('success','Anda sudah berhasil mengisi workout harian');
  }

  public function show($id)
  {
    $data = FitDailyStaff::find($id);

    if (empty($data)) {
      return redirect('daily_fit')->with('error','Data tidak ditemukan');
    }

    return view('daily_staff.show')->with('data',$data);
  }

}
