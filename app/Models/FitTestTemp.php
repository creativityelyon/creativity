<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FitTestTemp extends Model
{
  protected $connection = 'mysql';
  public $table = 'fit_test_temp';


  public $timestamps = true;

  protected $dates = [
    'waktu',
    'tanggal',
  ];

  protected $fillable = [
    'nik',
    'nama',
    'jenis_kelamin',
    'usia',
    'tinggi_badan',
    'berat_badan',
    'test_1',
    'nilai_test_1',
    'test_2',
    'nilai_test_2',
    'nilai_test_3',
    'test_3_1',
    'test_3_2',
    'test_3_3',
    'nilai_test_4',
    'test_4_1',
    'test_4_2',
    'nilai_test_4_2',
    'total_point',
    'hasil',
    'bmi',
    'category'];


  }
