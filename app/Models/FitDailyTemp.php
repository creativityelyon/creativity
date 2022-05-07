<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FitDailyTemp extends Model
{
  protected $connection = 'mysql';
  public $table = 'fit_daily_temp';
  public $timestamps = false;

  protected $fillable = [
    'nik',
    'nama',
    'senin',
    'selasa',
    'rabu',
    'kamis',
    'jumat',
    'sabtu',
    'minggu',
    'week'
   ];


  }
