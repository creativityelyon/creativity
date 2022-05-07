<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FitVideo;
use App\Models\Custom;
use DB;
use App\Models\FitTime;


class VideoWorkoutController extends Controller
{
  public function index()
  {
    $data = FitVideo::get();
    return view('fit_video.index')->with('data',$data);
  }

  public function create()
  {
    $time = FitTime::get();
    return view('fit_video.create')->with('time',$time);
  }

  public function store(Request $r)
  {

    $r->validate([
      'start_date' => 'required|date_format:d-m-Y',
      'end_date' => 'required|date_format:d-m-Y|after:start_date',
    ]);

    $input = $r->all();


    DB::beginTransaction();
    try {
      $d = new FitVideo();
      $d->fit_time_id = $input['fit_time_id'];
      $d->link = $input['link'];
      $d->start_date = date('Y-m-d',strtotime($input['start_date']));
      $d->end_date = date('Y-m-d',strtotime($input['end_date']));
      $d->is_tk = $input['is_tk'];
      $d->is_sd = $input['is_sd'];
      $d->is_smp = $input['is_smp'];
      $d->is_sma = $input['is_sma'];
      $d->created_by = auth()->user()->id;
      $d->save();

      DB::commit();

      return redirect('fit_video')->with('success','Berhasil Menambahkan Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }

  }

  public function edit($id)
  {
    $d = FitVideo::find($id);
    if (empty($d)) {
      return redirect()->back()->with('error','Data not found');
    }
    $time = FitTime::get();
    return view('fit_video.edit')->with('d',$d)->with('time',$time);
  }

  public function update(Request $r)
  {
    $r->validate([
      'start_date' => 'required|date_format:d-m-Y',
      'end_date' => 'required|date_format:d-m-Y|after:start_date',
    ]);

    $input = $r->all();

    DB::beginTransaction();
    try {
      $d = FitVideo::find($input['id']);
      $d->fit_time_id = $input['fit_time_id'];
      $d->link = $input['link'];
      $d->start_date = date('Y-m-d',strtotime($input['start_date']));
      $d->end_date = date('Y-m-d',strtotime($input['end_date']));
      $d->is_tk = $input['is_tk'];
      $d->is_sd = $input['is_sd'];
      $d->is_smp = $input['is_smp'];
      $d->is_sma = $input['is_sma'];
      $d->updated_by = auth()->user()->id;
      $d->save();
      DB::commit();

      return redirect('fit_video')->with('success','Berhasil Edit Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }


  }

  public function delete($id)
  {
    $d = FitVideo::find($id);
    if (empty($d)) {
      return redirect()->back()->with('error','Data not found');
    }

    DB::beginTransaction();
    try {
      $d->deleted_at = date('Y-m-d h:i:s');
      $d->deleted_by = auth()->user()->id;
      $d->save();
      DB::commit();
      return redirect('fit_video')->with('success','Berhasil Menghapus Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }

  }
}
