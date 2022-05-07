<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custom;
use App\Models\FitTimeStaff;
use DB;
use Auth;

class FitTimeStaffController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $data = FitTimeStaff::get();
    return view('fit_time_staff.index')->with('data',$data);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('fit_time_staff.create');
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
      'end_date' => 'required|date_format:d-m-Y|after:start_date'
    ]);

    $input = $r->all();

    $check = DB::connection('mysql2')->select("select * from fit_time where
    (? between start_date and end_date) and deleted_at is null",array(date('Y-m-d',strtotime($input['start_date']))));
    if (!empty($check)) {
      return redirect()->back()->with('error','Tanggal sudah ada');
    }
    $d = new FitTimeStaff();
    $d->start_date = date('Y-m-d',strtotime($input['start_date']));
    $d->end_date = date('Y-m-d',strtotime($input['end_date']));
    $d->keterangan= $input['keterangan'];
    $d->created_by = auth()->user()->id;
    $d->save();

    return redirect('/fit_time/staff')->with('success','Berhasil Menambahkan Data');

  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $d = FitTimeStaff::find($id);
    if (empty($d)) {
      return redirect('/fit_time')->with('error','Data tidak ditemukan');
    }
    return view('fit_time_staff.edit')->with('d',$d);
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
      'end_date' => 'required|date_format:d-m-Y|after:start_date'
    ]);

    $input = $r->all();
    $check = DB::connection('mysql2')->select("select * from fit_time where
    (? between start_date and end_date) and deleted_at is null
    and id not in (?)",array(date('Y-m-d',strtotime($input['start_date'])),$input['id']));
    if (!empty($check)) {
      return redirect()->back()->with('error','Tanggal sudah ada');
    }
    DB::beginTransaction();
    try {
      $d = FitTimeStaff::find($input['id']);
      $d->start_date = date('Y-m-d',strtotime($input['start_date']));
      $d->end_date = date('Y-m-d',strtotime($input['end_date']));
      $d->keterangan= $input['keterangan'];
      $d->updated_by = auth()->user()->id;
      $d->save();

      DB::commit();
      return redirect('/fit_time/staff')->with('success','Berhasil Mengubah Data');
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
    $d = FitTimeStaff::find($id);
    // dd($d->daily);
    if (empty($d)) {
      return redirect('/fit_time/staff')->with('error','Data tidak ditemukan');
    }
    
    if (!empty($d->daily)) {
      return redirect('/fit_time/staff')->with('error','Data Tersambung Dengan Latihan Harian');
    }

    DB::beginTransaction();
    try {
      $d->deleted_at = date('Y-m-d H:i:s');
      $d->deleted_by = auth()->user()->id;
      $d->save();
      DB::commit();
      return redirect('fit_time/staff')->with('success','Berhasil Menghapus Data');
    } catch (\Exception $e) {
      DB::rollback();
      return $e;
    }


  }
}
