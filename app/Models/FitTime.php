<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FitTime extends Model
{
  use SoftDeletes;

  protected $connection = 'mysql';
  public $table = 'fit_time';

  public function jadwallatihan()
  {
    return $this->hasMany('App\Models\JadwalLatihan','fit_time_id','id');
  }

  public function daily()
  {
    return $this->hasMany('App\Models\FitDaily','fit_id','id');
  }

}
