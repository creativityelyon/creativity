<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FitTimeStaff extends Model
{
  use SoftDeletes;

  protected $connection = 'mysql2';
  public $table = 'fit_time';

  public function daily()
  {
    return $this->hasMany('App\Models\FitDailyStaff','fit_time_id','id');
  }

}
