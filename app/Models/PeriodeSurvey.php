<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PeriodeSurvey extends Model
{
  use SoftDeletes;

  protected $connection = 'mysql';
  public $table = 'periode_survey';


    
}
