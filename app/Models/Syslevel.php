<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Syslevel extends Model
{
  protected $connection = 'mysql';
  public $table = 'syslevel';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';


  public function user()
  {
    return $this->hasMany('App\User','id_level','id');
  }

}
