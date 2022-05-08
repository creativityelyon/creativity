<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Syskelas;
use App\Models\FitTime;
use App\Models\Custom;
use App\Models\CreativityStudent;
use App\Models\CreativityType;
use App\Models\ProjectTipe;
use DB;
use Auth;

class ReportCreativity extends Controller
{

  public function index()
  {
    $cls = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
    $fit_time = FitTime::get();
    // $data = Custom::getDataCreativity();
    $data = CreativityStudent::get();
    foreach ($data as $key => $value) {
      $cr1 = CreativityType::where('kode_creativity','=','cr1')->where('code','=',$data[$key]->creativity_1)
      ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();
      $cr2 = CreativityType::where('kode_creativity','=','cr2')->where('code','=',$value->creativity_2)
      ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();
      $cr3 = CreativityType::where('kode_creativity','=','cr3')->where('code','=',$data[$key]->creativity_1)
      ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();
      $cr4 = CreativityType::where('kode_creativity','=','cr4')->where('code','=',$value->creativity_2)
      ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();
      $cr5 = CreativityType::where('kode_creativity','=','cr5')->where('code','=',$data[$key]->creativity_1)
      ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();
      $cr6 = CreativityType::where('kode_creativity','=','cr6')->where('code','=',$value->creativity_2)
      ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();

      $data[$key]->cr1 = (empty($cr1)) ? '' : $cr1->text;
      $data[$key]->cr2 = (empty($cr2)) ? '' : $cr2->text;
      $data[$key]->cr3 = (empty($cr3)) ? '' : $cr3->text;
      $data[$key]->cr4 = (empty($cr4)) ? '' : $cr4->text;
      $data[$key]->cr5 = (empty($cr5)) ? '' : $cr5->text;
      $data[$key]->cr6 = (empty($cr6)) ? '' : $cr6->text;
    }


    foreach ($data as $key => $d) {
      if($d->grade == 'KGA' || $d->grade == 'KGB' || $d->grade == 'PGB'
      || $d->grade == '1' || $d->grade == '2'){
        if ($d->creativity_1 == 2 && $d->creativity_2 == 1) {
          $data[$key]->text = $d->nama.' '.$d->cr1.' but '.(($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2));
        }elseif ($d->creativity_1 == 1 && $d->creativity_2 == 2) {
          $data[$key]->text = $d->nama.' '.$d->cr2.'but'.(($d->gender == 1) ? 'She' : 'He').' '.($d->gender == 1) ? str_replace("his/her","her",$d->cr1) : str_replace("his/her","his",$d->cr1);
        }else {
          $data[$key]->text =
          $d->nama.' '.$d->cr1.' '.(($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2));
        }
      }elseif ($d->grade >= 3 && $d->grade <= 6) {
        if ($d->creativity_1 + $d->creativity_2 + $d->creativity_3 + $d->creativity_4 == 8) {
          $data[$key]->text = $d->nama.' '.
          (($d->creativity_1 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
          (($d->creativity_2 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
          (($d->creativity_3 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
          (($d->creativity_4 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '');

        }else {
          $data[$key]->text = $d->nama.' '.
          (($d->creativity_1 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
          (($d->creativity_2 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
          (($d->creativity_3 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
          (($d->creativity_4 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '').
          'but '.
          (($d->creativity_1 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
          (($d->creativity_2 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
          (($d->creativity_3 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
          (($d->creativity_4 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '');

        }
      }else {
        if ($d->creativity_1 + $d->creativity_2 + $d->creativity_3 + $d->creativity_4 + $d->creativity_5 + $d->creativity_6 == 12) {
          $data[$key]->text = $d->nama.
          (($d->creativity_1 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
          (($d->creativity_2 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
          (($d->creativity_3 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
          (($d->creativity_4 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '').
          (($d->creativity_5 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr5) : 'he '.str_replace("his/her","his",$d->cr5)).' ' : '').
          (($d->creativity_6 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr6) : 'he '.str_replace("his/her","his",$d->cr6)).' ' : '');
        }else {
          $data[$key]->text = $d->nama.
          (($d->creativity_1 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
          (($d->creativity_2 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
          (($d->creativity_3 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
          (($d->creativity_4 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '').
          (($d->creativity_5 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr5) : 'he '.str_replace("his/her","his",$d->cr5)).' ' : '').
          (($d->creativity_6 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr6) : 'he '.str_replace("his/her","his",$d->cr6)).' ' : '').
          'but '.
          (($d->creativity_1 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
          (($d->creativity_2 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
          (($d->creativity_3 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
          (($d->creativity_4 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '').
          (($d->creativity_5 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr5) : 'he '.str_replace("his/her","his",$d->cr5)).' ' : '').
          (($d->creativity_6 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr6) : 'he '.str_replace("his/her","his",$d->cr6)).' ' : '');

        }
      }
    }
    return view('creativity.index')->with('cls',$cls)->with('fit_time',$fit_time)->with('data',$data);
  }

  public function getData($time,$kelas)
  {
    $check_kelas = Syskelas::find($kelas);
    if ($check_kelas->lokasi == 'Sutorejo') {
      $data = Custom::getDataSiswaCreativitySutorejo($time,$kelas);
    }else {
      $data = Custom::getDataSiswaCreativity($time,$kelas);
    }

    return view('creativity.show')->with('data',$data)->with('kelas',$check_kelas)->with('fit_time',$time);
  }

  public function store(Request $r)
  {
    $i = $r->all();
    DB::beginTransaction();
    try {
      // dd($i);
      foreach ($i['user_id'] as $key => $value) {
        $s = new CreativityStudent;
        $s->fit_time_id = $i['fit_time_id'][$key];
        $s->user_id = $value;
        $s->no_induk_global = $i['no_induk_siswa_global'][$key];
        $s->nama = $i['nama_lengkap'][$key];
        $s->kelas = $i['kelas'][$key];
        $s->grade = $i['grade'][$key];
        $s->lokasi = $i['lokasi'][$key];
        $s->id_kelas = $i['id_kelas'][$key];
        $s->id_level = $i['id_level'][$key];
        $s->gender = $i['gender'][$key];
        $s->creativity_1 =  (!empty($i['creativity_1'][$key])) ? $i['creativity_1'][$key] : "Null" ;
        $s->creativity_2 =  (!empty($i['creativity_2'][$key])) ? $i['creativity_2'][$key] : "Null" ;
        $s->creativity_3 =  (!empty($i['creativity_3'][$key])) ? $i['creativity_3'][$key] : "Null" ;
        $s->creativity_4 =  (!empty($i['creativity_4'][$key])) ? $i['creativity_4'][$key] : "Null" ;
        $s->creativity_5 =  (!empty($i['creativity_5'][$key])) ? $i['creativity_5'][$key] : "Null" ;
        $s->creativity_6 =  (!empty($i['creativity_6'][$key])) ? $i['creativity_6'][$key] : "Null" ;
        $s->created_by = Auth::user()->id;
        $s->save();
      }

      DB::commit();
      return redirect('rubrick/creativity')->with('success','Berhasil Menambahkan Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }


  }

  public function edit($id)
  {
    $data = CreativityStudent::find($id);
    $kelas = Syskelas::where('kode_kelas','=',$data->id_kelas)->get();
    if (empty($data)) {
      return redirect()->back()->with('error','Data not found');
    }
    return view('creativity.edit')->with('d',$data)->with('kelas',$kelas[0]);
  }

  public function update(Request $r)
  {
    $i = $r->all();
    $s = CreativityStudent::find($i['id'][0]);
    if (empty($s)) {
      return redirect()->back()->with('error','Error Data Contact IT Software for Help');
    }
    DB::beginTransaction();
    try {
      $s->fit_time_id = $i['fit_time_id'][0];
      $s->user_id = $i['user_id'][0];
      $s->no_induk_global = $i['no_induk_siswa_global'][0];
      $s->nama = $i['nama_lengkap'][0];
      $s->kelas = $i['kelas'][0];
      $s->grade = $i['grade'][0];
      $s->lokasi = $i['lokasi'][0];
      $s->id_kelas = $i['id_kelas'][0];
      $s->id_level = $i['id_level'][0];
      $s->creativity_1 =  (!empty($i['creativity_1'][0])) ? $i['creativity_1'][0] : "Null" ;
      $s->creativity_2 =  (!empty($i['creativity_2'][0])) ? $i['creativity_2'][0] : "Null" ;
      $s->creativity_3 =  (!empty($i['creativity_3'][0])) ? $i['creativity_3'][0] : "Null" ;
      $s->creativity_4 =  (!empty($i['creativity_4'][0])) ? $i['creativity_4'][0] : "Null" ;
      $s->creativity_5 =  (!empty($i['creativity_5'][0])) ? $i['creativity_5'][0] : "Null" ;
      $s->creativity_6 =  (!empty($i['creativity_6'][0])) ? $i['creativity_6'][0] : "Null" ;
      $s->updated_by = Auth::user()->id;
      $s->save();

      DB::commit();
      return redirect('rubrick/creativity')->with('success','Berhasil Update Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }
  }


  public function delete($id)
  {
    $s = CreativityStudent::find($id);
    if (empty($s)) {
      return redirect()->back()->with('error','Error Data Contact IT Software for Help');
    }
    DB::beginTransaction();
    try {
      $s->deleted_by = Auth::user()->id;
      $s->deleted_at = Date('Y-m-d H:i:s');
      $s->save();
      DB::commit();
      return redirect('rubrick/creativity')->with('success','Berhasil Menghapus Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }
  }

  public function showModal($kelas, $id)
  {
    $query = $_GET['tipe'];
    if($query == "Container") {
      $tipe_projek = ProjectTipe::where('tipe', 2)->get();
    }else{
      $tipe_projek = ProjectTipe::where('tipe', 1)->get();
    }
    $check_kelas = Syskelas::find($kelas);

    return ['id'=>$id, 'grade' => $check_kelas, 'tipe' => $tipe_projek];
    //return view('creativity.partials.secondary-hs-detail', ["id" => $id]);
  }
}
