<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalLatihan extends Model
{
    use SoftDeletes;
  protected $connection = 'mysql';
  public $table = 'jadwal_latihan';

  public function latihan()
  {
    return $this->belongsTo('App\Models\Latihan','latihan_id','id');
  }

  public function time()
  {
    return $this->belongsTo('App\Models\FitTime','fit_time_id','id');
  }

}
