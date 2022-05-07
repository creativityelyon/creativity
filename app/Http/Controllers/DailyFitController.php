<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Custom;
use App\Models\FitDaily;
use App\Models\FitDailyD;
use App\Models\JadwalLatihan;
use App\Models\FitVideo;
use DateTime;

class DailyFitController extends Controller
{
  public function index()
  {
    if (auth()->user()->id_level <= 4) {
      $fit_time = DB::connection('mysql')->select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and is_kg = 1
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }else {
      $fit_time = DB::connection('mysql')->select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }

    if (empty($fit_time)) {
      return redirect('home')->with('error','Tidak ada jadwal untuk workout silahkan kontak coach/teacher anda');
    }

    $data = DB::select("select * from fit_daily where user_id = ?
    and deleted_at is null
    and fit_time_id = ?",
    array(auth()->user()->id,$fit_time[0]->id));
    return view('daily.index')->with('data',$data);
  }

  public function create()
  {

    if (auth()->user()->id_level <= 4) {
      $fit_time = DB::connection('mysql')->select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and is_kg = 1
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }else {
      $fit_time = DB::connection('mysql')->select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }

    // dd($fit_time);
    if (empty($fit_time)) {
      return redirect('daily_fit')->with('error','Tidak ada jadwal untuk workout silahkan kontak coach/teacher anda');
    }

    $fit_test =  Custom::fit_test_latest(auth()->user()->id,$fit_time[0]->id);

    // dd(Auth::user()->id_level);
    if (Auth::user()->id_level <= 4 ) { //KG
      $fit_video = Custom::getVideoNowTK($fit_time[0]->id);
    }elseif (Auth::user()->id_level >= 5 && Auth::user()->id_level <= 10) { //SD
      $fit_video = Custom::getVideoNowSD($fit_time[0]->id);
    }elseif (Auth::user()->id_level >= 11 && Auth::user()->id_level <= 13) { //smp
      $fit_video = Custom::getVideoNowSMP($fit_time[0]->id);
    }elseif(Auth::user()->id_level >= 14 && Auth::user()->id_level <= 16){
      $fit_video = Custom::getVideoNowSMA($fit_time[0]->id);
    }

    // dd($fit_video);
    if (empty($fit_video)) {
      return redirect('daily_fit')->with('error','Kontak GURU PE untuk jadwal workout belum tersedia');
    }
    if (empty($fit_test)) {
      return redirect('daily_fit')->with('error','Anda Belum mengisi test awal sebelum memulai workout anda harap di isi test terlebih dahulu');
    }

    //fendy -> cek untuk mengetahui banyak sudah melakukan berapa kali
    //fendy -> cek untuk mengetahui banyak sudah melakukan berapa kali
    $count_how_many_time= count(Custom::checkRepeat(auth()->user()->id, $fit_time[0]->start_date, $fit_time[0]->end_date, $fit_time[0]->id));

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
    return view('daily.create')
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
      return redirect('daily_fit')->with('error','Tanggal Tidak Boleh Lebih Besar Dari Tanggal Sekarang');
    }
    if (auth()->user()->id_level <= 4) {
      $fit_time = DB::connection('mysql')->select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and is_kg = 1
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }else {
      $fit_time = DB::connection('mysql')->select("select * from fit_time where
      ((? between start_date and end_date) or end_date = ?)
      and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
    }

    if (empty($fit_time)) {
      return redirect('daily_fit')->with('error','Tidak ada jadwal untuk workout silahkan kontak coach/teacher anda');
    }

    // dd(Auth::user()->id_level);
    if (Auth::user()->id_level <= 4 ) { //KG
      $fit_video = Custom::getVideoNowTK($fit_time[0]->id)[0];
    }elseif (Auth::user()->id_level >= 5 && Auth::user()->id_level <= 10) { //SD
      $fit_video = Custom::getVideoNowSD($fit_time[0]->id)[0];
    }elseif (Auth::user()->id_level >= 11 && Auth::user()->id_level <= 13) { //smp
      $fit_video = Custom::getVideoNowSMP($fit_time[0]->id)[0];
    }elseif(Auth::user()->id_level >= 14 && Auth::user()->id_level <= 16){
      $fit_video = Custom::getVideoNowSMA($fit_time[0]->id)[0];
    }

    // dd($fit_video);
    if (empty($fit_video)) {
      return redirect('daily_fit')->with('error','Kontak GURU PE untuk jadwal workout belum tersedia');
    }

    if (date('Y-m-d',strtotime($fit_video->start_date)) > $date) {
      return redirect('daily_fit')->with('error','Tanggal Tidak Boleh Lebih Besar Dari Batasan');
    }

    $check = Custom::checkDailyNow(auth()->user()->id,date('Y-m-d',strtotime($date)));

    if (!empty($check)) {
      return redirect('daily_fit')->with('error','Anda sudah mengisi workout tanggal tersebut');
    }





    $fit_test = Custom::fit_test_latest(auth()->user()->id,$fit_time[0]->id);
    // $fit_video = Custom::getVideoNow()[0];

     //fendy -> cek untuk mengetahui banyak sudah melakukan berapa kali
     $count_how_many_time=  count(Custom::checkRepeat(auth()->user()->id, $fit_time[0]->start_date, $fit_time[0]->end_date, $fit_time[0]->id));

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


    if (empty($fit_test)) {
      return redirect('daily_fit')->with('error','Anda Belum mengisi test awal sebelum memulai workout anda harap di isi test terlebih dahulu');
    }

    return view('daily.create')
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

    $check = Custom::checkDailyNow(auth()->user()->id,date('Y-m-d',strtotime($input['tanggal'])));

    $fit_time = Custom::fit_time_now();
    if (empty($fit_time)) {
      return redirect('daily_fit')->with('error','Tidak ada jadwal untuk workout silahkan kontak coach/teacher anda');
    }



    if (!empty($check)) {
      return redirect('daily_fit')->with('error','Anda sudah mengisi workout tanggal tersebut');
    }

     //fendy -> cek untuk mengetahui banyak sudah melakukan berapa kali
    $fit_test = Custom::fit_test_latest(auth()->user()->id,$fit_time[0]->id);


     $count_how_many_time=  count(Custom::checkRepeat(auth()->user()->id, $fit_time[0]->start_date, $fit_time[0]->end_date, $fit_time[0]->id));

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


    $head = new FitDaily();
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

    return redirect('daily_fit')->with('success','Anda sudah berhasil mengisi workout harian');
  }

  public function show($id)
  {
    $data = FitDaily::find($id);

    if (empty($data)) {
      return redirect('daily_fit')->with('error','Data tidak ditemukan');
    }

    return view('daily.show')->with('data',$data);
  }
}
