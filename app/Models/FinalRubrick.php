<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinalRubrick extends Model
{
  use SoftDeletes;
  protected $connection = 'mysql';
  public $table = 'final_rubrick';

}
