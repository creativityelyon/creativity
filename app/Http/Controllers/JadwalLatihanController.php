<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalLatihan;
use App\Models\Latihan;
use App\Models\FitTime;
use DB;
use Auth;

class JadwalLatihanController extends Controller
{
  public function index()
  {
    $data = JadwalLatihan::get();
    return view('jadwal.index')->with('data',$data);
  }

  public function create()
  {
    $training = Latihan::get();
    $time = FitTime::get();
    return view('jadwal.create')->with('latihan',$training)->with('time',$time);
  }

  public function store(Request $r)
  {
    $r->validate([
      'start_date' => 'required|date_format:d-m-Y',
      'end_date' => 'required|date_format:d-m-Y|after:start_date'
    ]);

    $input = $r->all();

    $s = new JadwalLatihan();
    $s->latihan_id = $input['latihan_id'];
    $s->fit_time_id =$input['fit_time_id'];
    $s->start_date = date('Y-m-d',strtotime($input['start_date']));
    $s->end_date = date('Y-m-d',strtotime($input['end_date']));
    $s->aktif = $input['aktif'];
    $s->is_tk = $input['is_tk'];
    $s->is_sd = $input['is_sd'];
    $s->is_smp = $input['is_smp'];
    $s->is_sma = $input['is_sma'];
    $s->is_staff = $input['is_staff'];
    $s->created_by = auth()->user()->id;
    $s->save();

    return redirect('/fit_sch')->with('success','Berhasil Menambahkan data');

  }

  public function edit($id)
  {
    $training = Latihan::get();
    $time = FitTime::get();
    $d = JadwalLatihan::find($id);
    if (empty($d)) {
      return redirect('/fit_sch')->with('error','Data not found');
    }

    return view('jadwal.edit')->with('d',$d)->with('latihan',$training)->with('time',$time);
  }


  public function update(Request $r)
  {
    $r->validate([
      'start_date' => 'required|date_format:d-m-Y',
      'end_date' => 'required|date_format:d-m-Y|after:start_date'
    ]);
    $input = $r->all();
    DB::beginTransaction();
    try {
      $d = JadwalLatihan::find($input['id']);
      $d->latihan_id = $input['latihan_id'];
      $d->fit_time_id =$input['fit_time_id'];
      $d->start_date = date('Y-m-d',strtotime($input['start_date']));
      $d->end_date = date('Y-m-d',strtotime($input['end_date']));
      $d->aktif = $input['aktif'];
      $d->is_tk = $input['is_tk'];
      $d->is_sd = $input['is_sd'];
      $d->is_smp = $input['is_smp'];
      $d->is_sma = $input['is_sma'];
      $d->is_staff = $input['is_staff'];
      $d->updated_by = auth()->user()->id;
      $d->save();
      DB::commit();

      return redirect('fit_sch')->with('success','Berhasil Mengubah Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }

  }

  public function delete($id)
  {
    $d = JadwalLatihan::find($id);

    if (empty($d)) {
      return redirect('/fit_sch')->with('error','Data not found');
    }elseif (!empty($d->latihan)) {
      return redirect('/fit_sch')->with('error','Data tersambung dengan latihan yang sudah ada');
    }
    
    DB::beginTransaction();
    try {
      $d->deleted_at = date('Y-m-d H:i:s');
      $d->deleted_by = auth()->user()->id;
      $d->save();
      DB::commit();

      return redirect('/fit_sch')->with('success','Berhasil Menghapus Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }

  }
}
