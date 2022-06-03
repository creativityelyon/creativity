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
use Illuminate\Support\Facades\Auth;
use App\Models\TempContainer;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class ReportCreativity extends Controller
{

  public function index()
  {
   $cls_kelas = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
    $id_user = Auth::user()->id;
    $cls = [];
    if(Auth::user()->admin_level == 5){
      $cls = ProjectTipe::where('teacher_id', $id_user)->get();
    } else if (Auth::user()->admin_level == 1){
      $cls = ProjectTipe::get();
    }
 
    $fit_time = FitTime::get();
    // $data = Custom::getDataCreativity();
    $data = CreativityStudent::get();
   
    return view('creativity.index')->with('cls',$cls)->with('fit_time',$fit_time)->with('data',$data)->with('cls_kelas', $cls_kelas);
  }

  public function filter()
  {
    if($_GET['kelas'] != null){
      $kelas = Syskelas::where('id', $_GET['kelas'])->first();

      
      $cls_kelas = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
      $id_user = Auth::user()->id;
      $cls = [];
      if(Auth::user()->admin_level == 5){
        $cls = ProjectTipe::where('teacher_id', $id_user)->get();
      } else if (Auth::user()->admin_level == 1){
        $cls = ProjectTipe::get();
      }
      
      $fit_time = FitTime::get();
      // $data = Custom::getDataCreativity();
      $data = CreativityStudent::where('id_kelas', $kelas->kode_kelas)->get();
    
      return view('creativity.index')->with('cls',$cls)->with('fit_time',$fit_time)->with('data',$data)->with('cls_kelas', $cls_kelas);
    } else{
      return redirect('rubrick/creativity');
    }
  }

  public function getData($time,$kelas, $tipe)
  {
    $tipe_s = ProjectTipe::where('id',$kelas)->first();
    $temp_data = "";
    $temp_data2 = "";

    if(intval($tipe) == 1){
      $data = Custom::getDataUnionCreativity($time, $kelas);
    } else{
      $data = Custom::getDataUnionCreativityContainer($time, $kelas);
    }

    $temp_data =  json_encode(DB::connection('mysql')->table('temp_container')->select('proyek_ke','nilai_1','nilai_2', 'nilai_3', 'nilai_4', 'nilai_5', 'nilai_6', 'nama_project', 'master_project_tipe')->where('master_project_tipe',$kelas)->where('fit_time_id', $time)->where('tipe',$tipe)->where('proyek_ke',1)->distinct()->get());
    $temp_data2 = json_encode(DB::connection('mysql')->table('temp_container')->select('proyek_ke','nilai_1','nilai_2', 'nilai_3', 'nilai_4', 'nilai_5', 'nilai_6', 'nama_project', 'master_project_tipe')->where('master_project_tipe', $kelas)->where('fit_time_id', $time)->where('tipe',$tipe)->where('proyek_ke',2)->distinct()->get());
    //dd($data);
    return view('creativity.show')->with('data',$data)
                               //   ->with('kelas',$check_kelas)
                                  ->with('kelas',$tipe_s->class_range)
                                  ->with('tipe',$tipe_s)
                                  ->with('kategori', $kelas)
                                  -> with('temp_data', $temp_data)
                                  -> with('temp_data2', $temp_data2)
                                  ->with('fit_time',$time);
  }

  public function store(Request $r)
  {
   
    
    $kelas = $r->input('kelas');
    $time = $r->input('time');
    $r->validate([
      'time' => 'required',
       'kelas' => 'required',
    ]);
    $i = [];
    $check_kelas = Syskelas::find($kelas);
    if ($check_kelas->lokasi == 'Sutorejo') {
      $i = Custom::getDataSiswaCreativitySutorejo($time,$kelas);
    }else {
      $i = Custom::getDataSiswaCreativity($time,$kelas);
    }


    DB::beginTransaction();
    try {
     
      for ($key =0; $key < count($i); $key++) {
        
        $s = new CreativityStudent;
        $s->fit_time_id = intval($time);
     
        $value  = $i[$key]->id;
        $s->user_id = $value;
     
        $tempContainer = TempContainer::where('id_user',$value)->where('tipe', 2)->where('fit_time_id',$s->fit_time_id)->get();
        $tempPerformingArt = TempContainer::where('id_user', $value)->where('tipe',1)->where('fit_time_id',$s->fit_time_id)->get();
        $s->no_induk_global = $i[$key]->no_induk_siswa_global;
        $s->nama = $i[$key]->name;
        $s->kelas = $i[$key]->kelas;
        $s->grade = $i[$key]->grade;
        $s->lokasi = $i[$key]->lokasi;
        $s->id_kelas = $i[$key]->id_kelas;
        $s->id_level = $i[$key]->id_level;
        $s->gender = $i[$key]->gender;
     
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
     // return ['msg' => 'Berhasil', 'status' => 1];
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
     // return ['msg' => $e, 'status' => 0];
    }


  }

//   // ga dipake 
  public function edit($id)
  {
    $data = CreativityStudent::find($id);
    $kelas = Syskelas::where('kode_kelas','=',$data->id_kelas)->get();

    $performing_art = null;
    $container = null;
    $performing_art_2 = null;
    $container_2 = null;

    $performing_art = TempContainer::find($data->performing_art_id);
    $container = TempContainer::find($data->container_id);
    $performing_art_2 = TempContainer::find($data->performing_art_id_2);
    $container_2 = TempContainer::find($data->container_id_2);

    if (empty($data)) {
      return redirect()->back()->with('error','Data not found');
    }
    return view('creativity.edit')->with('d',$data)->with('kelas',$kelas[0])
              ->with('performing_art', $performing_art)
              ->with('container', $container)
              ->with('performing_art_2', $performing_art_2)
              ->with('container_2', $container_2);
  }

  public function update(Request $r){
      $creativity_id = $r->creativity_id;
      $performing_art_id = $r->performing_art_id;
      $performing_art_id_2 = $r->performing_art_id_2;
      $container_id  = $r->container_id;
      $container_id_2 = $r->container_id_2;

      $grade = $r->grade;
      $gender = $r->gender;
      $nama = $r->nama_lengkap;
      $id_user = $r->id_user;
      $fit_time_id = $r->fit_time_id;
      DB::beginTransaction();
      try{
          //update temp container
          if($performing_art_id){
            $pa = $this->issetNilai($r, 'nilai_pa_');
            $tmp = $this->DescCreaativity($gender,$pa,$grade,$nama);
            TempContainer::where('id', $performing_art_id)->update($pa);
            TempContainer::where('id', $performing_art_id)->update($tmp);
          }

          if($performing_art_id_2){
            $pa2 = $this->issetNilai($r, 'nilai_pa2_');
            $tmp = $this->DescCreaativity($gender,$pa,$grade,$nama);
            TempContainer::where('id', $performing_art_id_2)->update($pa2);
            TempContainer::where('id', $performing_art_id_2)->update($tmp);
          }

          if($container_id){
            $co = $this->issetNilai($r, 'nilai_c_');
            $tmp = $this->DescCreaativity($gender,$co,$grade,$nama);
            TempContainer::where('id', $container_id)->update($co);
            TempContainer::where('id', $container_id)->update($tmp);
          }

          if($container_id_2){
            $co2 = $this->issetNilai($r, 'nilai_c2_');
            $tmp = $this->DescCreaativity($gender,$co2,$grade,$nama);
            TempContainer::where('id', $container_id)->update($co2);
            TempContainer::where('id', $container_id)->update($tmp);
          }


          $tempContainer = TempContainer::where('id_user',$id_user)->where('tipe', 2)->where('fit_time_id',$fit_time_id)->get();
          $tempPerformingArt = TempContainer::where('id_user', $id_user)->where('tipe',1)->where('fit_time_id',$fit_time_id)->get();
          $s = CreativityStudent::where('id', $creativity_id)->first();
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
            DB::commit();
            return redirect('rubrick/creativity')->with('success','Berhasil Mengubah Data');
          }
      }catch (\Exception $e) {
        DB::rollback();
        dd($e);
      }

  }


  function issetNilai($r, $key){
    $pa = [];
    for($i=1 ; $i<=6; $i++){
      $idx = 'nilai_'.$i;
      $k = $key.$i;
       if(isset($r[$k])){
        $pa[$idx] = intval($r[$k]);
      } else {
          $pa[$idx] = null;
      }

    }

    return $pa;

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
    return ['grade' => $check_kelas, 'old_data' => $data_Temp, 'murid'=> $murid];
    return view('creativity.partials.secondary-hs-detail', ["id" => $id]);
  }




  public function store_penilaian(Request $request){

    //return  $data_arr;
    $data_arr = [];
    $data_arr['user_id'] = json_decode(stripslashes($request->input('user_id')));
    $data_arr['fit_time_id'] = json_decode(stripslashes($request->input('fit_time_id')));
    $data_arr['kelas'] = json_decode(stripslashes($request->input('kelas')));
     $data_arr['grade'] = json_decode(stripslashes($request->input('grade')));
    $data_arr['lokasi'] = json_decode(stripslashes($request->input('lokasi')));
    $data_arr['nama_lengkap'] = json_decode(stripslashes($request->input('nama_lengkap')));
    $data_arr['kategori'] = json_decode(stripslashes($request->input('kategori')));
    $data_arr['id_kelas'] = json_decode(stripslashes($request->input('id_kelas')));
    $data_arr['id_level'] = json_decode(stripslashes($request->input('id_level')));
    $data_arr['gender'] = json_decode(stripslashes($request->input('gender')));
    $data_arr['double_project'] = json_decode(stripslashes($request->input('double_project')));
   $data_arr['tipe_project'] = json_decode(stripslashes($request->input('tipe_project')));
    $data_arr['arrold'] = json_decode(stripslashes($request->input('arrold')));

    

    $data_nama_proyek = json_decode($request->input('nama_project'));
    $data_nilai_1 = json_decode($request->input('data_nilai_1'));
    $data_nilai_2 = json_decode($request->input('data_nilai_2'));
    $data_nilai_3 = json_decode($request->input('data_nilai_3'));
    $data_nilai_4 = json_decode($request->input('data_nilai_4'));
    $data_nilai_5 = json_decode($request->input('data_nilai_5'));
    $data_nilai_6 = json_decode($request->input('data_nilai_6'));
   
    //return json_decode(stripslashes($_POST['nama_project']));
//    dd($_POST);

    DB::beginTransaction();
    try {
    for($i=0; $i< count($data_arr['user_id']); $i++){
      $data_siswa = [
        'id_user' => $data_arr['user_id'][$i],
        'fit_time_id' => $data_arr['fit_time_id'][$i],
        'kelas' => $data_arr['id_kelas'][$i],
        'grade' => $data_arr['grade'][$i],
      ];

       $data_id = json_decode($data_arr['arrold'][$i]);

          $ctr_nilai = 0;
          $data_nilai = [];

          if($data_nilai_1[$i]->proyek_1 != null){
            $ctr_nilai ++;
            $data_nilai['nilai_1'] = $data_nilai_1[$i]->proyek_1;
            $data_siswa['nilai_1'] = $data_nilai_1[$i]->proyek_1;
          }else{
            $data_nilai['nilai_1'] = null;
            $data_siswa['nilai_1'] = null;
          }
          if($data_nilai_2[$i]->proyek_1 != null){
            $ctr_nilai ++;
            $data_nilai['nilai_2'] = $data_nilai_2[$i]->proyek_1;
            $data_siswa['nilai_2'] = $data_nilai_2[$i]->proyek_1;
          }else{
            $data_nilai['nilai_2'] = null;
            $data_siswa['nilai_2'] = null;
          }
          if($data_nilai_3[$i]->proyek_1 != null){
            $ctr_nilai ++;
            $data_nilai['nilai_3'] = $data_nilai_3[$i]->proyek_1;
            $data_siswa['nilai_3'] = $data_nilai_3[$i]->proyek_1;
          }else{
            $data_nilai['nilai_3'] = null;
            $data_siswa['nilai_3'] = null;
          }
          if($data_nilai_4[$i]->proyek_1 != null){
            $ctr_nilai ++;
            $data_nilai['nilai_4'] = $data_nilai_4[$i]->proyek_1;
            $data_siswa['nilai_4'] = $data_nilai_4[$i]->proyek_1;
          }else{
            $data_nilai['nilai_4'] = null;
            $data_siswa['nilai_4'] = null;
          }
          if($data_nilai_5[$i]->proyek_1 != null){
            $ctr_nilai ++;
            $data_nilai['nilai_5'] = $data_nilai_5[$i]->proyek_1;
            $data_siswa['nilai_5'] = $data_nilai_5[$i]->proyek_1;
          }else{
            $data_nilai['nilai_5'] = null;
            $data_siswa['nilai_5'] = null;
          }
          if($data_nilai_6[$i]->proyek_1 != null){
            $ctr_nilai ++;
            $data_nilai['nilai_6'] = $data_nilai_6[$i]->proyek_1;
            $data_siswa['nilai_6'] = $data_nilai_6[$i]->proyek_1;
          }else{
            $data_nilai['nilai_6'] = null;
            $data_siswa['nilai_6'] = null;
          }
          
          if($data_nama_proyek[$i]->proyek_1 == null){
           // return redirect()->back()->with('error',' Nama Proyek tidka boleh kosong');
           return ['msg' =>'gagal Nama Proyek kosong', 'status' => 0];
          }
    
          if($data_arr['grade'][$i] == 'KGA' || $data_arr['grade'][$i] == 'KGB' || $data_arr['grade'] [$i]== 'PGB'){
            if($ctr_nilai < 2){
              //return redirect()->back()->with('error','Aspek Penilaian Kurang');
              return ['msg' => 'aspek penilaian kurang', 'status' => 0];
            }
          }else if(intval($data_arr['grade'][$i]) >= 1 && intval($data_arr['grade'][$i]) <= 6){
            if($ctr_nilai < 2){
                //return redirect()->back()->with('error','Aspek Penilaian Kurang');
                return ['msg' => 'aspek penilaian kurang', 'status' => 0];           }
          }else{
            if($ctr_nilai < 3){
                //return redirect()->back()->with('error','Aspek Penilaian Kurang');
                return ['msg' => 'aspek penilaian kurang', 'status' => 0];           }
          }

         
          $tmp = $this->DescCreaativity($data_arr['gender'][$i], $data_nilai ,$data_arr['grade'][$i], $data_arr['nama_lengkap'][$i]);
          $data_siswa['description'] = $tmp['description'];
          $data_siswa['level'] = $tmp['level'];
          $data_siswa['nama_project'] = $data_nama_proyek[$i]->proyek_1;
          $data_siswa['master_project_tipe'] = $data_arr['kategori'][$i];
          $data_siswa['tipe'] = $data_arr['tipe_project'][$i];
          $data_siswa['proyek_ke'] = 1;
           if($data_id[0] == null){
             $temp = TempContainer::create($data_siswa);
           }else{
             $temp = TempContainer::where('id',intval($data_id[0]))->update($data_siswa);
           }

          //if proyek kedua juga dipakai
          if(intval($data_arr['double_project'][$i]) == 1){

            $ctr_nilai = 0;
            $data_nilai = [];

            if($data_nilai_1[$i]->proyek_2 != null){
              $ctr_nilai ++;
              $data_nilai['nilai_1'] = $data_nilai_1[$i]->proyek_2;
              $data_siswa['nilai_1'] = $data_nilai_1[$i]->proyek_2;
            }else{
              $data_nilai['nilai_1'] = null;
              $data_siswa['nilai_1'] = null;
            }
            if($data_nilai_2[$i]->proyek_2 != null){
              $ctr_nilai ++;
              $data_nilai['nilai_2'] = $data_nilai_2[$i]->proyek_2;
              $data_siswa['nilai_2'] = $data_nilai_2[$i]->proyek_2;
            }else{
              $data_nilai['nilai_2'] = null;
              $data_siswa['nilai_2'] = null;
            }
            if($data_nilai_3[$i]->proyek_2 != null){
              $ctr_nilai ++;
              $data_nilai['nilai_3'] = $data_nilai_3[$i]->proyek_2;
              $data_siswa['nilai_3'] = $data_nilai_3[$i]->proyek_2;
            }else{
              $data_nilai['nilai_3'] = null;
              $data_siswa['nilai_3'] = null;
            }
            if($data_nilai_4[$i]->proyek_2 != null){
              $ctr_nilai ++;
              $data_nilai['nilai_4'] = $data_nilai_4[$i]->proyek_2;
              $data_siswa['nilai_4'] = $data_nilai_4[$i]->proyek_2;
            }else{
              $data_nilai['nilai_4'] = null;
              $data_siswa['nilai_4'] = null;
            }
            if($data_nilai_5[$i]->proyek_2 != null){
              $ctr_nilai ++;
              $data_nilai['nilai_5'] = $data_nilai_5[$i]->proyek_2;
              $data_siswa['nilai_5'] = $data_nilai_5[$i]->proyek_2;
            }else{
              $data_nilai['nilai_5'] = null;
              $data_siswa['nilai_5'] = null;
            }
            if($data_nilai_6[$i]->proyek_2 != null){
              $ctr_nilai ++;
              $data_nilai['nilai_6'] = $data_nilai_6[$i]->proyek_2;
              $data_siswa['nilai_6'] = $data_nilai_6[$i]->proyek_2;
            }else{
              $data_nilai['nilai_6'] = null;
              $data_siswa['nilai_6'] = null;
            }
            
            if($data_nama_proyek[$i]->proyek_2 == null){
              //return redirect()->back()->with('error',' Nama Proyek tidak boleh kosong');
              return ['msg'=>'nama proyek kosong', 'status' => 0];
            }
      
            if($data_arr['grade'][$i] == 'KGA' || $data_arr['grade'][$i] == 'KGB' || $data_arr['grade'] [$i]== 'PGB'){
              if($ctr_nilai < 2){
                //return redirect()->back()->with('error','Aspek Penilaian Kurang');
              return ['msg' => 'aspek penilaian kurang', 'status' => 0];
              }
            }else if(intval($data_arr['grade'][$i]) >= 1 && intval($data_arr['grade'][$i]) <= 6){
              if($ctr_nilai < 2){
                 //return redirect()->back()->with('error','Aspek Penilaian Kurang');
              return ['msg' => 'aspek penilaian kurang', 'status' => 0];
              }
            }else{
              if($ctr_nilai < 3){
                //return redirect()->back()->with('error','Aspek Penilaian Kurang');
              return ['msg' => 'aspek penilaian kurang', 'status' => 0];
              }
            }

            $tmp = $this->DescCreaativity($data_arr['gender'][$i], $data_nilai ,$data_arr['grade'][$i], $data_arr['nama_lengkap'][$i]);
            $data_siswa['description'] = $tmp['description'];
            $data_siswa['level'] = $tmp['level'];
            $data_siswa['nama_project'] = $data_nama_proyek[$i]->proyek_2;
            $data_siswa['master_project_tipe'] = $data_arr['kategori'][$i];
            $data_siswa['tipe'] = $data_arr['tipe_project'][$i];
            $data_siswa['proyek_ke'] = 2;
          if($data_id[1] == null){
              $temp = TempContainer::create($data_siswa);
          }else{
             $temp = TempContainer::where('id',intval($data_id[1]))->update($data_siswa);
           }
          }

     // }

     
    }
    DB::commit();
    // return redirect()->back()->with('success','Berhasil di Input');
    return ['msg'=>'berhasil', 'status' => 1];
    } catch(\Exception $e){
      
      DB::rollback();
      return $e;
      
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

      $ctr_level = 0;
      $index2 = 0;

      foreach($keterangan as $d){
        if($index == 0){
          $description = $description . " ". $d['cr'];
          $ctr_level = $ctr_level + intval($d['nilai']);
          $index2 ++;
        } else {
          if(!empty($d['nilai'])){
            if(intval($d['nilai']) == 2){
              $description = $description. " and ".$genderket." ";
            }else{
             // $level = 1;
              $description = $description. " but ".$genderket." ";
            }
            $ctr_level = $ctr_level + intval($d['nilai']);
            $index2 ++;
            $description = $description. $d['cr'];
          }
        }
       
        $index++;
      }

      $level = $ctr_level /$index2;

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



  public function cekRekap(Request $request){
    $rekap_time = $request->input('rekap_time');
    $rekap_kelas = $request->input('rekap_kelas');
   
    $kelas = Syskelas::find($rekap_kelas);
    $murid = [];
    if ($kelas->lokasi == 'Sutorejo') {
      $murid = ActiveStudentSuto::where('id_kelas', $kelas->kode_kelas)->get();
    }else {
      $murid = ActiveStudent::where('id_kelas', $kelas->kode_kelas)->get();
    }
    $cek = true;
    $data_project = [];
    //return json_encode($murid);
    $ctr = 0;
    for($i=0; $i<count($murid); $i++){
      // if($kelas->grade == "KGA" || $kelas->grade == "KGB" || $kelas->grade == "PGA" || $kelas->grade == "PGB" || ($kelas->grade>= 1 &&  $kelas->grade <= 6)){
        $tmp = null;
        $tmp = TempContainer::where('id_user', $murid[$i]->id)->where('fit_time_id', $rekap_time)->where('tipe',1 )->get();
        if(count($tmp) == 0 || $tmp== null){
         
          $cek = false;
          if($murid[$i]->project_course_id){
            $nama_project = ProjectTipe::find($murid[$i]->project_course_id);
            $data_project[$ctr] = $nama_project->nama;
            $ctr++;
          }

        } 

      
      // }
     
      if(intval($kelas->grade)>= 7 &&  intval($kelas->grade )<= 12){
        $tmp = null;
        $tmp = TempContainer::where('id_user', $murid[$i]->id)->where('fit_time_id', $rekap_time)->where('tipe',2 )->get();
        if(count($tmp) == 0 || $tmp== null){
          $cek = false;
          if($murid[$i]->project_container_id){
            $nama_project = ProjectTipe::find($murid[$i]->project_container_id);
            $data_project[$ctr] = $nama_project->nama;
            $ctr++;
          }    
        } 
      }
    }

    if($cek == false){
      $cek = json_encode($data_project);
    }

    return $cek;



  }


}
