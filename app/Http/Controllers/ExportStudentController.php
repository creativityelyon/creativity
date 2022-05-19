<?php

namespace App\Http\Controllers;

use App\Imports\FitImportCreativity;
use App\Models\ActiveStudent;
use App\Models\TempImportStudentCreativity;
use Illuminate\Http\Request;
use Auth;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Exception;


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
      Excel::import(new FitImportCreativity, request()->file('attendance_file'));

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

  public function runSync(){
      $data = TempImportStudentCreativity::get();
      if(empty($data)){
        dd('data Not Found');
      }

      DB::beginTransaction();
        try {
    
    
          foreach($data as $d)
          {
            $check = ActiveStudent::where('nik','=',$d->nik)->first();
            // var_dump($check);
            // dd($check);
            if (!empty($check) && $check != null && !empty($d->nik)) {

              $data_siswa = ActiveStudent::find($check->id)->update(['project_course_id'=> $d->creativity_student]);
              echo $data_siswa."<br>";
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
