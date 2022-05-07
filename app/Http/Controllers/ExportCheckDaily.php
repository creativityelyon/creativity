<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\FitDailyImport;
use Auth;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use App\Models\FitTest;
use App\Models\FitTestStaff;
use App\Models\FitTestTemp;
use App\Models\ActiveStudent;
use App\Models\ActiveStudentSuto;
use App\Models\FitDaily;
use App\Models\FitTestTempStaff;
use App\Models\FitTime;
use App\Models\Teacher;
use App\Models\FitDailyTemp;

class ExportCheckDaily extends Controller
{
    //

    public function index(){
        return view('fit_test_manual.daily');
    }

    public function storeFile(Request $r)
  {
    $r->validate([
      // 'location' => 'required',
      'attendance_file.*' => 'required|file|mimes:xls,xlsx',
      // 'attendance_file' => 'required|file',
    ]);

    // $total_sebelum = FitImport::count();

    DB::beginTransaction();

    try {

        foreach(request()->file('attendance_file') as $file)
        {
            Excel::import(new FitDailyImport, $file);
        }


    } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('error', 'Not a valid xls or csv files. ');

    } catch (Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('error', 'Problems has occured, please retry.');
    }

    DB::commit();
    return redirect()->back()->with('info', 'Date successfully uploaded.');

  }


  public function runSync()
  {
    $gl = array();
    $gl[0]['senin'] = '21 March 2022';
    $gl[0]['selasa'] = '22 March 2022';
    $gl[0]['rabu'] = '23 March 2022';
    $gl[0]['kamis'] = '24 March 2022';
    $gl[0]['jumat'] = '25 March 2022';
    $gl[0]['sabtu'] = '26 March 2022';
    $gl[0]['minggu'] = '27 March 2022';

    $gl[1]['senin'] = '28 March 2022';
    $gl[1]['selasa'] = '29 March 2022';
    $gl[1]['rabu'] = '30 March 2022';
    $gl[1]['kamis'] = '31 March 2022';
    $gl[1]['jumat'] = '1 April 2022';
    $gl[1]['sabtu'] = '2 April 2022';
    $gl[1]['minggu'] = '3 April 2022';

    $gl[2]['senin'] = '4 April 2022';
    $gl[2]['selasa'] = '5 April 2022';
    $gl[2]['rabu'] = '6 April 2022';
    $gl[2]['kamis'] = '7 April 2022';
    $gl[2]['jumat'] = '8 April 2022';
    $gl[2]['sabtu'] = '9 April 2022';
    $gl[2]['minggu'] = '10 April 2022';

    $gl[3]['senin'] = '11 April 2022';
    $gl[3]['selasa'] = '12 April 2022';
    $gl[3]['rabu'] = '13 April 2022';
    $gl[3]['kamis'] = '14 April 2022';
    $gl[3]['jumat'] = '15 April 2022';
    $gl[3]['sabtu'] = '16 April 2022';
    $gl[3]['minggu'] = '17 April 2022';


    $data = FitDailyTemp::get();
    if (empty($data)) {
      dd('KOSONG WOI');
    }

    DB::beginTransaction();
    try {

        //tanggal mohon diganti per week
        // posisi week 1
        // untuk selain suto ini
      foreach($data as $d)
      {
        $check = ActiveStudent::whereRaw("UPPER(name) LIKE '%". strtoupper($d->nama)."%'")->first();
        // var_dump($check);
        //dd($check);
        if (!empty($check) && $check != null && !empty($d->nama)) {
          if(!empty($d->senin)){
            $data = new FitDaily();
            $data['user_id'] = $check->id;
            $data['nama'] = $d->nama;
            $data['kelas'] = $check->kelas;
            $data['lokasi'] = $check->lokasi;

            $data['is_done'] = 1;
            $data['fit_time_id'] = 1;
            $data['tgl_input'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['senin']));
            $data['tgl'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['senin']));

            $fit_test = FitTest::where('nik', '=', $check->nik)->get();


            $video = DB::connection('mysql')->select("select * from fit_video
            where deleted_at is null and
            (? between start_date and end_date)
            and fit_time_id = ?
            ",array(date('Y-m-d',strtotime($gl[intval($d->week)-1]['senin'])),1));

            if(!empty($fit_test)){
                $fit_test_tmp = $fit_test[count($fit_test)-1];
                $data['fit_test_id'] = $fit_test_tmp->id;
                $data['fit_video_id']= (!empty($video[0]->id)) ? $video[0]->id : null;
                $data->save();
            }

          }

          if(!empty($d->selasa)){
            $data = new FitDaily();
            $data['user_id'] = $check->id;
            $data['nama'] = $d->nama;
            $data['kelas'] = $check->kelas;
            $data['lokasi'] = $check->lokasi;

            $data['is_done'] = 1;
            $data['fit_time_id'] = 1;
            $data['tgl_input'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['selasa']));
            $data['tgl'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['selasa']));

            $fit_test = FitTest::where('nik', '=', $check->nik)->get();


            $video = DB::connection('mysql')->select("select * from fit_video
            where deleted_at is null and
            (? between start_date and end_date)
            and fit_time_id = ?
            ",array(date('Y-m-d',strtotime($gl[intval($d->week)-1]['selasa'])),1));

            if(!empty($fit_test)){
                $fit_test_tmp = $fit_test[count($fit_test)-1];
                $data['fit_test_id'] = $fit_test_tmp->id;
                $data['fit_video_id']= (!empty($video[0]->id)) ? $video[0]->id : null;
                $data->save();
            }
          }

          if(!empty($d->rabu)){
            $data = new FitDaily();
            $data['user_id'] = $check->id;
            $data['nama'] = $d->nama;
            $data['kelas'] = $check->kelas;
            $data['lokasi'] = $check->lokasi;

            $data['is_done'] = 1;
            $data['fit_time_id'] = 1;
            $data['tgl_input'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['rabu']));
            $data['tgl'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['rabu']));

            $fit_test = FitTest::where('nik', '=', $check->nik)->get();


            $video = DB::connection('mysql')->select("select * from fit_video
            where deleted_at is null and
            (? between start_date and end_date)
            and fit_time_id = ?
            ",array(date('Y-m-d',strtotime($gl[intval($d->week)-1]['rabu'])),1));

            if(!empty($fit_test)){
                $fit_test_tmp = $fit_test[count($fit_test)-1];
                $data['fit_test_id'] = $fit_test_tmp->id;
                $data['fit_video_id']= (!empty($video[0]->id)) ? $video[0]->id : null;
                $data->save();
            }
          }

          if(!empty($d->kamis)){
            $data = new FitDaily();
            $data['user_id'] = $check->id;
            $data['nama'] = $d->nama;
            $data['kelas'] = $check->kelas;
            $data['lokasi'] = $check->lokasi;

            $data['is_done'] = 1;
            $data['fit_time_id'] = 1;
            $data['tgl_input'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['kamis']));
            $data['tgl'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['kamis']));

            $fit_test = FitTest::where('nik', '=', $check->nik)->get();


            $video = DB::connection('mysql')->select("select * from fit_video
            where deleted_at is null and
            (? between start_date and end_date)
            and fit_time_id = ?
            ",array(date('Y-m-d',strtotime($gl[intval($d->week)-1]['kamis'])),1));

            if(!empty($fit_test)){
                $fit_test_tmp = $fit_test[count($fit_test)-1];
                $data['fit_test_id'] = $fit_test_tmp->id;
                $data['fit_video_id']= (!empty($video[0]->id)) ? $video[0]->id : null;
                $data->save();
            }
          }

          if(!empty($d->jumat)){
            $data = new FitDaily();
            $data['user_id'] = $check->id;
            $data['nama'] = $d->nama;
            $data['kelas'] = $check->kelas;
            $data['lokasi'] = $check->lokasi;

            $data['is_done'] = 1;
            $data['fit_time_id'] = 1;
            $data['tgl_input'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['jumat']));
            $data['tgl'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['jumat']));

            $fit_test = FitTest::where('nik', '=', $check->nik)->get();


            $video = DB::connection('mysql')->select("select * from fit_video
            where deleted_at is null and
            (? between start_date and end_date)
            and fit_time_id = ?
            ",array(date('Y-m-d',strtotime($gl[intval($d->week)-1]['jumat'])),1));

            if(!empty($fit_test)){
                $fit_test_tmp = $fit_test[count($fit_test)-1];
                $data['fit_test_id'] = $fit_test_tmp->id;
                $data['fit_video_id']= (!empty($video[0]->id)) ? $video[0]->id : null;
                $data->save();
            }
          }

          if(!empty($d->sabtu)){
            $data = new FitDaily();
            $data['user_id'] = $check->id;
            $data['nama'] = $d->nama;
            $data['kelas'] = $check->kelas;
            $data['lokasi'] = $check->lokasi;

            $data['is_done'] = 1;
            $data['fit_time_id'] = 1;
            $data['tgl_input'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['sabtu']));
            $data['tgl'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['sabtu']));

            $fit_test = FitTest::where('nik', '=', $check->nik)->get();


            $video = DB::connection('mysql')->select("select * from fit_video
            where deleted_at is null and
            (? between start_date and end_date)
            and fit_time_id = ?
            ",array(date('Y-m-d',strtotime($gl[intval($d->week)-1]['sabtu'])),1));

            if(!empty($fit_test)){
                $fit_test_tmp = $fit_test[count($fit_test)-1];
                $data['fit_test_id'] = $fit_test_tmp->id;
                $data['fit_video_id']= (!empty($video[0]->id)) ? $video[0]->id : null;
                $data->save();
            }
          }

          if(!empty($d->minggu)){
            $data = new FitDaily();
            $data['user_id'] = $check->id;
            $data['nama'] = $d->nama;
            $data['kelas'] = $check->kelas;
            $data['lokasi'] = $check->lokasi;

            $data['is_done'] = 1;
            $data['fit_time_id'] = 1;
            $data['tgl_input'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['minggu']));
            $data['tgl'] = date('Y-m-d',strtotime($gl[intval($d->week)-1]['minggu']));

            $fit_test = FitTest::where('nik', '=', $check->nik)->get();


            $video = DB::connection('mysql')->select("select * from fit_video
            where deleted_at is null and
            (? between start_date and end_date)
            and fit_time_id = ?
            ",array(date('Y-m-d',strtotime($gl[intval($d->week)-1]['minggu'])),1));

            if(!empty($fit_test)){
                $fit_test_tmp = $fit_test[count($fit_test)-1];
                $data['fit_test_id'] = $fit_test_tmp->id;
                $data['fit_video_id']= (!empty($video[0]->id)) ? $video[0]->id : null;
                $data->save();
            }
          }

          $d->delete();
        }
      }

      DB::commit();
      echo "DONE";

    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }



  }
}
