<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Latihan extends Model
{
  use SoftDeletes;
  protected $connection = 'mysql';
  public $table = 'latihan';

  public function jadwal()
  {
    return $this->hasMany('App\Models\JadwalLatihan','latihan_id','id');
  }
}
