<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
  use SoftDeletes;

  protected $connection = 'mysql';
  public $table = 'role';
  protected $primaryKey   = 'id';
  public $incrementing    = true;
  public $timestamps      = true;

  protected $guarded = ['id'];

   
}
