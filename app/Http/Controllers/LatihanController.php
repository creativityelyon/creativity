<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Latihan;
class LatihanController extends Controller
{
    public function index()
    {
      $data = Latihan::get();
      return view('latihan.index')->with('data',$data);
    }

    public function create()
    {
      return view('latihan.create');
    }

    public function store(Request $r)
    {
      $input = $r->all();

      DB::beginTransaction();
      try {

        $d = new Latihan();
        $d->jenis_latihan = $input['jenis_latihan'];
        $d->keterangan = $input['keterangan'];
        $d->created_by = auth()->user()->id;
        $d->save();

        DB::commit();
        return redirect('latihan')->with('success','Berhasil Membuat Data Master Latihan');

      } catch (\Exception $e) {
        DB::rollback();
        return $e;
      }



    }

    public function edit($id)
    {
      $d = Latihan::Find($id);
      if (empty($d)) {
        return redirect('/latihan')->with('error','Data not found !');
      }
      return view('latihan.edit')->with('d',$d);
    }

    public function update(Request $r)
    {
      $input = $r->all();

      DB::beginTransaction();
      try {

        $d = Latihan::Find($input['id']);
        $d->jenis_latihan = $input['jenis_latihan'];
        $d->keterangan = $input['keterangan'];
        $d->updated_by = auth()->user()->id;
        $d->save();

        DB::commit();
        return redirect('latihan')->with('success','Berhasil Membuat Data Master Latihan');

      } catch (\Exception $e) {
        DB::rollback();
        return $e;
      }
    }

    public function delete($id)
    {
        $d = Latihan::Find($id);
        if (empty($d)) {
          return redirect('/latihan')->with('error','Data not found !');
        }elseif (!empty($d->jadwal)) {
          return redirect('/latihan')->with('error','Gagal dihapus karena data sudah tersambung dengan dokumen lainnya !');
        }

        DB::beginTransaction();
        try {
          $d->deleted_at = date('Y-m-d H:i:s');
          $d->deleted_by = auth()->user()->id;
          $d->save();
          DB::commit();
          return redirect('latihan')->with('success','Berhasil Menghapus Data Latihan');
        } catch (\Exception $e) {
          DB::rollback();
          return $e;
        }

    }
}
