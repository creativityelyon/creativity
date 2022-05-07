<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class ReportTestController extends Controller
{

  public function reportDailyStudent()
  {
    $data = DB::connection('mysql')->select("
    select * from fit_daily where deleted_at is null and
    tgl = ?",
    array(date('Y-m-d')));

    return view('report.daily')->with('data',$data);
  }

  public function reportDailyStudentDate($tgl)
  {

    $data = DB::connection('mysql')->select("
    select * from fit_daily where deleted_at is null and
    tgl = ?",
    array(date('Y-m-d',strtotime($tgl))));

    return view('report.daily')->with('data',$data);
  }

  public function reportDailyStaff()
  {
    $now = Carbon::now();
    $p = DB::connection('mysql2')->select("
    select * from periods where (start_date <= ?) and (end_date >= ?)
    limit 1
    ",array($now,$now))[0];

    $data = DB::connection('mysql2')->select("select id,tgl,
    (select nama_lengkap from users where id = user_id) as nama_lengkap,
    (select nama from jabatans where id = (select jabatan_id from period_positions where
    user_id = fit_daily.user_id and period_id = ?)) as jabatan,
    (select nama from syscabang where id = (select syscabang_id from users where id = user_id)) as lokasi
    from fit_daily
    where deleted_at is null and
    tgl = ?",
    array($p->id,date('Y-m-d')));

    return view('report.dailyStaff')->with('data',$data);
  }

  public function reportDailyStaffDate($tgl)
  {
    $now = Carbon::now();
    $p = DB::connection('mysql2')->select("
    select * from periods where (start_date <= ?) and (end_date >= ?)
    limit 1
    ",array($now,$now))[0];

    $data = DB::connection('mysql2')->select("select id,tgl,
    (select nama_lengkap from users where id = user_id) as nama_lengkap,
    (select nama from jabatans where id = (select jabatan_id from period_positions where
    user_id = fit_daily.user_id and period_id = ?)) as jabatan,
    (select nama from syscabang where id = (select syscabang_id from users where id = user_id)) as lokasi
    from fit_daily
    where deleted_at is null and
    tgl = ?",
    array($p->id,date('Y-m-d',strtotime($tgl))));

    return view('report.dailyStaff')->with('data',$data);
  }

  public function index()
  {
    $check_period = DB::select("select * from fit_time where
    ((? between start_date and end_date) or end_date = ?)
    and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));

    $class = DB::select("select DISTINCT id_kelas,kelas,lokasi from
    active_student where deleted_at is null
    union
    select DISTINCT id_kelas,kelas,lokasi from
    active_student_sutorejo where deleted_at is null
    ");

    if (empty($check_period)) {
      return redirect('home')->with('error','Jadwal Fit Belum Ada !');
    }else {
      $check_input = DB::select("select * from
      (select s.name,s.email,s.kelas as kls,s.lokasi as lks,s.no_induk_siswa_global,f.*,
      (select keterangan from fit_time where id = f.fit_time_id) as fit_time_ket
      from active_student s
      LEFT JOIN fit_test f
      on
      f.user_id = s.id
      where f.fit_time_id = ?
      union
      select s.name,s.email,s.kelas as kls,s.lokasi as lks,s.no_induk_siswa_global,f.*,
      (select keterangan from fit_time where id = f.fit_time_id) as fit_time_ket
      from active_student s
      LEFT JOIN fit_test f
      on
      f.user_id = s.id
      where s.id not in (select user_id from fit_test where fit_time_id = ?)
      ) as viewavailable
      ORDER BY kls",array($check_period[0]->id,$check_period[0]->id));

      return view('report.fit')
      ->with('class',$class)
      ->with('fit_id',$check_period[0]->id)
      ->with('data',$check_input);
    }
  }

  public function searchGender($gender,$class,$lokasi)
  {
    $check_period = DB::select("select * from fit_time where ((? between start_date and end_date) or end_date = ?)
    and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));

    $kls = DB::select("select DISTINCT id_kelas,kelas,lokasi from
    active_student where deleted_at is null
    union
    select DISTINCT id_kelas,kelas,lokasi from
    active_student_sutorejo where deleted_at is null
    ");
    if ($gender=='null') {
      $gen = 'semua';
    }

    if ($lokasi=='null') {
      $lok = 'semua';
    }

    if ($class=='null') {
      $kl = 'semua';
    }
    if (empty($check_period)) {
      return redirect('home')->with('error','Jadwal Fit Belum Ada !');
    }else {
      $check_input = DB::select("select * from
      (select s.name,s.email,s.kelas as kls,s.lokasi as lks,s.no_induk_siswa_global,f.*,
      (select keterangan from fit_time where id = f.fit_time_id) as fit_time_ket
      from active_student s
      LEFT JOIN fit_test f
      on
      f.user_id = s.id
      where f.fit_time_id = ?
      union
      select s.name,s.email,s.kelas as kls,s.lokasi as lks,s.no_induk_siswa_global,f.*,
      (select keterangan from fit_time where id = f.fit_time_id) as fit_time_ket
      from active_student s
      LEFT JOIN fit_test f
      on
      f.user_id = s.id
      where s.id not in (select user_id from fit_test where fit_time_id = ?)
      ) as viewavailable
      where ('semua' = ? or gender = ?) and ('semua' = ? or lokasi = ?) and ('semua' = ? or id_kelas = ?)
      ORDER BY kls",array($gen,$gen,$lok,$lok,$kl,$kl,$check_period[0]->id,$check_period[0]->id));

      return view('report.fit')
      ->with('gender',$gender)
      ->with('lokasi',$lokasi)
      ->with('sclass',$class)
      ->with('class',$kls)
      ->with('fit_id',$check_period[0]->id)
      ->with('data',$check_input);

    }
  }


}
