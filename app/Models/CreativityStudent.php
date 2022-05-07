<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreativityStudent extends Model
{
  use SoftDeletes;
  protected $connection = 'mysql';
  public $table = 'creativity_student';
}
