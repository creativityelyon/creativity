<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
  use Notifiable;

  use SoftDeletes;
  protected $connection = 'mysql';
  public $table = 'active_student';
  protected $guard = 'web';
  protected $dates = ['deleted_at'];
  protected $softDelete = true;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
  * The attributes that should be cast to native types.
  *
  * @var array
  */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];


  public function kelas()
  {
    return $this->belongsTo('App\Models\Syskelas','id_kelas','kode_kelas');
  }

  public function level()
  {
    return $this->belongsTo('App\Models\Syslevel','id_level','id');
  }
}
