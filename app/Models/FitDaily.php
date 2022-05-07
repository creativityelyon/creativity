<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FitDaily extends Model
{
  use SoftDeletes;
  protected $connection = 'mysql';
  public $table = 'fit_daily';


  public function time()
  {
    return $this->belongsTo('App\Models\FitTime','fit_id','id');
  }

}
