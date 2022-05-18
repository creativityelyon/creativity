<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportStudentController extends Controller
{
    public function index()
  {
    return view('student_manual.index');
  }

  public function create()
  {

    return view('student_manual.create');
  }

  public function storeFile(Request $r)
  {
    $r->validate([
      // 'location' => 'required',
      'attendance_file' => 'required|file|mimes:xls,xlsx',
      // 'attendance_file' => 'required|file',
    ]);

    // $total_sebelum = FitImport::count();

    DB::beginTransaction();

    try {
      Excel::import(new FitImport, request()->file('attendance_file'));

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

    $data = FitTestTemp::get();
    if (empty($data)) {
      dd('KOSONG WOI');
    }

    DB::beginTransaction();
    try {


      foreach($data as $d)
      {
        $check = ActiveStudent::where('nik','=',$d->nik)->first();
        // var_dump($check);
        // dd($check);
        if (!empty($check) && $check != null && !empty($d->nik)) {
          $birthDate = date('d/m/Y',strtotime($check->tgl_lahir));
          $birthDate = explode("/", $birthDate);
          //get age from date or birthdate
          $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
          ? ((date("Y") - $birthDate[2]) - 1)
          : (date("Y") - $birthDate[2]));
        dd($age);
          $f = new FitTest();
          $f->user_id = $check->id;
          $f->nik = $d->nik;
          $f->kelas = $check->kelas;
          $f->lokasi = $check->lokasi;
          $f->id_kelas = $check->id_kelas;
          $f->homeroom = $check->homeroom;
          $f->id_level = $check->id_level;
          $f->fit_time_id = 1;
          $f->jenis_kelamin = (($d->jenis_kelamin == 'P') ? "Female" : "Male");
          $f->usia = (($d->usia != null) ? $d->usia:$age);
          $f->tinggi_badan = $d->tinggi_badan;
          $f->berat_badan = $d->berat_badan;
          $f->bmi = $d->bmi;
          $f->test_1 = $d->test_1;
          $f->nilai_test_1 = $d->nilai_test_1;
          $f->test_2 = $d->test_2;
          $f->nilai_test_2 = $d->nilai_test_2;
          $f->nilai_test_3 = $d->nilai_test_3;
          $f->test_3_1 = $d->test_3_1;
          $f->test_3_2 = $d->test_3_1;
          $f->test_3_3 = $d->test_3_1;
          $f->nilai_test_4 = $d->nilai_test_4;
          $f->test_4_1 = $d->test_4_1;
          $f->test_4_2 = $d->test_4_2;
          $f->nilai_test_4_2 = $d->nilai_test_4_2;
          $f->total_point = $d->total_point;
          $f->hasil = $d->hasil;
          $f->category = $d->category;
          $f->classification = (($d->hasil == 1) ? "Need Improvement" : ($d->hasil == 2) ?  "Satisfactory" : ($d->hasil == 3) ? "Good" : "Excelent");
          $f->save();
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
