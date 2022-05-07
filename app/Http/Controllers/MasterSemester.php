<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use DB;
use Auth;

class MasterSemester extends Controller
{
    //
    public function index(){
        $data = Semester::get();
        return view('semester.index')->with('data',$data);
    }

    public function create(){
        return view('semester.create');
    }

    public function store(Request $r){
        $r->validate([
            'start_date' => 'required|date_format:d-m-Y',
            'end_date' => 'required|date_format:d-m-Y|after:start_date'
          ]);

          $input = $r->all();

          $check = DB::connection('mysql')->select("select * from semester where
          (? between start_date and end_date) and deleted_at is null",array(date('Y-m-d',strtotime($input['start_date']))));
          if (!empty($check)) {
            return redirect()->back()->with('error','Tanggal sudah ada');
          }
          $d = new Semester();
          $d->start_date = date('Y-m-d',strtotime($input['start_date']));
          $d->end_date = date('Y-m-d',strtotime($input['end_date']));
          $d->keterangan= $input['keterangan'];
          $d->created_by = auth()->user()->id;
          $d->save();
      
          return redirect('/semester')->with('success','Berhasil Menambahkan Data');
    }

    public function edit($id)
    {
      $d = Semester::find($id);
      if (empty($d)) {
        return redirect('/semester')->with('error','Data tidak ditemukan');
      }
      return view('semester.edit')->with('d',$d);
    }

    public function update(Request $r)
    {
        $r->validate([
        'start_date' => 'required|date_format:d-m-Y',
        'end_date' => 'required|date_format:d-m-Y|after:start_date'
        ]);

        $input = $r->all();
        $check = DB::connection('mysql')->select("select * from semester where
        (? between start_date and end_date) and deleted_at is null
        and id not in (?)",array(date('Y-m-d',strtotime($input['start_date'])),$input['id']));
        if (!empty($check)) {
            return redirect()->back()->with('error','Tanggal sudah ada');
        }
        DB::beginTransaction();
        try {
            $d = Semester::find($input['id']);
            $d->start_date = date('Y-m-d',strtotime($input['start_date']));
            $d->end_date = date('Y-m-d',strtotime($input['end_date']));
            $d->keterangan= $input['keterangan'];
            $d->updated_by = auth()->user()->id;
            $d->save();

            DB::commit();
            return redirect('/semester')->with('success','Berhasil Mengubah Data');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }


    public function destroy($id)
    {
        $d = Semester::find($id);
        // dd($d->daily);
        if (empty($d)) {
            return redirect('/semester')->with('error','Data tidak ditemukan');
        }
        
        // if (!empty($d->daily)) {
        //     return redirect('/semester')->with('error','Data Tersambung Dengan Latihan Harian');
        // }

        DB::beginTransaction();
        try {
            $d->deleted_at = date('Y-m-d H:i:s');
            $d->deleted_by = auth()->user()->id;
            $d->save();
            DB::commit();
            return redirect('semester')->with('success','Berhasil Menghapus Data');
        } catch (\Exception $e) {
          DB::rollback();
            return $e;
        }


    }
  
}
