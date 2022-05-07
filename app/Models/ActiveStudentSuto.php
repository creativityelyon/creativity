<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActiveStudentSuto extends Model
{
    use SoftDeletes;
  protected $connection = 'mysql';
  public $table = 'active_student_sutorejo';
}
