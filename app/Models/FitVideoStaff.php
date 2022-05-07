<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FitVideoStaff extends Model
{
  use SoftDeletes;

  protected $connection = 'mysql2';
  public $table = 'fit_video';
}
