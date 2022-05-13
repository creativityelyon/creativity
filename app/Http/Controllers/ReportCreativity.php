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
   
    return view('creativity.index')->with('cls',$cls)->with('fit_time',$fit_time)->with('data',$data);
  }

  public function getData($time,$kelas)
  {
    $tipe_projek_performing_art = ProjectTipe::where('tipe', 1)->get();
    $tipe_projek_container = ProjectTipe::where('tipe', 2)->get();
    $check_kelas = Syskelas::find($kelas);
    if ($check_kelas->lokasi == 'Sutorejo') {
      $data = Custom::getDataSiswaCreativitySutorejo($time,$kelas);
    }else {
      $data = Custom::getDataSiswaCreativity($time,$kelas);
    }

    return view('creativity.show')->with('data',$data)
                                  ->with('kelas',$check_kelas)
                                  ->with('fit_time',$time)
                                  ->with('kategori_performing', $tipe_projek_performing_art)
                                  ->with('kategori_container', $tipe_projek_container);
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
        $tempContainer = TempContainer::where('id_user',$value)->where('tipe', 2)->where('fit_time_id',$s->fit_time_id)->get();
        $tempPerformingArt = TempContainer::where('id_user', $value)->where('tipe',1)->where('fit_time_id',$s->fit_time_id)->get();
        $s->no_induk_global = $i['no_induk_siswa_global'][$key];
        $s->nama = $i['nama_lengkap'][$key];
        $s->kelas = $i['kelas'][$key];
        $s->grade = $i['grade'][$key];
        $s->lokasi = $i['lokasi'][$key];
        $s->id_kelas = $i['id_kelas'][$key];
        $s->id_level = $i['id_level'][$key];
        $s->gender = $i['gender'][$key];
     
        $cek = false;
     
        if(count($tempContainer) >0){
          $s->container_id = $tempContainer[0]->id;
          $s->description_container = $tempContainer[0]->description;
          $s->level_container = $tempContainer[0]->level;
          $s->nama_proyek_container = $tempContainer[0]->nama_project;
          $cek = true;

          if(count($tempContainer) >1){
            $s->container_id_2 = $tempContainer[1]->id;
            $s->description_container_2 = $tempContainer[1]->description;
            $s->level_container_2 = $tempContainer[1]->level;
            $s->nama_proyek_container_2 = $tempContainer[1]->nama_project;
          }
        }

        if(count($tempPerformingArt) > 0){
          $s->performing_art_id = $tempPerformingArt[0]->id;
          $s->description_performing_art = $tempPerformingArt[0]->description;
          $s->level_performing_art = $tempPerformingArt[0]->level;
          $s->nama_proyek_performing_art = $tempPerformingArt[0]->nama_project;
          $cek = true;

          if(count($tempPerformingArt) > 1) {
            $s->performing_art_id_2 = $tempPerformingArt[1]->id;
            $s->description_performing_art_2 = $tempPerformingArt[1]->description;
            $s->level_performing_art_2 = $tempPerformingArt[1]->level;
            $s->nama_proyek_performing_art_2 = $tempPerformingArt[1]->nama_project;
          }
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

//   // ga dipake 
//   public function edit($id)
//   {
//     $data = CreativityStudent::find($id);
//     $kelas = Syskelas::where('kode_kelas','=',$data->id_kelas)->get();
//     if (empty($data)) {
//       return redirect()->back()->with('error','Data not found');
//     }
//     return view('creativity.edit')->with('d',$data)->with('kelas',$kelas[0]);
//   }

//   public function update(Request $r)
//   {
//     $i = $r->all();
//     $s = CreativityStudent::find($i['id'][0]);
//     if (empty($s)) {
//       return redirect()->back()->with('error','Error Data Contact IT Software for Help');
//     }
//     DB::beginTransaction();
//     try {
//       $s->fit_time_id = $i['fit_time_id'][0];
//       $s->user_id = $i['user_id'][0];
//       $s->no_induk_global = $i['no_induk_siswa_global'][0];
//       $s->nama = $i['nama_lengkap'][0];
//       $s->kelas = $i['kelas'][0];
//       $s->grade = $i['grade'][0];
//       $s->lokasi = $i['lokasi'][0];
//       $s->id_kelas = $i['id_kelas'][0];
//       $s->id_level = $i['id_level'][0];
//       $s->creativity_1 =  (!empty($i['creativity_1'][0])) ? $i['creativity_1'][0] : "Null" ;
//       $s->creativity_2 =  (!empty($i['creativity_2'][0])) ? $i['creativity_2'][0] : "Null" ;
//       $s->creativity_3 =  (!empty($i['creativity_3'][0])) ? $i['creativity_3'][0] : "Null" ;
//       $s->creativity_4 =  (!empty($i['creativity_4'][0])) ? $i['creativity_4'][0] : "Null" ;
//       $s->creativity_5 =  (!empty($i['creativity_5'][0])) ? $i['creativity_5'][0] : "Null" ;
//       $s->creativity_6 =  (!empty($i['creativity_6'][0])) ? $i['creativity_6'][0] : "Null" ;
//       $s->updated_by = Auth::user()->id;
//       $s->save();

//       DB::commit();
//       return redirect('rubrick/creativity')->with('success','Berhasil Update Data');
//     } catch (\Exception $e) {
//       DB::rollback();
//       return $e;
//     }
//   }
//  //

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

  public function showModal($kelas, $id, $time)
  {
    $check_kelas = Syskelas::find($kelas);
   
    if ($check_kelas->lokasi == 'Sutorejo') {
      $murid = ActiveStudentSuto::select('id', 'name', 'gender')->where('id', $id)->first();
    }else {
      $murid = ActiveStudent::select('id', 'name', 'gender')->where('id', $id)->first();
    }

    //for Update
    $data_Temp = null;
    //$data_Temp = TempContainer::where('id_user', $id)->where('tipe', $tipe_projek[0]->tipe)->first();
    return ['murid'=>$murid, 'grade' => $check_kelas, 'old_data' => $data_Temp];
    return view('creativity.partials.secondary-hs-detail', ["id" => $id]);
  }




   //fendy
  //  public function store_penilaian(Request $request){

  //   $data_arr = $request->all();
   
  //   for($i =0; $i<count($data_arr); $i++ ){
  //   $ctr_nilai = 0;

  //   if(!isset($data['nilai_1'][0])){   $data['nilai_1'][0] = null; } else { $ctr_nilai ++; }
  //   if(!isset($data['nilai_2'][0])){   $data['nilai_2'][0] = null; } else { $ctr_nilai ++; }
  //   if(!isset($data['nilai_3'][0])){   $data['nilai_3'][0] = null; } else { $ctr_nilai ++; }
  //   if(!isset($data['nilai_4'][0])){   $data['nilai_4'][0] = null; } else { $ctr_nilai ++; }
  //   if(!isset($data['nilai_5'][0])){   $data['nilai_5'][0] = null; } else { $ctr_nilai ++; }
  //   if(!isset($data['nilai_6'][0])){   $data['nilai_6'][0] = null; } else { $ctr_nilai ++; }

  //   if($data['grade'] == 'KGA' || $data['grade'] == 'KGB' || $data['grade'] == 'PGB'){
  //     if($ctr_nilai < 2){
  //       return redirect()->back()->with('error','Aspek Penilaian Kurang');
  //     }
  //   }else if(intval($data['grade']) >= 1 && intval($data['grade']) <= 6){
  //     if($ctr_nilai < 2){
  //       return redirect()->back()->with('error','Aspek Penilaian Kurang');
  //     }
  //   }else{
  //     if($ctr_nilai < 3){
  //       return redirect()->back()->with('error','Aspek Penilaian Kurang');
  //     }
  //   }

   
  //   if(!isset($data['namapro'][0]))return redirect()->back()->with('error','Nama Project Harurs Di isi');
  // //  dd($data);

  // //cek kga dan kgb
  // if($data['grade'] == 'KGA' || $data['grade'] == 'KGB' || $data['grade'] == 'PGB'){
  //     $data['grade'] = 0;
  // }

  //   $cr1 = CreativityType::where('kode_creativity','=','creativity_1')->where('code','=',$data['nilai_1'][0])
  //   ->where('level_min','<=', $data['grade'])->where('level_max','>=',$data['grade'])->first();
  //   $cr2 = CreativityType::where('kode_creativity','=','creativity_2')->where('code','=',$data['nilai_2'][0])
  //   ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
  //   $cr3 = CreativityType::where('kode_creativity','=','creativity_3')->where('code','=',$data['nilai_3'][0])
  //   ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
  //   $cr4 = CreativityType::where('kode_creativity','=','creativity_4')->where('code','=',$data['nilai_4'][0])
  //   ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
  //   $cr5 = CreativityType::where('kode_creativity','=','creativity_5')->where('code','=',$data['nilai_5'][0])
  //   ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
  //   $cr6 = CreativityType::where('kode_creativity','=','creativity_6')->where('code','=',$data['nilai_6'][0])
  //   ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();

  //   $keterangan =array();

  //   $keterangan[] = [
  //     'aspek' => (empty($cr1)) ? '' : $cr1->creativity_type,
  //     'keterangan' => 'cr1',
  //     'cr' => (empty($cr1)) ? '' : $cr1->text,
  //     'nilai' => $data['nilai_1'][0]
  //   ];
  //   $keterangan[] = [
  //     'aspek' => (empty($cr2)) ? '' : $cr2->creativity_type,
  //     'keterangan' => 'cr2',
  //     'cr' => (empty($cr2)) ? '' : $cr2->text,
  //     'nilai' => $data['nilai_2'][0]
  //   ];
  //   $keterangan[] = [
  //     'aspek' => (empty($cr3)) ? '' : $cr3->creativity_type,
  //     'keterangan' => 'cr3',
  //     'cr' => (empty($cr3)) ? '' : $cr3->text,
  //     'nilai' => $data['nilai_3'][0]
  //   ];
  //   $keterangan[] = [
  //     'aspek' => (empty($cr4)) ? '' : $cr4->creativity_type,
  //     'keterangan' => 'cr4',
  //     'cr' => (empty($cr4)) ? '' : $cr4->text,
  //     'nilai' => $data['nilai_4'][0]
  //   ];
  //   $keterangan[] = [
  //     'aspek' => (empty($cr5)) ? '' : $cr5->creativity_type,
  //     'keterangan' => 'cr5',
  //     'cr' => (empty($cr5)) ? '' : $cr5->text,
  //     'nilai' => $data['nilai_5'][0]
  //   ];
  //   $keterangan[] = [
  //     'aspek' => (empty($cr6)) ? '' : $cr6->creativity_type,
  //     'keterangan' => 'cr6',
  //     'cr' => (empty($cr6)) ? '' : $cr6->text,
  //     'nilai' => $data['nilai_6'][0]
  //   ];

  //   $orderedItems = collect($keterangan)->sortByDesc('nilai');

  //     $keterangan = $orderedItems->toArray();
  //  // dd($keterangan);

  //   $level = 2;
  //   $gender = "He";
  //   if($data['gender'] == 2) $gender = "She";

  //   $description = $data['nama'];
  //   $index = 0;
  //   foreach($keterangan as $d){
  //     if($index == 0){
  //       $description = $description . " ". $d['cr'];
  //     } else {
  //       if(!empty($d['nilai'])){
  //         if(intval($d['nilai']) == 2){
  //           $description = $description. " and ".$gender." ";
  //         }else{
  //           $level = 1;
  //           $description = $description. " but ".$gender." ";
  //         }

  //         $description = $description. $d['cr'];
  //       }
  //     }

  //     $index++;
  //   }

  //   if($data['gender'] ==2){
  //     $description = str_replace("his/her","her",$description);
  //   }else{
  //     $description = str_replace("his/her","his",$description);
  //   }

  //   $data['description'] = $description;

  //   $row = array(
  //     "id_user" => $data['id_user'],
  //     "kelas" => $data['kelas'],
  //     "grade" => $data['grade'],
  //     "nilai_1" => $data['nilai_1'][0],
  //     "nilai_2" => $data['nilai_2'][0],
  //     "nilai_3" => $data['nilai_3'][0],
  //     "nilai_4" => $data['nilai_4'][0],
  //     "nilai_5" => $data['nilai_5'][0],
  //     "nilai_6" => $data['nilai_6'][0],
  //     "fit_time_id" => $data['fit_time_id'],
  //     'tipe' => $data['tipe'],
  //     "description" => $data['description'],
  //     "nama_project" => $data['namapro'][0],
  //     "master_project_tipe" => $data['kategori'],
  //     "level" => $level,
  //   );

  //   if(isset($data['old_data_1'])){
  //     $temp = TempContainer::find($data['old_data_1']) -> update($row);
  //   }else{

  //     $temp = TempContainer::create($row);
  //   }

  //   //kalo yang satunya di add juga

  //   if(isset($data['ceked'])){
  //     $ctr_nilai = 0;

  //     if(!isset($data['nilai_1'][1])){   $data['nilai_1'][1] = null; } else { $ctr_nilai ++; }
  //     if(!isset($data['nilai_2'][1])){   $data['nilai_2'][1] = null; } else { $ctr_nilai ++; }
  //     if(!isset($data['nilai_3'][1])){   $data['nilai_3'][1] = null; } else { $ctr_nilai ++; }
  //     if(!isset($data['nilai_4'][1])){   $data['nilai_4'][1] = null; } else { $ctr_nilai ++; }
  //     if(!isset($data['nilai_5'][1])){   $data['nilai_5'][1] = null; } else { $ctr_nilai ++; }
  //     if(!isset($data['nilai_6'][1])){   $data['nilai_6'][1] = null; } else { $ctr_nilai ++; }
  
  //     if($data['grade'] == 'KGA' || $data['grade'] == 'KGB' || $data['grade'] == 'PGB'){
  //       if($ctr_nilai < 2){
  //         return redirect()->back()->with('error','Aspek Penilaian Kurang');
  //       }
  //     }else if(intval($data['grade']) >= 1 && intval($data['grade']) <= 6){
  //       if($ctr_nilai < 2){
  //         return redirect()->back()->with('error','Aspek Penilaian Kurang');
  //       }
  //     }else{
  //       if($ctr_nilai < 3){
  //         return redirect()->back()->with('error','Aspek Penilaian Kurang');
  //       }
  //     }
  
     
  //     if(!isset($data['namapro'][1]))return redirect()->back()->with('error','Nama Project Harurs Di isi');
  //   //  dd($data);
  
  //   //cek kga dan kgb
  //   if($data['grade'] == 'KGA' || $data['grade'] == 'KGB' || $data['grade'] == 'PGB'){
  //       $data['grade'] = 0;
  //   }
  
  //     $cr1 = CreativityType::where('kode_creativity','=','creativity_1')->where('code','=',$data['nilai_1'][1])
  //     ->where('level_min','<=', $data['grade'])->where('level_max','>=',$data['grade'])->first();
  //     $cr2 = CreativityType::where('kode_creativity','=','creativity_2')->where('code','=',$data['nilai_2'][1])
  //     ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
  //     $cr3 = CreativityType::where('kode_creativity','=','creativity_3')->where('code','=',$data['nilai_3'][1])
  //     ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
  //     $cr4 = CreativityType::where('kode_creativity','=','creativity_4')->where('code','=',$data['nilai_4'][1])
  //     ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
  //     $cr5 = CreativityType::where('kode_creativity','=','creativity_5')->where('code','=',$data['nilai_5'][1])
  //     ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
  //     $cr6 = CreativityType::where('kode_creativity','=','creativity_6')->where('code','=',$data['nilai_6'][1])
  //     ->where('level_min','<=',$data['grade'])->where('level_max','>=',$data['grade'])->first();
  
  //     $keterangan =array();
  
  //     $keterangan[] = [
  //       'aspek' => (empty($cr1)) ? '' : $cr1->creativity_type,
  //       'keterangan' => 'cr1',
  //       'cr' => (empty($cr1)) ? '' : $cr1->text,
  //       'nilai' => $data['nilai_1'][1]
  //     ];
  //     $keterangan[] = [
  //       'aspek' => (empty($cr2)) ? '' : $cr2->creativity_type,
  //       'keterangan' => 'cr2',
  //       'cr' => (empty($cr2)) ? '' : $cr2->text,
  //       'nilai' => $data['nilai_2'][1]
  //     ];
  //     $keterangan[] = [
  //       'aspek' => (empty($cr3)) ? '' : $cr3->creativity_type,
  //       'keterangan' => 'cr3',
  //       'cr' => (empty($cr3)) ? '' : $cr3->text,
  //       'nilai' => $data['nilai_3'][1]
  //     ];
  //     $keterangan[] = [
  //       'aspek' => (empty($cr4)) ? '' : $cr4->creativity_type,
  //       'keterangan' => 'cr4',
  //       'cr' => (empty($cr4)) ? '' : $cr4->text,
  //       'nilai' => $data['nilai_4'][1]
  //     ];
  //     $keterangan[] = [
  //       'aspek' => (empty($cr5)) ? '' : $cr5->creativity_type,
  //       'keterangan' => 'cr5',
  //       'cr' => (empty($cr5)) ? '' : $cr5->text,
  //       'nilai' => $data['nilai_5'][1]
  //     ];
  //     $keterangan[] = [
  //       'aspek' => (empty($cr6)) ? '' : $cr6->creativity_type,
  //       'keterangan' => 'cr6',
  //       'cr' => (empty($cr6)) ? '' : $cr6->text,
  //       'nilai' => $data['nilai_6'][1]
  //     ];
  
  //     $orderedItems = collect($keterangan)->sortByDesc('nilai');
  
  //       $keterangan = $orderedItems->toArray();
  //    // dd($keterangan);
  
  //     $level = 2;
  //     $gender = "He";
  //     if($data['gender'] == 2) $gender = "She";
  
  //     $description = $data['nama'];
  //     $index = 0;
  //     foreach($keterangan as $d){
  //       if($index == 0){
  //         $description = $description . " ". $d['cr'];
  //       } else {
  //         if(!empty($d['nilai'])){
  //           if(intval($d['nilai']) == 2){
  //             $description = $description. " and ".$gender." ";
  //           }else{
  //             $level = 1;
  //             $description = $description. " but ".$gender." ";
  //           }
  
  //           $description = $description. $d['cr'];
  //         }
  //       }
  
  //       $index++;
  //     }
  
  //     if($data['gender'] ==2){
  //       $description = str_replace("his/her","her",$description);
  //     }else{
  //       $description = str_replace("his/her","his",$description);
  //     }
  
  //     $data['description'] = $description;
  
  //     $row = array(
  //       "id_user" => $data['id_user'],
  //       "kelas" => $data['kelas'],
  //       "grade" => $data['grade'],
  //       "nilai_1" => $data['nilai_1'][1],
  //       "nilai_2" => $data['nilai_2'][1],
  //       "nilai_3" => $data['nilai_3'][1],
  //       "nilai_4" => $data['nilai_4'][1],
  //       "nilai_5" => $data['nilai_5'][1],
  //       "nilai_6" => $data['nilai_6'][1],
  //       "fit_time_id" => $data['fit_time_id'],
  //       'tipe' => $data['tipe'],
  //       "description" => $data['description'],
  //       "nama_project" => $data['namapro'][1],
  //       "master_project_tipe" => $data['kategori'],
  //       "level" => $level,
  //     );
  
  //     if(isset($data['old_data_2'])){
  //       $temp = TempContainer::find($data['old_data_2']) -> update($row);
  //     }else{
  
  //       $temp = TempContainer::create($row);
  //     }
  //   }


  //   return redirect()->back()->with('success','Aspek Penilaian Berhasil di Input');
 
  // }

  public function store_penilaian(Request $request){
    $data_arr = $request->only(['user_id', 'fit_time_id','grade', 'lokasi', 'id_kelas', 'pa', 'c', 'kategori_c', 'kategori_pa', 'double_proyek_c', 'double_proyek_pa', 'gender', 'nama_lengkap']);


    $data_nama_proyek_pa = $request->input('nama_proyek_performing_art');
    $data_nama_proyek_c = $request->input('nama_proyek_container');

    $data_nilai_1_pa = $request->input('nilai_1_pa');
    $data_nilai_2_pa = $request->input('nilai_2_pa');
    $data_nilai_3_pa = $request->input('nilai_3_pa');
    $data_nilai_4_pa = $request->input('nilai_4_pa');
    $data_nilai_5_pa = $request->input('nilai_5_pa');
    $data_nilai_6_pa = $request->input('nilai_6_pa');
    
    $data_nilai_1_c = $request->input('nilai_1_c');
    $data_nilai_2_c = $request->input('nilai_2_c');
    $data_nilai_3_c = $request->input('nilai_3_c');
    $data_nilai_4_c = $request->input('nilai_4_c');
    $data_nilai_5_c = $request->input('nilai_5_c');
    $data_nilai_6_c = $request->input('nilai_6_c');
   //  dd(count($data_arr));
 
    // dd($data_nilai_4_c);
    dd($request->all());
    for($i=0; $i< count($data_arr['user_id']); $i++){
      $data_siswa = [
        'id_user' => $data_arr['user_id'][$i],
        'fit_time_id' => $data_arr['fit_time_id'][$i],
        'kelas' => $data_arr['id_kelas'][$i],
        'grade' => $data_arr['grade'][$i],
      ];
      
      //cek data_nilai performing art
      if($data_arr['pa'][$i] == 1){
          $ctr_nilai = 0;
          $data_nilai = [];

          if($data_nilai_1_pa['proyek_1'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_1'] = $data_nilai_1_pa['proyek_1'][$i];
            $data_siswa['nilai_1'] = $data_nilai_1_pa['proyek_1'][$i];
          }else{
            $data_nilai['nilai_1'] = null;
          }
          if($data_nilai_2_pa['proyek_1'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_2'] = $data_nilai_2_pa['proyek_1'][$i];
            $data_siswa['nilai_2'] = $data_nilai_2_pa['proyek_1'][$i];
          }else{
            $data_nilai['nilai_2'] = null;
          }
          if($data_nilai_3_pa['proyek_1'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_3'] = $data_nilai_3_pa['proyek_1'][$i];
            $data_siswa['nilai_3'] = $data_nilai_3_pa['proyek_1'][$i];
          }else{
            $data_nilai['nilai_3'] = null;
          }
          if($data_nilai_4_pa['proyek_1'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_4'] = $data_nilai_4_pa['proyek_1'][$i];
            $data_siswa['nilai_4'] = $data_nilai_4_pa['proyek_1'][$i];
          }else{
            $data_nilai['nilai_4'] = null;
          }
          if($data_nilai_5_pa['proyek_1'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_5'] = $data_nilai_5_pa['proyek_1'][$i];
            $data_siswa['nilai_5'] = $data_nilai_5_pa['proyek_1'][$i];
          }else{
            $data_nilai['nilai_5'] = null;
          }
          if($data_nilai_6_pa['proyek_1'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_6'] = $data_nilai_6_pa['proyek_1'][$i];
            $data_siswa['nilai_6'] = $data_nilai_6_pa['proyek_1'][$i];
          }else{
            $data_nilai['nilai_6'] = null;
          }
          
          if($data_nama_proyek_pa['proyek_1'][$i] == null){
            return redirect()->back()->with('error',' Nama Proyek tidka boleh kosong');
          }
    
          if($data_arr['grade'][$i] == 'KGA' || $data_arr['grade'][$i] == 'KGB' || $data_arr['grade'] [$i]== 'PGB'){
            if($ctr_nilai < 2){
              return redirect()->back()->with('error','Aspek Penilaian Kurang');
            }
          }else if(intval($data_arr['grade'][$i]) >= 1 && intval($data_arr['grade'][$i]) <= 6){
            if($ctr_nilai < 2){
              return redirect()->back()->with('error','Aspek Penilaian Kurang');
            }
          }else{
            if($ctr_nilai < 3){
              return redirect()->back()->with('error','Aspek Penilaian Kurang');
            }
          }

         
          $tmp = $this->DescCreaativity($data_arr['gender'][$i], $data_nilai ,$data_arr['grade'][$i], $data_arr['nama_lengkap'][$i]);
          $data_siswa['description'] = $tmp['description'];
          $data_siswa['level'] = $tmp['level'];
          $data_siswa['nama_project'] = $data_nama_proyek_pa['proyek_1'][$i];
          $data_siswa['master_project_tipe'] = $data_arr['kategori_pa'][$i];
          $data_siswa['tipe'] = 1;
          

          $temp = TempContainer::create($data_siswa);

          //if proyek kedua juga dipakai
          if(intval($data_arr['double_proyek_pa'][$i]) == 1){

            $ctr_nilai = 0;
            $data_nilai = [];

            if($data_nilai_1_pa['proyek_2'][$i] != null){
              $ctr_nilai ++;
              $data_nilai['nilai_1'] = $data_nilai_1_pa['proyek_2'][$i];
              $data_siswa['nilai_1'] = $data_nilai_1_pa['proyek_2'][$i];
            }else{
              $data_nilai['nilai_1'] = null;
            }
            if($data_nilai_2_pa['proyek_2'][$i] != null){
              $ctr_nilai ++;
              $data_nilai['nilai_2'] = $data_nilai_2_pa['proyek_2'][$i];
              $data_siswa['nilai_2'] = $data_nilai_2_pa['proyek_2'][$i];
            }else{
              $data_nilai['nilai_2'] = null;
            }
            if($data_nilai_3_pa['proyek_2'][$i] != null){
              $ctr_nilai ++;
              $data_nilai['nilai_3'] = $data_nilai_3_pa['proyek_2'][$i];
              $data_siswa['nilai_3'] = $data_nilai_3_pa['proyek_2'][$i];
            }else{
              $data_nilai['nilai_3'] = null;
            }
            if($data_nilai_4_pa['proyek_2'][$i] != null){
              $ctr_nilai ++;
              $data_nilai['nilai_4'] = $data_nilai_4_pa['proyek_2'][$i];
              $data_siswa['nilai_4'] = $data_nilai_4_pa['proyek_2'][$i];
            }else{
              $data_nilai['nilai_4'] = null;
            }
            if($data_nilai_5_pa['proyek_2'][$i] != null){
              $ctr_nilai ++;
              $data_nilai['nilai_5'] = $data_nilai_5_pa['proyek_2'][$i];
              $data_siswa['nilai_5'] = $data_nilai_5_pa['proyek_2'][$i];
            }else{
              $data_nilai['nilai_5'] = null;
            }
            if($data_nilai_6_pa['proyek_2'][$i] != null){
              $ctr_nilai ++;
              $data_nilai['nilai_6'] = $data_nilai_6_pa['proyek_2'][$i];
              $data_siswa['nilai_6'] = $data_nilai_6_pa['proyek_2'][$i];
            }else{
              $data_nilai['nilai_6'] = null;
            }
            
            if($data_nama_proyek_pa['proyek_2'][$i] == null){
              return redirect()->back()->with('error',' Nama Proyek tidak boleh kosong');
            }
      
            if($data_arr['grade'][$i] == 'KGA' || $data_arr['grade'][$i] == 'KGB' || $data_arr['grade'] [$i]== 'PGB'){
              if($ctr_nilai < 2){
                return redirect()->back()->with('error','Aspek Penilaian Kurang');
              }
            }else if(intval($data_arr['grade'][$i]) >= 1 && intval($data_arr['grade'][$i]) <= 6){
              if($ctr_nilai < 2){
                return redirect()->back()->with('error','Aspek Penilaian Kurang');
              }
            }else{
              if($ctr_nilai < 3){
                return redirect()->back()->with('error','Aspek Penilaian Kurang');
              }
            }

            $tmp = $this->DescCreaativity($data_arr['gender'][$i], $data_nilai ,$data_arr['grade'][$i], $data_arr['nama_lengkap'][$i]);
            $data_siswa['description'] = $tmp['description'];
            $data_siswa['level'] = $tmp['level'];
            $data_siswa['nama_project'] = $data_nama_proyek_pa['proyek_2'][$i];
            $data_siswa['master_project_tipe'] = $data_arr['kategori_pa'][$i];
            $data_siswa['tipe'] = 1;
            
            $temp = TempContainer::create($data_siswa);
          }





      }

      //cek data_nilai container
      if($data_arr['c'][$i] == 1){
        $ctr_nilai = 0;
        $data_nilai = [];

        if($data_nilai_1_c['proyek_1'][$i] != null){
          $ctr_nilai ++;
          $data_nilai['nilai_1'] = $data_nilai_1_c['proyek_1'][$i];
          $data_siswa['nilai_1'] = $data_nilai_1_c['proyek_1'][$i];
        }else{
          $data_nilai['nilai_1'] = null;
        }
        if($data_nilai_2_c['proyek_1'][$i] != null){
          $ctr_nilai ++;
          $data_nilai['nilai_2'] = $data_nilai_2_c['proyek_1'][$i];
          $data_siswa['nilai_2'] = $data_nilai_2_c['proyek_1'][$i];
        }else{
          $data_nilai['nilai_2'] = null;
        }
        if($data_nilai_3_c['proyek_1'][$i] != null){
          $ctr_nilai ++;
          $data_nilai['nilai_3'] = $data_nilai_3_c['proyek_1'][$i];
          $data_siswa['nilai_3'] = $data_nilai_3_c['proyek_1'][$i];
        }else{
          $data_nilai['nilai_3'] = null;
        }
        if($data_nilai_4_c['proyek_1'][$i] != null){
          $ctr_nilai ++;
          $data_nilai['nilai_4'] = $data_nilai_4_c['proyek_1'][$i];
          $data_siswa['nilai_4'] = $data_nilai_4_c['proyek_1'][$i];
        }else{
          $data_nilai['nilai_4'] = null;
        }
        if($data_nilai_5_c['proyek_1'][$i] != null){
          $ctr_nilai ++;
          $data_nilai['nilai_5'] = $data_nilai_5_c['proyek_1'][$i];
          $data_siswa['nilai_5'] = $data_nilai_5_c['proyek_1'][$i];
        }else{
          $data_nilai['nilai_5'] = null;
        }
        if($data_nilai_6_c['proyek_1'][$i] != null){
          $ctr_nilai ++;
          $data_nilai['nilai_6'] = $data_nilai_6_c['proyek_1'][$i];
          $data_siswa['nilai_6'] = $data_nilai_6_c['proyek_1'][$i];
        }else{
          $data_nilai['nilai_6'] = null;
        }
        
        if($data_nama_proyek_c['proyek_1'][$i] == null){
          return redirect()->back()->with('error',' Nama Proyek tidka boleh kosong');
        }
  
        if($data_arr['grade'][$i] == 'KGA' || $data_arr['grade'][$i] == 'KGB' || $data_arr['grade'] [$i]== 'PGB'){
          if($ctr_nilai < 2){
            return redirect()->back()->with('error','Aspek Penilaian Kurang');
          }
        }else if(intval($data_arr['grade'][$i]) >= 1 && intval($data_arr['grade'][$i]) <= 6){
          if($ctr_nilai < 2){
            return redirect()->back()->with('error','Aspek Penilaian Kurang');
          }
        }else{
          if($ctr_nilai < 3){
            return redirect()->back()->with('error','Aspek Penilaian Kurang');
          }
        }

       
        $tmp = $this->DescCreaativity($data_arr['gender'][$i], $data_nilai ,$data_arr['grade'][$i], $data_arr['nama_lengkap'][$i]);
        $data_siswa['description'] = $tmp['description'];
        $data_siswa['level'] = $tmp['level'];
        $data_siswa['nama_project'] = $data_nama_proyek_c['proyek_1'][$i];
        $data_siswa['master_project_tipe'] = $data_arr['kategori_c'][$i];
        $data_siswa['tipe'] = 1;
        

        $temp = TempContainer::create($data_siswa);

        //if proyek kedua juga dipakai
        if(intval($data_arr['double_proyek_c'][$i]) == 1){

          $ctr_nilai = 0;
          $data_nilai = [];

          if($data_nilai_1_c['proyek_2'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_1'] = $data_nilai_1_c['proyek_2'][$i];
            $data_siswa['nilai_1'] = $data_nilai_1_c['proyek_2'][$i];
          }else{
            $data_nilai['nilai_1'] = null;
          }
          if($data_nilai_2_c['proyek_2'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_2'] = $data_nilai_2_c['proyek_2'][$i];
            $data_siswa['nilai_2'] = $data_nilai_2_c['proyek_2'][$i];
          }else{
            $data_nilai['nilai_2'] = null;
          }
          if($data_nilai_3_c['proyek_2'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_3'] = $data_nilai_3_c['proyek_2'][$i];
            $data_siswa['nilai_3'] = $data_nilai_3_c['proyek_2'][$i];
          }else{
            $data_nilai['nilai_3'] = null;
          }
          if($data_nilai_4_c['proyek_2'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_4'] = $data_nilai_4_c['proyek_2'][$i];
            $data_siswa['nilai_4'] = $data_nilai_4_c['proyek_2'][$i];
          }else{
            $data_nilai['nilai_4'] = null;
          }
          if($data_nilai_5_c['proyek_2'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_5'] = $data_nilai_5_c['proyek_2'][$i];
            $data_siswa['nilai_5'] = $data_nilai_5_c['proyek_2'][$i];
          }else{
            $data_nilai['nilai_5'] = null;
          }
          if($data_nilai_6_c['proyek_2'][$i] != null){
            $ctr_nilai ++;
            $data_nilai['nilai_6'] = $data_nilai_6_c['proyek_2'][$i];
            $data_siswa['nilai_6'] = $data_nilai_6_c['proyek_2'][$i];
          }else{
            $data_nilai['nilai_6'] = null;
          }
          
          if($data_nama_proyek_c['proyek_2'][$i] == null){
            return redirect()->back()->with('error',' Nama Proyek tidak boleh kosong');
          }
    
          if($data_arr['grade'][$i] == 'KGA' || $data_arr['grade'][$i] == 'KGB' || $data_arr['grade'] [$i]== 'PGB'){
            if($ctr_nilai < 2){
              return redirect()->back()->with('error','Aspek Penilaian Kurang');
            }
          }else if(intval($data_arr['grade'][$i]) >= 1 && intval($data_arr['grade'][$i]) <= 6){
            if($ctr_nilai < 2){
              return redirect()->back()->with('error','Aspek Penilaian Kurang');
            }
          }else{
            if($ctr_nilai < 3){
              return redirect()->back()->with('error','Aspek Penilaian Kurang');
            }
          }

          $tmp = $this->DescCreaativity($data_arr['gender'][$i], $data_nilai ,$data_arr['grade'][$i], $data_arr['nama_lengkap'][$i]);
          $data_siswa['description'] = $tmp['description'];
          $data_siswa['level'] = $tmp['level'];
          $data_siswa['nama_project'] = $data_nama_proyek_c['proyek_2'][$i];
          $data_siswa['master_project_tipe'] = $data_arr['kategori_c'][$i];
          $data_siswa['tipe'] = 1;
          
          $temp = TempContainer::create($data_siswa);
        }
      }

    }
  } 



  public function DescCreaativity($gender, $data_nilai, $grade, $nama){
      $cr1 = CreativityType::where('kode_creativity','=','creativity_1')->where('code','=',$data_nilai['nilai_1'])
      ->where('level_min','<=', $grade)->where('level_max','>=',$grade)->first();
      $cr2 = CreativityType::where('kode_creativity','=','creativity_2')->where('code','=',$data_nilai['nilai_2'])
      ->where('level_min','<=',$grade)->where('level_max','>=',$grade)->first();
      $cr3 = CreativityType::where('kode_creativity','=','creativity_3')->where('code','=',$data_nilai['nilai_3'])
      ->where('level_min','<=',$grade)->where('level_max','>=',$grade)->first();
      $cr4 = CreativityType::where('kode_creativity','=','creativity_4')->where('code','=',$data_nilai['nilai_4'])
      ->where('level_min','<=',$grade)->where('level_max','>=',$grade)->first();
      $cr5 = CreativityType::where('kode_creativity','=','creativity_5')->where('code','=',$data_nilai['nilai_5'])
      ->where('level_min','<=',$grade)->where('level_max','>=',$grade)->first();
      $cr6 = CreativityType::where('kode_creativity','=','creativity_6')->where('code','=',$data_nilai['nilai_6'])
      ->where('level_min','<=',$grade)->where('level_max','>=',$grade)->first();

         $keterangan =array();

      $keterangan[] = [
        'aspek' => (empty($cr1)) ? '' : $cr1->creativity_type,
        'keterangan' => 'cr1',
        'cr' => (empty($cr1)) ? '' : $cr1->text,
        'nilai' =>$data_nilai['nilai_1']
      ];
      $keterangan[] = [
        'aspek' => (empty($cr2)) ? '' : $cr2->creativity_type,
        'keterangan' => 'cr2',
        'cr' => (empty($cr2)) ? '' : $cr2->text,
        'nilai' =>$data_nilai['nilai_2']
      ];
      $keterangan[] = [
        'aspek' => (empty($cr3)) ? '' : $cr3->creativity_type,
        'keterangan' => 'cr3',
        'cr' => (empty($cr3)) ? '' : $cr3->text,
        'nilai' =>$data_nilai['nilai_3']
      ];
      $keterangan[] = [
        'aspek' => (empty($cr4)) ? '' : $cr4->creativity_type,
        'keterangan' => 'cr4',
        'cr' => (empty($cr4)) ? '' : $cr4->text,
        'nilai' =>$data_nilai['nilai_4']
      ];
      $keterangan[] = [
        'aspek' => (empty($cr5)) ? '' : $cr5->creativity_type,
        'keterangan' => 'cr5',
        'cr' => (empty($cr5)) ? '' : $cr5->text,
        'nilai' =>$data_nilai['nilai_5']
      ];
      $keterangan[] = [
        'aspek' => (empty($cr6)) ? '' : $cr6->creativity_type,
        'keterangan' => 'cr6',
        'cr' => (empty($cr6)) ? '' : $cr6->text,
        'nilai' =>$data_nilai['nilai_6']
      ];

      $orderedItems = collect($keterangan)->sortByDesc('nilai');

      $keterangan = $orderedItems->toArray();

      $level = 2;
      $genderket = "He";
      if($gender == 2) $genderket = "She";
  
      $description = $nama;
      $index = 0;
      foreach($keterangan as $d){
        if($index == 0){
          $description = $description . " ". $d['cr'];
        } else {
          if(!empty($d['nilai'])){
            if(intval($d['nilai']) == 2){
              $description = $description. " and ".$genderket." ";
            }else{
              $level = 1;
              $description = $description. " but ".$genderket." ";
            }
  
            $description = $description. $d['cr'];
          }
        }
  
        $index++;
      }
  
      if($gender ==2){
        $description = str_replace("his/her","her",$description);
      }else{
        $description = str_replace("his/her","his",$description);
      }
  
     return ['description' => $description, 'level' => $level];

  }
  


  public function creativity_percent(){
    $fit_time = FitTime::get();
     return view('creativity_percent.index')->with('fit_time',$fit_time);
  }

  public function creativity_percent_time($time){
     
      $cls = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
      $ctr = 0;
      foreach($cls as $data_kelas){
       
        $data = null;
        if ($data_kelas->lokasi == 'Sutorejo') {
          $data = Custom::getDataSiswaCreativitySutorejo($time,$data_kelas->id);
        }else {
          $data = Custom::getDataSiswaCreativity($time,$data_kelas->id);
        }

    //     $ctr = 0;
        
    // //    dd($data);
    //     for($i=0; $i< count($data); $i ++){
    //       $temp = TempContainer::where('kelas',$data[$i]->id_kelas)->where('fit_time_id', $time)->first();
    //      for($j=0; $j<count($data); $j++){
    //         $temp2 = TempContainer::where('kelas',$data[$j]->id_kelas)->where('fit_time_id', $time)->first();
    //        if($temp->id_user == $temp2->id_user){
    //          $ctr++;
    //        }
    //      }
    //     }

    //     dd($ctr);

        $temp_novice = TempContainer::where('kelas',$data_kelas->kode_kelas)->where('fit_time_id', $time)->where('level', 1)->get();
        //dd($temp_novice);
        $temp_emerging =  TempContainer::where('kelas',$data_kelas->kode_kelas)->where('fit_time_id', $time)->where('level', 2)->get();
        $total_siswa = count($data);
        $total_temp_novice = count($temp_novice);
        $total_temp_emerging = count($temp_emerging);
        $cls[$ctr]['rata_rata_novice'] = $total_temp_novice/ $total_siswa * 100;
        $cls[$ctr]['rata_rata_emerging'] = $total_temp_emerging/ $total_siswa * 100;
        $ctr++;
      }

      $fit_time = FitTime::get();

      return view('creativity_percent.index')->with('data', $cls)->with('fit_time',$fit_time);

  }



}
