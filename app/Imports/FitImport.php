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

class FitImport implements ToModel, WithHeadingRow
{

  public function model(array $row)
  {
    // dd($row);
    return new FitTestTemp([
      'nik' => $row['nik'],
      'nama' => $row['nama'],
      'jenis_kelamin' => $row['l_p'],
      'usia' => $row['usia'],
      'tinggi_badan' => $row['height_m'],
      'berat_badan' => $row['weight_kg'],
      'test_1' => $row['data_1'],
      'nilai_test_1' => $row['nilai_1'],
      'test_2' => $row['data_2'],
      'nilai_test_2' => $row['nilai_2'],
      'nilai_test_3' => $row['nilai_3'],
      'test_3_1' => $row['data_3'],
    //  'test_3_2' => $row['data_3'],
     // 'test_3_3' => $row['data_3'],
      'nilai_test_4' => $row['nilai_4'],
      'test_4_1' => $row['data_4'],
      //'test_4_2' => $row['data_5'],
      //'nilai_test_4_2' => $row['nilai_5'],
      'total_point' => $row['total_score'],
      'hasil' => $row['clasification'],
      'bmi' => $row['bmi'],
      'category' => $row['category'],
    ]);

  }


  public function headingRow(): int
  {
    return 1;
  }
}
