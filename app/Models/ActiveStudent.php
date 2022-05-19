<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActiveStudent extends Model
{
    use SoftDeletes;
  protected $connection = 'mysql';
  public $table = 'active_student';

  public function student()
  {
    return $this->hasMany('App\Models\Pernyataan','user_id','id');
  }

  protected $fillable = ['project_course_id'];
}
