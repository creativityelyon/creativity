<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custom;
use App\Models\FitTime;
use DB;
use Auth;

class FitTimeController extends Controller
{
    public function index()
    {
      $data = FitTime::get();
      return view('fit_time.index')->with('data',$data);
    }

    public function create()
    {
      return view('fit_time.create');
    }

    public function store(Request $r)
    {
      $r->validate([
        'start_date' => 'required|date_format:d-m-Y',
        'end_date' => 'required|date_format:d-m-Y|after:start_date'
      ]);

      $input = $r->all();

      $check = DB::connection('mysql')->select("select * from fit_time where
      (? between start_date and end_date) and deleted_at is null",array(date('Y-m-d',strtotime($input['start_date']))));
      if (!empty($check)) {
        return redirect()->back()->with('error','Tanggal sudah ada');
      }
      $d = new FitTime();
      $d->start_date = date('Y-m-d',strtotime($input['start_date']));
      $d->end_date = date('Y-m-d',strtotime($input['end_date']));
      $d->keterangan= $input['keterangan'];
      $d->is_kg = $input['is_kg'];
      $d->is_primary = $input['is_primary'];
      $d->is_secondary = $input['is_secondary'];
      $d->is_highschool = $input['is_highschool'];
      $d->created_by = auth()->user()->id;
      $d->save();

      return redirect('/fit_time')->with('success','Berhasil Menambahkan Data');
    }

    public function edit($id)
    {
      $d = FitTime::find($id);
      if (empty($d)) {
        return redirect('/fit_time')->with('error','Data tidak ditemukan');
      }
      return view('fit_time.edit')->with('d',$d);
    }

    public function update(Request $r)
    {
      $r->validate([
        'start_date' => 'required|date_format:d-m-Y',
        'end_date' => 'required|date_format:d-m-Y|after:start_date'
      ]);

      $input = $r->all();
      $check = DB::connection('mysql')->select("select * from fit_time where
      (? between start_date and end_date) and deleted_at is null
      and id not in (?)",array(date('Y-m-d',strtotime($input['start_date'])),$input['id']));
      if (!empty($check)) {
        return redirect()->back()->with('error','Tanggal sudah ada');
      }
      DB::beginTransaction();
      try {
        $d = FitTime::find($input['id']);
        $d->start_date = date('Y-m-d',strtotime($input['start_date']));
        $d->end_date = date('Y-m-d',strtotime($input['end_date']));
        $d->keterangan= $input['keterangan'];
        $d->is_kg = $input['is_kg'];
        $d->is_primary = $input['is_primary'];
        $d->is_secondary = $input['is_secondary'];
        $d->is_highschool = $input['is_highschool'];
        $d->updated_by = auth()->user()->id;
        $d->save();

        DB::commit();
        return redirect('/fit_time')->with('success','Berhasil Mengubah Data');
      } catch (\Exception $e) {
        DB::rollback();
        return $e;
      }

    }

    public function delete($id)
    {
      $d = FitTime::find($id);
      if (empty($d)) {
        return redirect('/fit_time')->with('error','Data tidak ditemukan');
      }elseif (!empty($d->jadwallatihan)) {
        return redirect('/fit_time')->with('error','Data Tersambung Dengan Jadwal Latihan');
      }elseif (!empty($d->daily)) {
        return redirect('/fit_time')->with('error','Data Tersambung Dengan Latihan Harian');
      }

      DB::beginTransaction();
      try {
        $d->deleted_at = date('Y-m-d H:i:s');
        $d->deleted_by = auth()->user()->id;
        $d->save();
        DB::commit();
        return redirect('fit_time')->with('success','Berhasil Menghapus Data');
      } catch (\Exception $e) {
        DB::rollback();
        return $e;
      }

    }
}
