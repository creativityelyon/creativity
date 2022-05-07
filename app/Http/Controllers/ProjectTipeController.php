<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTipe;

class ProjectTipeController extends Controller
{
    //
    public function index(){
        $data = ProjectTipe::get();
        return view('project_tipe.index')->with('data',$data);
    }

    public function create(){
        return view('project_tipe.create');
    }

    public function store(Request $r){
        $r->validate([
            'nama' => 'required'
          ]);

          $input = $r->all();

          $d = new ProjectTipe();
          $d->nama = $input['nama'];
          $d->tipe = $input['tipe'];
          $d->created_by = auth()->user()->id;
          $d->save();
      
          return redirect('/project_tipe')->with('success','Berhasil Menambahkan Data');
    }

    public function edit($id)
    {
      $d = ProjectTipe::find($id);
      if (empty($d)) {
        return redirect('/project_tipe')->with('error','Data tidak ditemukan');
      }
      return view('project_tipe.edit')->with('d',$d);
    }

    public function update(Request $r)
    {
        $r->validate([
            'nama' => 'required'
        ]);

        $input = $r->all();
      
        DB::beginTransaction();
        try {
            $d = ProjectTipe::find($input['id']);
            $d->nama = $input['nama'];
            $d->tipe = $input['tipe'];
            $d->updated_by = auth()->user()->id;
            $d->save();

            DB::commit();
            return redirect('/project_tipe')->with('success','Berhasil Mengubah Data');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }


    public function destroy($id)
    {
        $d = ProjectTipe::find($id);
        // dd($d->daily);
        if (empty($d)) {
            return redirect('/project_tipe')->with('error','Data tidak ditemukan');
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
