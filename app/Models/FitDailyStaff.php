<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FitDailyStaff extends Model
{
  use SoftDeletes;
  protected $connection = 'mysql2';
  public $table = 'fit_daily';


  public function time()
  {
    return $this->belongsTo('App\Models\FitTimeStaff','fit_time_id','id');
  }

}
