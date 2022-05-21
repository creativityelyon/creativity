<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use App\Models\FitTestTemp;
use App\Models\FitTestTempStaff;
use App\Models\FitDailyTemp;
use App\Models\TempImportStudentCreativity;

class FitImportCreativity implements ToModel, WithHeadingRow
{

  public function model(array $row)
  {
    // dd($row);
    return new TempImportStudentCreativity([
      'email' => $row['email'],
      'nik' => $row['nik'],
      'nama' => $row['nama'],
      'creativity_student' => $row['creativity_student'],
      'creativity_student_container' => $row['creativity_student_container']
    ]);

  }


  public function headingRow(): int
  {
    return 1;
  }
}
