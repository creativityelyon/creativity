<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FitVideoStaff;
use App\Models\Custom;
use DB;
use App\Models\FitTimeStaff;

class FitVideoStaffController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $data = FitVideoStaff::get();
    return view('fit_video_staff.index')->with('data',$data);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $time = FitTimeStaff::get();
    return view('fit_video_staff.create')->with('time',$time);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $r)
  {
    $r->validate([
      'start_date' => 'required|date_format:d-m-Y',
      'end_date' => 'required|date_format:d-m-Y|after:start_date',
    ]);

    $input = $r->all();


    DB::beginTransaction();
    try {
      $d = new FitVideoStaff();
      $d->fit_time_id = $input['fit_time_id'];
      $d->link = $input['link'];
      $d->start_date = date('Y-m-d',strtotime($input['start_date']));
      $d->end_date = date('Y-m-d',strtotime($input['end_date']));
      $d->created_by = auth()->user()->id;
      $d->save();

      DB::commit();

      return redirect('fit_video/staff')->with('success','Berhasil Menambahkan Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }

  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $d = FitVideoStaff::find($id);
    if (empty($d)) {
      return redirect()->back()->with('error','Data not found');
    }
    $time = FitTimeStaff::get();
    return view('fit_video_staff.edit')->with('d',$d)->with('time',$time);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $r)
  {
    $r->validate([
      'start_date' => 'required|date_format:d-m-Y',
      'end_date' => 'required|date_format:d-m-Y|after:start_date',
    ]);

    $input = $r->all();

    DB::beginTransaction();
    try {
      $d = FitVideoStaff::find($input['id']);
      $d->fit_time_id = $input['fit_time_id'];
      $d->link = $input['link'];
      $d->start_date = date('Y-m-d',strtotime($input['start_date']));
      $d->end_date = date('Y-m-d',strtotime($input['end_date']));
      $d->updated_by = auth()->user()->id;
      $d->save();
      DB::commit();

      return redirect('fit_video/staff')->with('success','Berhasil Edit Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }

  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $d = FitVideoStaff::find($id);
    if (empty($d)) {
      return redirect()->back()->with('error','Data not found');
    }

    DB::beginTransaction();
    try {
      $d->deleted_at = date('Y-m-d h:i:s');
      $d->deleted_by = auth()->user()->id;
      $d->save();
      DB::commit();
      return redirect('fit_video/staff')->with('success','Berhasil Menghapus Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }
  }
}
