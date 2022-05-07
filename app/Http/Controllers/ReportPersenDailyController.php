<?php

namespace App\Http\Controllers;
use App\Models\Syskelas;
use App\Models\FitTime;
use Illuminate\Http\Request;
use DateTime;
use DB;
use Auth;
class ReportPersenDailyController extends Controller
{
  public function index()
  {
    $cls = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
    $fit_time = FitTime::get();
    $data = [];
    return view('report.persen')->with('cls',$cls)
    ->with('kelas','')
    ->with('time','')
    ->with('fit_time',$fit_time)
    ->with('data',$data);

  }

  public function show($time,$kelas)
  {
    $cls = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
    $fit_time = FitTime::get();

    $period = FitTime::find($time);
    $fdate = $period->start_date;
    $tdate = $period->end_date;
    $datetime1 = new DateTime($fdate);
    $datetime2 = new DateTime($tdate);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->format('%a');//now do whatever you like with $days

     //fendy
     $days = floor($days/7);

    $data = DB::connection('mysql')->select('select distinct *,
    IFNULL((select name from active_student where nik = fit_test.nik
    and id = fit_test.user_id),
    (select name from active_student_sutorejo where nik = fit_test.nik
    and id = fit_test.user_id
    )) as nama,
    (select count(id) from fit_daily where fit_test_id = fit_test.id) as total_daily
    from fit_test where fit_time_id = ?
    and (date(created_at) < ?) and id_kelas = (select kode_kelas from syskelas where id = ? and deleted_at is null)
    and id not in (select fit_test_id_start from final_rubrick where deleted_at is null)'
    ,array($time,$period->end_date,$kelas));

    return view('report.persen')
    ->with('cls',$cls)
    ->with('fit_time',$fit_time)
    ->with('kelas',$kelas)
    ->with('time',$time)
    ->with('data',$data)
    ->with('day',$days);


  }
}
