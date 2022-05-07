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

class FitDailyImport implements ToModel, WithHeadingRow
{

  public function model(array $row)
  {
    // dd($row);
    return new FitDailyTemp([
      'nik' => $row['nik'],
      'nama' => $row['nama'],
      'senin' => $row['senin'],
      'selasa' => $row['selasa'],
      'rabu' => $row['rabu'],
      'kamis' => $row['kamis'],
      'jumat' => $row['jumat'],
      'sabtu' => $row['sabtu'],
      'minggu' => $row['minggu'],
      'week' => $row['week']
    ]);

  }


  public function headingRow(): int
  {
    return 1;
  }
}
