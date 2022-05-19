<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempImportStudentCreativity extends Model
{
  protected $connection = 'mysql';
  public $table = 'temp_student_creativity';
  public $timestamps = false;

  protected $fillable = [
    'email',
    'nik',
    'nama',
    'creativity_student'
   ];


  }
