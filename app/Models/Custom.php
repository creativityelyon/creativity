<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
  public static function getSiswa($idGuru)
  {
    return DB::connection('mysql')
    ->select("select a_s.*,sv.tgl,sv.q1,sv.q1_keterangan,sv.q2,sv.q3,sv.q4
    from active_student a_s
    INNER JOIN
    syskelas s on s.kode_kelas = a_s.id_kelas
    INNER JOIN
    survey sv on sv.induk_global = a_s.no_induk_siswa_global
    where s.deleted_at is null and a_s.deleted_at is null and s.id_guru_homeroom
    = ?",array($idGuru));
  }

  public static function getKesehatan()
  {
    return DB::connection('mysql')
    ->select("select k.* from kesehatan k
    INNER JOIN
    active_student a
    on a.no_induk_siswa_global = k.no_induk_siswa_global
    where a.deleted_at is null");
  }

  public static function getCountTotalElyon()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null and lokasi != 'Mana Aja' and lokasi != 'Sutorejo'
    and (id_level >= 5 and id_level <= 10
    or id_level >= 11 and id_level <= 13
    or id_level  >= 0 and id_level <= 4
    or id_level >= 14 and id_level <= 15)
    ");
  }

  public static function getCountTotalAccept()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null
    and id in (select user_id from jajak where is_agree = 0)
    and (id_level >= 5 and id_level <= 10
    or id_level >= 11 and id_level <= 13
    or id_level  >= 0 and id_level <= 4
    or id_level >= 14 and id_level <= 15)
    ");
  }

  public static function getCountTotalReject()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null and lokasi != 'Mana Aja' and lokasi != 'Sutorejo'
    and id in (select user_id from jajak where is_agree = 1)
    and (id_level >= 5 and id_level <= 10
    or id_level >= 11 and id_level <= 13
    or id_level  >= 0 and id_level <= 4
    or id_level >= 14 and id_level <= 15)
    ");
  }

  public static function getCountTotalNotFill()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null and lokasi != 'Mana Aja' and lokasi != 'Sutorejo'
    and (id_level >= 5 and id_level <= 10
    or id_level >= 11 and id_level <= 13
    or id_level  >= 0 and id_level <= 4
    or id_level >= 14 and id_level <= 15)

    and id not in (select user_id from jajak)

    ");
  }

  public static function getCountTotalPriSuko()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Sukomanunggal'
    and id_level >= 5 and id_level <= 10");
  }

  public static function getCountTotalPGKGSuko()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Sukomanunggal'
    and id_level >= 0 and id_level <= 4");
  }

  public static function getCountTotalPGKGKIT()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Kertajaya'
    and id_level >= 0 and id_level <= 4");
  }

  public static function getCountTotalSecDarmo()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Darmo'
    and id_level >= 11 and id_level <= 13");
  }

  public static function getCountTotalHsDarmo()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Darmo'
    and id_level >= 14 and id_level <= 15");
  }

  public static function getCountTotalPGKGSUKOAccept()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Sukomanunggal'
    and id_level >= 0 and id_level <= 4
    and id in (select user_id from jajak where is_agree = 0)
    ");
  }

  public static function getCountTotalPGKGSUKOReject()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Sukomanunggal'
    and id_level >= 0 and id_level <= 4
    and id in (select user_id from jajak where is_agree = 1)
    ");
  }

  public static function getCountTotalPGKGSUKOSkip()
  {
    return DB::connection('mysql')->select("select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Sukomanunggal'
    and id_level >= 0 and id_level <= 4
    and id not in (select user_id from jajak)
    ");
  }


  public static function getCountTotalPGKGKitAccept()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Kertajaya'
    and id_level >= 0 and id_level <= 4
    and id in (select user_id from jajak where is_agree = 0)
    ");
  }

  public static function getCountTotalPGKGKitRefuse()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Kertajaya'
    and id_level >= 0 and id_level <= 4
    and id in (select user_id from jajak where is_agree = 1)
    ");
  }

  public static function getCountTotalPGKGKitSkip()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Kertajaya'
    and id_level >= 0 and id_level <= 4
    and id not in (select user_id from jajak)
    ");
  }

  public static function getCountTotalPriSukoAccept()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Sukomanunggal'
    and id_level >= 5 and id_level <= 10
    and id in (select user_id from jajak where is_agree = 0)
    ");
  }

  public static function getCountTotalPriSukoRefuse()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Sukomanunggal'
    and id_level >= 5 and id_level <= 10
    and id in (select user_id from jajak where is_agree = 1)
    ");
  }

  public static function getCountTotalPriSukoSkip()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Sukomanunggal'
    and id_level >= 5 and id_level <= 10
    and id not in (select user_id from jajak)");
  }

  public static function getCountTotalSecDarmoReject()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Darmo'
    and id_level >= 11 and id_level <= 13
    and id in (select user_id from jajak where is_agree = 1)
    ");
  }

  public static function getCountTotalSecDarmoAccept()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Darmo'
    and id_level >= 11 and id_level <= 13
    and id in (select user_id from jajak where is_agree = 0)
    ");
  }

  public static function getCountTotalSecDarmoSkip()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Darmo'
    and id_level >= 11 and id_level <= 13
    and id not in (select user_id from jajak)");
  }

  public static function getCountTotalHsDarmoRefuse()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Darmo'
    and id_level >= 14 and id_level <= 16
    and id in (select user_id from jajak where is_agree = 1)
    ");
  }

  public static function getCountTotalHsDarmoAccept()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Darmo'
    and id_level >= 14 and id_level <= 16
    and id in (select user_id from jajak where is_agree = 0)
    ");
  }

  public static function getCountTotalHsDarmoSkip()
  {
    return DB::connection('mysql')->select("
    select count(id) as total
    from active_student
    where deleted_at is null and lokasi = 'Darmo'
    and id_level >= 14 and id_level <= 16
    and id not in (select user_id from jajak)
    ");
  }

  public static function getDetailPGKGPTM()
  {
    return DB::connection('mysql')->select("

    ");
  }

  public static function getDetailPGKGPJJ()
  {
    return DB::connection('mysql')->select("

    ");
  }

  public static function getDetailLaporanLomba()
  {
    return DB::connection('mysql')->select("select lomba,kelas_lomba, count(kelas_lomba) as total
    from lomba where deleted_at is null
    GROUP BY lomba,kelas_lomba");
  }

  public static function getDetailLaporanLomba2()
  {
    return DB::connection('mysql')->select("select *
    from lomba where deleted_at is null");
  }

  public static function fit_time_now()
  {
    return DB::connection('mysql')->select("select * from fit_time where ((? between start_date and end_date) or end_date = ?)
    and deleted_at is null limit 1",array(date('Y-m-d'),date('Y-m-d')));
  }

  public static function fit_test_latest($user,$id)
  {
    return DB::connection('mysql')->select("select * from fit_test where user_id = ?
    and deleted_at is null and fit_time_id = ? limit 1",array($user,$id));
  }

  public static function checkDailyNow($user_id,$tgl)
  {
    return DB::connection('mysql')->select("select * from fit_daily where deleted_at is null
    and user_id = ?
    and tgl = ?",array($user_id,date('Y-m-d',strtotime($tgl))));
  }

  //fendy
  public static function checkRepeat($user_id,$start_time, $end_time, $fit_time_id){
    // return DB::connection('mysql')->select("select * from fit_daily where deleted_at is null
    //     and user_id = ?
    //     and tgl_input  >= ? and tgl_input <= ?", array($user_id, date('Y-m-d',strtotime($start_time)),  date('Y-m-d',strtotime($end_time))));

    return DB::connection('mysql')->select("select * from fit_daily where deleted_at is null
        and user_id = ? and fit_time_id = ?
        and YEARWEEK(tgl_input,1) =  YEARWEEK(CURDATE(), 1)
    ", array($user_id, $fit_time_id));
  }

  public static function checkRepeatStaff($user_id,$start_time, $end_time, $fit_time_id){
    // return DB::connection('mysql')->select("select * from fit_daily where deleted_at is null
    //     and user_id = ?
    //     and tgl_input  >= ? and tgl_input <= ?", array($user_id, date('Y-m-d',strtotime($start_time)),  date('Y-m-d',strtotime($end_time))));

    return DB::connection('mysql2')->select("select * from fit_daily where deleted_at is null
        and user_id = ? and fit_time_id = ?
        and YEARWEEK(tgl_input,1) =  YEARWEEK(CURDATE(), 1)
    ", array($user_id, $fit_time_id));
  }


  public static function getVideoNowSD($fit_time_id)
  {
    return DB::connection('mysql')->select("select * from fit_video
    where deleted_at is null and
    (? between start_date and end_date) and
    is_sd = 1
    and fit_time_id = ?
    ",array(date('Y-m-d'),$fit_time_id));
  }

  public static function getVideoNowTK($fit_time_id)
  {
    return DB::connection('mysql')->select("select * from fit_video
    where deleted_at is null and
    (? between start_date and end_date) and
    is_tk = 1
    and fit_time_id = ?
    ",array(date('Y-m-d'),$fit_time_id));
  }

  public static function getVideoNowSMP($fit_time_id)
  {
    return DB::connection('mysql')->select("select * from fit_video
    where deleted_at is null and
    (? between start_date and end_date) and
    is_smp = 1
    and fit_time_id = ?
    ",array(date('Y-m-d'),$fit_time_id));
  }

  public static function getVideoNowSMA($fit_time_id)
  {
    return DB::connection('mysql')->select("select * from fit_video
    where deleted_at is null and
    (? between start_date and end_date) and is_sma = 1
    and fit_time_id = ?
    ",array(date('Y-m-d'),$fit_time_id));
  }

  public static function getDataSiswaCreativitySutorejo($time,$kelas)
  {
    return DB::connection('mysql')->select("select id,name,gender,lokasi,kelas,grade,id_kelas,
    no_induk_siswa_global,id_level
    from active_student_sutorejo where deleted_at is null
    and id_kelas = (select kode_kelas from syskelas where id = ?)
    and no_induk_siswa_global not in (select no_induk_global from creativity_student
    where fit_time_id = ? and deleted_at is null and no_induk_global is not null)",array($kelas,$time));
  }

  public static function getDataSiswaCreativity($time,$kelas)
  {
    return DB::connection('mysql')->select("select id,name,gender,lokasi,kelas,grade,id_kelas,no_induk_siswa_global,id_level
    from active_student where deleted_at is null
    and id_kelas = (select kode_kelas from syskelas where id = ?)
    and no_induk_siswa_global not in (select no_induk_global from creativity_student
    where fit_time_id = ? and deleted_at is null and no_induk_global is not null)",array($kelas,$time));
  }

  //fendy 
  public static function getDataTeacherCreativity($time){
    return DB::connection('mysql2')->select("select id, status_kepegawaian, admin_level,nama_lengkap, nip, syscabang_id from users where deleted_at is null
      and nip not in (select nip from creativity_teacher where fit_time_id = ? and deleted_at is null and nip is not null)", array($time));

  }

  public static function getDataCreativity()
  {
    return DB::connection('mysql')->select("select *,
    IFNULL((select text from creativity_type where kode_creativity = 'creativity_1' and code = creativity_student.creativity_1 and
    (level_min <= creativity_student.grade and level_max >= creativity_student.grade)),'')as cr1,

    IFNULL((select text from creativity_type where kode_creativity = 'creativity_2' and code = creativity_student.creativity_2 and
    (level_min <= creativity_student.grade and level_max >= creativity_student.grade)),'')as cr2,

    IFNULL((select text from creativity_type where kode_creativity = 'creativity_3' and code = creativity_student.creativity_3 and
    (level_min <= creativity_student.grade and level_max >= creativity_student.grade)),'')as cr3,

    IFNULL((select text from creativity_type where kode_creativity = 'creativity_4' and code = creativity_student.creativity_4 and
    (level_min <= creativity_student.grade and level_max >= creativity_student.grade)),'')as cr4,

    IFNULL((select text from creativity_type where kode_creativity = 'creativity_5' and code = creativity_student.creativity_5 and
    (level_min <= creativity_student.grade and level_max >= creativity_student.grade)),'')as cr5,

    IFNULL((select text from creativity_type where kode_creativity = 'creativity_6' and code = creativity_student.creativity_6 and
    (level_min <= creativity_student.grade and level_max >= creativity_student.grade)),'')as cr6
    from creativity_student where deleted_at is null");
  }

  public static function getDataCrativityType($type,$code,$grade)
  {
    return DB::connection('mysql')->select("select text from creativity_type where kode_creativity = ? and code = ? and
    level_min <= ? and level_max >= ? limit 1",array($type,$code,$grade,$grade));
  }



}
