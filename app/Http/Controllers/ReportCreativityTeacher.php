<?php

namespace App\Http\Controllers;

use App\Models\CreativityTeacher;
use App\Models\Custom;
use Illuminate\Http\Request;
use App\Models\FitTime;


class ReportCreativityTeacher extends Controller
{
    public function index()
    {
      //$cls = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
      $fit_time = FitTime::get();
      // $data = Custom::getDataCreativity();
      $data = CreativityTeacher::get();
     
      return view('creativity_teacher.index')->with('data',$data) ->with('fit_time',$fit_time);
    }


    public function getData($time)
    {
     // $tipe_projek_performing_art = ProjectTipe::where('tipe', 1)->get();
     // $tipe_projek_container = ProjectTipe::where('tipe', 2)->get();
      // $check_kelas = Syskelas::find($kelas);
  
      // $temp_pa = json_encode(DB::connection('mysql')->table('temp_container')->select('proyek_ke','nilai_1','nilai_2', 'nilai_3', 'nilai_4', 'nilai_5', 'nilai_6', 'nama_project', 'master_project_tipe')->where('kelas', $check_kelas->kode_kelas)->where('fit_time_id', $time)->where('grade', $check_kelas->grade)->where('tipe',1)->where('proyek_ke',1)->distinct()->get());
      // $temp_container = json_encode(DB::connection('mysql')->table('temp_container')->select('proyek_ke','nilai_1','nilai_2', 'nilai_3', 'nilai_4', 'nilai_5', 'nilai_6', 'nama_project', 'master_project_tipe')->where('kelas', $check_kelas->kode_kelas)->where('fit_time_id', $time)->where('grade', $check_kelas->grade)->where('tipe',2)->where('proyek_ke',1)->distinct()->get());
      // $temp_pa2 = json_encode(DB::connection('mysql')->table('temp_container')->select('proyek_ke','nilai_1','nilai_2', 'nilai_3', 'nilai_4', 'nilai_5', 'nilai_6', 'nama_project', 'master_project_tipe')->where('kelas', $check_kelas->kode_kelas)->where('fit_time_id', $time)->where('grade', $check_kelas->grade)->where('tipe',1)->where('proyek_ke',2)->distinct()->get());
      // $temp_container2 = json_encode(DB::connection('mysql')->table('temp_container')->select('proyek_ke','nilai_1','nilai_2', 'nilai_3', 'nilai_4', 'nilai_5', 'nilai_6', 'nama_project', 'master_project_tipe')->where('kelas', $check_kelas->kode_kelas)->where('fit_time_id', $time)->where('grade', $check_kelas->grade)->where('tipe',2)->where('proyek_ke',2)->distinct()->get());
     
      // if ($check_kelas->lokasi == 'Sutorejo') {
      //   $data = Custom::getDataSiswaCreativitySutorejo($time,$kelas);
      // }else {
      //   $data = Custom::getDataSiswaCreativity($time,$kelas);
      // }

      $data = Custom::getDataTeacherCreativity($time);
  
      return view('creativity_teacher.show')->with('data',$data)
                                 //   ->with('kelas',$check_kelas)
                                    ->with('fit_time',$time)
                                   // ->with('kategori_performing', $tipe_projek_performing_art)
                                   // ->with('kategori_container', $tipe_projek_container)
                                   // ->with('performing_art', $temp_pa)
                                   // ->with('container', $temp_container)
                                   // ->with('performing_art2', $temp_pa2 )
                                   // ->with('container2', $temp_container2)
                                   ;
    }
  
}
