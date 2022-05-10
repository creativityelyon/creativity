<?php

namespace App\Http\Controllers;

use App\Models\ActiveStudent;
use App\Models\ActiveStudentSuto;
use Illuminate\Http\Request;
use App\Models\Syskelas;
use App\Models\FitTime;
use App\Models\Custom;
use App\Models\CreativityStudent;
use App\Models\CreativityType;
use App\Models\ProjectTipe;
use DB;
use Auth;
use App\Models\TempContainer;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class ReportCreativity extends Controller
{

  public function index()
  {
    $cls = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
    $fit_time = FitTime::get();
    // $data = Custom::getDataCreativity();
    $data = CreativityStudent::get();
    // foreach ($data as $key => $value) {
    //   $cr1 = CreativityType::where('kode_creativity','=','cr1')->where('code','=',$data[$key]->creativity_1)
    //   ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();
    //   $cr2 = CreativityType::where('kode_creativity','=','cr2')->where('code','=',$value->creativity_2)
    //   ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();
    //   $cr3 = CreativityType::where('kode_creativity','=','cr3')->where('code','=',$data[$key]->creativity_1)
    //   ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();
    //   $cr4 = CreativityType::where('kode_creativity','=','cr4')->where('code','=',$value->creativity_2)
    //   ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();
    //   $cr5 = CreativityType::where('kode_creativity','=','cr5')->where('code','=',$data[$key]->creativity_1)
    //   ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();
    //   $cr6 = CreativityType::where('kode_creativity','=','cr6')->where('code','=',$value->creativity_2)
    //   ->where('level_min','<=',$value->id_level)->where('level_max','>=',$value->id_level)->first();

    //   $data[$key]->cr1 = (empty($cr1)) ? '' : $cr1->text;
    //   $data[$key]->cr2 = (empty($cr2)) ? '' : $cr2->text;
    //   $data[$key]->cr3 = (empty($cr3)) ? '' : $cr3->text;
    //   $data[$key]->cr4 = (empty($cr4)) ? '' : $cr4->text;
    //   $data[$key]->cr5 = (empty($cr5)) ? '' : $cr5->text;
    //   $data[$key]->cr6 = (empty($cr6)) ? '' : $cr6->text;
    // }


    // foreach ($data as $key => $d) {
    //   if($d->grade == 'KGA' || $d->grade == 'KGB' || $d->grade == 'PGB'
    //   || $d->grade == '1' || $d->grade == '2'){
    //     if ($d->creativity_1 == 2 && $d->creativity_2 == 1) {
    //       $data[$key]->text = $d->nama.' '.$d->cr1.' but '.(($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2));
    //     }elseif ($d->creativity_1 == 1 && $d->creativity_2 == 2) {
    //       $data[$key]->text = $d->nama.' '.$d->cr2.'but'.(($d->gender == 1) ? 'She' : 'He').' '.($d->gender == 1) ? str_replace("his/her","her",$d->cr1) : str_replace("his/her","his",$d->cr1);
    //     }else {
    //       $data[$key]->text =
    //       $d->nama.' '.$d->cr1.' '.(($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2));
    //     }
    //   }elseif ($d->grade >= 3 && $d->grade <= 6) {
    //     if ($d->creativity_1 + $d->creativity_2 + $d->creativity_3 + $d->creativity_4 == 8) {
    //       $data[$key]->text = $d->nama.' '.
    //       (($d->creativity_1 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
    //       (($d->creativity_2 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
    //       (($d->creativity_3 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
    //       (($d->creativity_4 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '');

    //     }else {
    //       $data[$key]->text = $d->nama.' '.
    //       (($d->creativity_1 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
    //       (($d->creativity_2 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
    //       (($d->creativity_3 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
    //       (($d->creativity_4 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '').
    //       'but '.
    //       (($d->creativity_1 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
    //       (($d->creativity_2 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
    //       (($d->creativity_3 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
    //       (($d->creativity_4 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '');

    //     }
    //   }else {
    //     if ($d->creativity_1 + $d->creativity_2 + $d->creativity_3 + $d->creativity_4 + $d->creativity_5 + $d->creativity_6 == 12) {
    //       $data[$key]->text = $d->nama.
    //       (($d->creativity_1 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
    //       (($d->creativity_2 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
    //       (($d->creativity_3 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
    //       (($d->creativity_4 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '').
    //       (($d->creativity_5 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr5) : 'he '.str_replace("his/her","his",$d->cr5)).' ' : '').
    //       (($d->creativity_6 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr6) : 'he '.str_replace("his/her","his",$d->cr6)).' ' : '');
    //     }else {
    //       $data[$key]->text = $d->nama.
    //       (($d->creativity_1 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
    //       (($d->creativity_2 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
    //       (($d->creativity_3 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
    //       (($d->creativity_4 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '').
    //       (($d->creativity_5 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr5) : 'he '.str_replace("his/her","his",$d->cr5)).' ' : '').
    //       (($d->creativity_6 == 2) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr6) : 'he '.str_replace("his/her","his",$d->cr6)).' ' : '').
    //       'but '.
    //       (($d->creativity_1 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr1) : 'he '.str_replace("his/her","his",$d->cr1)).' ' : '').
    //       (($d->creativity_2 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr2) : 'he '.str_replace("his/her","his",$d->cr2)).' ' : '').
    //       (($d->creativity_3 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr3) : 'he '.str_replace("his/her","his",$d->cr3)).' ' : '').
    //       (($d->creativity_4 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr4) : 'he '.str_replace("his/her","his",$d->cr4)).' ' : '').
    //       (($d->creativity_5 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr5) : 'he '.str_replace("his/her","his",$d->cr5)).' ' : '').
    //       (($d->creativity_6 == 1) ?  (($d->gender == 1) ? 'she '.str_replace("his/her","her",$d->cr6) : 'he '.str_replace("his/her","his",$d->cr6)).' ' : '');

    //     }
    //   }
    // }
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
        $tempContainer = TempContainer::where('id_user',$value)->where('tipe', 2)->where('fit_time_id',$s->fit_time_id)->first();
        $tempPerformingArt = TempContainer::where('id_user', $value)->where('tipe',1)->where('fit_time_id',$s->fit_time_id)->first();
        $s->no_induk_global = $i['no_induk_siswa_global'][$key];
        $s->nama = $i['nama_lengkap'][$key];
        $s->kelas = $i['kelas'][$key];
        $s->grade = $i['grade'][$key];
        $s->lokasi = $i['lokasi'][$key];
        $s->id_kelas = $i['id_kelas'][$key];
        $s->id_level = $i['id_level'][$key];
        $s->gender = $i['gender'][$key];
        // $s->creativity_1 =  (!empty($i['creativity_1'][$key])) ? $i['creativity_1'][$key] : "Null" ;
        // $s->creativity_2 =  (!empty($i['creativity_2'][$key])) ? $i['creativity_2'][$key] : "Null" ;
        // $s->creativity_3 =  (!empty($i['creativity_3'][$key])) ? $i['creativity_3'][$key] : "Null" ;
        // $s->creativity_4 =  (!empty($i['creativity_4'][$key])) ? $i['creativity_4'][$key] : "Null" ;
        // $s->creativity_5 =  (!empty($i['creativity_5'][$key])) ? $i['creativity_5'][$key] : "Null" ;
        // $s->creativity_6 =  (!empty($i['creativity_6'][$key])) ? $i['creativity_6'][$key] : "Null" ;
        $cek = false;
        if($tempContainer != null){
          $s->container_id = $tempContainer->id;
          $s->description_container = $tempContainer->description;
          $s->level_container = $tempContainer->level;
          $cek = true;
        }

        if($tempPerformingArt != null){
          $s->performing_art_id = $tempPerformingArt->id;
          $s->description_performing_art = $tempPerformingArt->description;
          $s->level_performing_art = $tempPerformingArt->level;
          $cek = true;
        }
        if($cek){
          $s->created_by = Auth::user()->id;
          $s->save();
        }
      }

      DB::commit();
      return redirect('rubrick/creativity')->with('success','Berhasil Menambahkan Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }


  }

  // ga dipake 
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
 //

  public function delete($id)
  {
    $s = CreativityStudent::find($id);
    if (empty($s)) {
      return redirect()->back()->with('error','Error Data Contact IT Software for Help');
    }
    DB::beginTransaction();
    try {
      $s->deleted_by = Auth::user()->id;

      $temp_container = TempContainer::find($s->container_id);
      if($temp_container != null){
        $temp_container->delete();
      }
      $temp_performing_art = TempContainer::find($s->performing_art_id);
      if($temp_performing_art != null){
        $temp_performing_art->delete();
      }


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
    if ($check_kelas->lokasi == 'Sutorejo') {
      $murid = ActiveStudentSuto::select('id', 'name', 'gender')->where('id', $id)->first();
    }else {
      $murid = ActiveStudent::select('id', 'name', 'gender')->where('id', $id)->first();
    }

    //for Update
    $data_Temp = null;
    $data_Temp = TempContainer::where('id_user', $id)->where('tipe', $tipe_projek[0]->tipe)->first();
    return ['murid'=>$murid, 'grade' => $check_kelas, 'tipe' => $tipe_projek, 'old_data' => $data_Temp];
    //return view('creativity.partials.secondary-hs-detail', ["id" => $id]);
  }




   //fendy
   public function store_penilaian(Request $request){
    // $tipe = $request->input('tipe');
    // $nilai_1 = $request->input('nilai_1');
    // $nilai_2 = $request->input('nilai_2');
    // $nilai_3 = $request->input('nilai_3');
    // $nilai_4 = $request->input('nilai_4');
    // $nilai_5 = $request->input('nilai_5');
    // $nilai_6 = $request->input('nilai_6');
    // $user_id = $request->input('user_id');
    // $kelas = $request -> input('kelas');

    $data = $request->all();

    $ctr_nilai = 0;

    if(!isset($data['nilai_1'])){   $data['nilai_1'] = null; } else { $ctr_nilai ++; }
    if(!isset($data['nilai_2'])){   $data['nilai_2'] = null; } else { $ctr_nilai ++; }
    if(!isset($data['nilai_3'])){   $data['nilai_3'] = null; } else { $ctr_nilai ++; }
    if(!isset($data['nilai_4'])){   $data['nilai_4'] = null; } else { $ctr_nilai ++; }
    if(!isset($data['nilai_5'])){   $data['nilai_5'] = null; } else { $ctr_nilai ++; }
    if(!isset($data['nilai_6'])){   $data['nilai_6'] = null; } else { $ctr_nilai ++; }

    if($data['grade'] == 'KGA' || $data['grade'] == 'KGB' || $data['grade'] == 'PGB'){
      if($ctr_nilai < 2){
        return redirect()->back()->with('error','Aspek Penilaian Kurang');
      }
    }else if(intval($data['grade']) >= 1 && intval($data['grade']) <= 6){
      if($ctr_nilai < 2){
        return redirect()->back()->with('error','Aspek Penilaian Kurang');
      }
    }else{
      if($ctr_nilai < 3){
        return redirect()->back()->with('error','Aspek Penilaian Kurang');
      }
    }

   
    if(!isset($data['nama_project'])) $data['nama_project'] = "";
  //  dd($data);

  //cek kga dan kgb
  if($data['grade'] == 'KGA' || $data['grade'] == 'KGB' || $data['grade'] == 'PGB'){
      $data['grade'] = 0;
  }

    $cr1 = CreativityType::where('kode_creativity','=','creativity_1')->where('code','=',$data['nilai_1'])
    ->where('level_min','<=', $data['grade'])->where('level_max','>=',$data['grade'])->first();
    $cr2 = CreativityType::where('kode_creativity','=','creativity_2')->where('code','=',$data['nilai_2'])
    ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
    $cr3 = CreativityType::where('kode_creativity','=','creativity_3')->where('code','=',$data['nilai_3'])
    ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
    $cr4 = CreativityType::where('kode_creativity','=','creativity_4')->where('code','=',$data['nilai_4'])
    ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
    $cr5 = CreativityType::where('kode_creativity','=','creativity_5')->where('code','=',$data['nilai_5'])
    ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
    $cr6 = CreativityType::where('kode_creativity','=','creativity_6')->where('code','=',$data['nilai_6'])
    ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();

    $keterangan =array();
    // $keterangan['cr1'] = (empty($cr1)) ? '' : $cr1->text;
    // $keterangan['cr2'] = (empty($cr2)) ? '' : $cr2->text;
    // $keterangan['cr3'] = (empty($cr3)) ? '' : $cr3->text;
    // $keterangan['cr4'] = (empty($cr4)) ? '' : $cr4->text;
    // $keterangan['cr5'] = (empty($cr5)) ? '' : $cr5->text;
    // $keterangan['cr6'] = (empty($cr6)) ? '' : $cr6->text;

    $keterangan[] = [
      'aspek' => (empty($cr1)) ? '' : $cr1->creativity_type,
      'keterangan' => 'cr1',
      'cr' => (empty($cr1)) ? '' : $cr1->text,
      'nilai' => $data['nilai_1']
    ];
    $keterangan[] = [
      'aspek' => (empty($cr2)) ? '' : $cr2->creativity_type,
      'keterangan' => 'cr2',
      'cr' => (empty($cr2)) ? '' : $cr2->text,
      'nilai' => $data['nilai_2']
    ];
    $keterangan[] = [
      'aspek' => (empty($cr3)) ? '' : $cr3->creativity_type,
      'keterangan' => 'cr3',
      'cr' => (empty($cr3)) ? '' : $cr3->text,
      'nilai' => $data['nilai_3']
    ];
    $keterangan[] = [
      'aspek' => (empty($cr4)) ? '' : $cr4->creativity_type,
      'keterangan' => 'cr4',
      'cr' => (empty($cr4)) ? '' : $cr4->text,
      'nilai' => $data['nilai_4']
    ];
    $keterangan[] = [
      'aspek' => (empty($cr5)) ? '' : $cr5->creativity_type,
      'keterangan' => 'cr5',
      'cr' => (empty($cr5)) ? '' : $cr5->text,
      'nilai' => $data['nilai_5']
    ];
    $keterangan[] = [
      'aspek' => (empty($cr6)) ? '' : $cr6->creativity_type,
      'keterangan' => 'cr6',
      'cr' => (empty($cr6)) ? '' : $cr6->text,
      'nilai' => $data['nilai_6']
    ];

    $orderedItems = collect($keterangan)->sortByDesc('nilai');

      $keterangan = $orderedItems->toArray();
   // dd($keterangan);

    $level = 2;
    $gender = "He";
    if($data['gender'] == 2) $gender = "She";

    $description = $data['nama'];
    $index = 0;
    foreach($keterangan as $d){
      if($index == 0){
        $description = $description . " ". $d['cr'];
      } else {
        if(!empty($d['nilai'])){
          if(intval($d['nilai']) == 2){
            $description = $description. " and ".$gender." ";
          }else{
            $level = 1;
            $description = $description. " and ".$gender." ";
          }

          $description = $description. $d['cr'];
        }
      }

      $index++;
    }

    if($data['gender'] ==2){
      $description = str_replace("his/her","her",$description);
    }else{
      $description = str_replace("his/her","his",$description);
    }

    $data['description'] = $description;


   // dd($data['description']);

    // if($data['grade'] == 'KGA' || $data['grade'] == 'KGB' || $data['grade'] == 'PGB'
    // || $data['grade'] == '1' || $data['grade'] == '2'){
    //   if ($data['nilai_1'] == 2 && $data['nilai_2'] == 1) {
    //     $data['description'] = $data['nama'].' '.$keterangan['cr1'].' but '.(($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr2']) : 'he '.str_replace("his/her","his",$keterangan['cr2']));
    //   }elseif ($data['nilai_1'] == 1 && $data['nilai_2'] == 2) {
    //     $data['description'] = $data['nama'].' '.$keterangan['cr2'].'but'.(($data['gender'] == 1) ? 'She' : 'He').' '.($data['gender'] == 1) ? str_replace("his/her","her",$keterangan['cr1']) : str_replace("his/her","his",$keterangan['cr1']);
    //   }else {
    //     $level = 2;
    //     $data['description'] =
    //     $data['nama'].' '.$keterangan['cr1'].' '.(($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr2']) : 'he '.str_replace("his/her","his",$keterangan['cr2']));
    //   }
    // }elseif ($data['grade'] >= 3 && $data['grade'] <= 6) {
    //   if ($data['nilai_1'] + $data['nilai_2'] + $data['nilai_3'] + $data['nilai_4'] == 8) {
    //     $level = 2;
    //     $data['description'] = $data['nama'].' '.
    //     (($data['nilai_1'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr1']) : 'he '.str_replace("his/her","his",$keterangan['cr1'])).' ' : '').
    //     (($data['nilai_2'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr2']) : 'he '.str_replace("his/her","his",$keterangan['cr2'])).' ' : '').
    //     (($data['nilai_3'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr3']) : 'he '.str_replace("his/her","his",$keterangan['cr3'])).' ' : '').
    //     (($data['nilai_4'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr4']) : 'he '.str_replace("his/her","his",$keterangan['cr4'])).' ' : '');

    //   }else {
    //     $data['description'] = $data['nama'].' '.
    //     (($data['nilai_1'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr1']) : 'he '.str_replace("his/her","his",$keterangan['cr1'])).' ' : '').
    //     (($data['nilai_2'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr2']) : 'he '.str_replace("his/her","his",$keterangan['cr2'])).' ' : '').
    //     (($data['nilai_3'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr3']) : 'he '.str_replace("his/her","his",$keterangan['cr3'])).' ' : '').
    //     (($data['nilai_4'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr4']) : 'he '.str_replace("his/her","his",$keterangan['cr4'])).' ' : '').
    //     'but '.
    //     (($data['nilai_1'] == 1) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr1']) : 'he '.str_replace("his/her","his",$keterangan['cr1'])).' ' : '').
    //     (($data['nilai_2'] == 1) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr2']) : 'he '.str_replace("his/her","his",$keterangan['cr2'])).' ' : '').
    //     (($data['nilai_3'] == 1) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr3']) : 'he '.str_replace("his/her","his",$keterangan['cr3'])).' ' : '').
    //     (($data['nilai_4'] == 1) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr4']) : 'he '.str_replace("his/her","his",$keterangan['cr4'])).' ' : '');

    //   }
    // }else {
    //   if ($data['nilai_1'] + $data['nilai_2'] + $data['nilai_3'] + $data['nilai_4'] + $data['nilai_5'] + $data['nilai_6'] == 12) {
    //     $level = 2;
    //     $data['description'] = $data['nama'].
    //     (($data['nilai_1'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr1']) : 'he '.str_replace("his/her","his",$keterangan['cr1'])).' ' : '').
    //     (($data['nilai_2'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr2']) : 'he '.str_replace("his/her","his",$keterangan['cr2'])).' ' : '').
    //     (($data['nilai_3'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr3']) : 'he '.str_replace("his/her","his",$keterangan['cr3'])).' ' : '').
    //     (($data['nilai_4'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr4']) : 'he '.str_replace("his/her","his",$keterangan['cr4'])).' ' : '').
    //     (($data['nilai_5'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr5']) : 'he '.str_replace("his/her","his",$keterangan['cr5'])).' ' : '').
    //     (($data['nilai_6'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr6']) : 'he '.str_replace("his/her","his",$keterangan['cr6'])).' ' : '');
    //   }else {
    //     $data['description'] = $data['nama'].
    //     (($data['nilai_1'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr1']) : 'he '.str_replace("his/her","his",$keterangan['cr1'])).' ' : '').
    //     (($data['nilai_2'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr2']) : 'he '.str_replace("his/her","his",$keterangan['cr2'])).' ' : '').
    //     (($data['nilai_3'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr3']) : 'he '.str_replace("his/her","his",$keterangan['cr3'])).' ' : '').
    //     (($data['nilai_4'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr4']) : 'he '.str_replace("his/her","his",$keterangan['cr4'])).' ' : '').
    //     (($data['nilai_5'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr5']) : 'he '.str_replace("his/her","his",$keterangan['cr5'])).' ' : '').
    //     (($data['nilai_6'] == 2) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr6']) : 'he '.str_replace("his/her","his",$keterangan['cr6'])).' ' : '').
    //     'but '.
    //     (($data['nilai_1'] == 1) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr1']) : 'he '.str_replace("his/her","his",$keterangan['cr1'])).' ' : '').
    //     (($data['nilai_2'] == 1) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr2']) : 'he '.str_replace("his/her","his",$keterangan['cr2'])).' ' : '').
    //     (($data['nilai_3'] == 1) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr3']) : 'he '.str_replace("his/her","his",$keterangan['cr3'])).' ' : '').
    //     (($data['nilai_4'] == 1) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr4']) : 'he '.str_replace("his/her","his",$keterangan['cr4'])).' ' : '').
    //     (($data['nilai_5'] == 1) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr5']) : 'he '.str_replace("his/her","his",$keterangan['cr5'])).' ' : '').
    //     (($data['nilai_6'] == 1) ?  (($data['gender'] == 1) ? 'she '.str_replace("his/her","her",$keterangan['cr6']) : 'he '.str_replace("his/her","his",$d->cr6)).' ' : '');
    //   }
   // }

   

    $row = array(
      "id_user" => $data['id_user'],
      "kelas" => $data['kelas'],
      "grade" => $data['grade'],
      "nilai_1" => $data['nilai_1'],
      "nilai_2" => $data['nilai_2'],
      "nilai_3" => $data['nilai_3'],
      "nilai_4" => $data['nilai_4'],
      "nilai_5" => $data['nilai_5'],
      "nilai_6" => $data['nilai_6'],
      "fit_time_id" => $data['fit_time_id'],
      'tipe' => $data['tipe'],
      "description" => $data['description'],
      "nama_project" => $data['nama_project'],
      "master_project_tipe" => $data['kategori'],
      "level" => $level,
    );

    if(isset($data['old_data'])){
      $temp = TempContainer::find($data['old_data']) -> update($row);
    }else{

      $temp = TempContainer::create($row);
    }

    return redirect()->back()->with('success','Aspek Penilaian Berhasil di Input');
 
  }



  public function creativity_percent(){
    $fit_time = FitTime::get();
     return view('creativity_percent.index')->with('fit_time',$fit_time);
  }

  public function creativity_percent_time($time){
     
      $cls = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
      foreach($cls as $data_kelas){
        $data = null;
        if ($data_kelas->lokasi == 'Sutorejo') {
          $data = Custom::getDataSiswaCreativitySutorejo($time,$data_kelas->id);
        }else {
          $data = Custom::getDataSiswaCreativity($time,$data_kelas->id);
        }
        
      }
  }



}
