<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FitDailyD extends Model
{
    use SoftDeletes;
  protected $connection = 'mysql';
  public $table = 'fit_daily_d';
}
