<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreativityTeacher extends Model
{
  use SoftDeletes;
  protected $connection = 'mysql2';
  public $table = 'creativity_teacher';
}
