<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeSurvey;
use DB;
use Auth;

class SurveyPeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PeriodeSurvey::get();
        return view('periode_survey.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('periode_survey.create');
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

      $check = DB::connection('mysql')->select("select * from periode_survey
      where(? between start_date and end_date) and deleted_at is null",
      array(date('Y-m-d',strtotime($input['start_date']))));

      // dd($check);
      if (!empty($check)) {
        return redirect()->back()->with('error','Tanggal sudah ada');
      }

      DB::beginTransaction();
      try {

        $d = new PeriodeSurvey();
        $d->start_date = date('Y-m-d',strtotime($input['start_date']));
        $d->end_date = date('Y-m-d',strtotime($input['end_date']));
        $d->keterangan= $input['keterangan'];
        $d->is_pgkg = $input['is_kg'];
        $d->is_primary = $input['is_primary'];
        $d->is_secondary = $input['is_secondary'];
        $d->is_hs = $input['is_highschool'];
        $d->created_by = auth()->user()->id;
        $d->save();

        DB::commit();

        return redirect('/periode/survey')->with('success','Berhasil Menambahkan Data');
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
      $d = PeriodeSurvey::find($id);
      if (empty($d)) {
        return redirect('/periode/survey')->with('error','Data tidak ditemukan');
      }
      return view('periode_survey.edit')->with('d',$d);
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
      $check = DB::connection('mysql')->select("select * from periode_survey where
      (? between start_date and end_date) and deleted_at is null
      and id not in (?)",array(date('Y-m-d',strtotime($input['start_date'])),$input['id']));
      if (!empty($check)) {
        return redirect()->back()->with('error','Tanggal sudah ada');
      }
      DB::beginTransaction();
      try {
        $d = PeriodeSurvey::find($input['id']);
        $d->start_date = date('Y-m-d',strtotime($input['start_date']));
        $d->end_date = date('Y-m-d',strtotime($input['end_date']));
        $d->keterangan= $input['keterangan'];
        $d->is_pgkg = $input['is_kg'];
        $d->is_primary = $input['is_primary'];
        $d->is_secondary = $input['is_secondary'];
        $d->is_hs = $input['is_highschool'];
        $d->updated_by = auth()->user()->id;
        $d->save();

        DB::commit();
        return redirect('periode/survey')->with('success','Berhasil Mengubah Data');
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
      $d = PeriodeSurvey::find($id);
      if (empty($d)) {
        return redirect('/periode/survey')->with('error','Data tidak ditemukan');
      }elseif (!empty($d->survey)) {
        return redirect('/periode/survey')->with('error','Data Tersambung Dengan Jadwal Latihan');
      }

      DB::beginTransaction();
      try {
        $d->deleted_at = date('Y-m-d H:i:s');
        $d->deleted_by = auth()->user()->id;
        $d->save();
        DB::commit();
        return redirect('periode/survey')->with('success','Berhasil Menghapus Data');
      } catch (\Exception $e) {
        DB::rollback();
        return $e;
      }

    }
}
