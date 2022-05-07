<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pernyataan extends Model
{
  protected $connection = 'mysql';
  public $table = 'pernyataan';

  public function student()
  {
    return $this->belongsTo('App\Models\ActiveStudent','user_id','id');
  }


}
