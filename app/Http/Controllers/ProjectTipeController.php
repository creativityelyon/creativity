<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTipe;
use Illuminate\Support\Facades\DB;

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
          $d->description = $input['description'];
          $d->class_range = json_encode($input['range_class']);
          $d->teacher_id = $input['teacher'];
          $d->created_by = auth()->user()->id;
          $d->save();
      
          return redirect('/project_tipe')->with('success','Berhasil Menambahkan Data');
    }

    public function edit($id)
    {
        $id_teacher = null;
        $nama_teacher = null;
        $d = ProjectTipe::find($id);
        if (empty($d)) {
            return redirect('/project_tipe')->with('error','Data tidak ditemukan');
        }
        $data_teacher = DB::connection('mysql2')->table('users')->where('id', $d->teacher_id)->first();
        if($data_teacher){
            $nama_teacher = $data_teacher->nama_lengkap;
            $id_teacher = $data_teacher->id;
        }
        return view('project_tipe.edit')->with('d',$d)->with('id_teacher', $id_teacher)->with('nama_teacher', $nama_teacher);
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
            $d->description = $input['description'];
            $d->class_range = json_encode($input['range_class']);
            $d->teacher_id = $input['teacher'];
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
            return redirect('project_tipe')->with('success','Berhasil Menghapus Data');
        } catch (\Exception $e) {
          DB::rollback();
            return $e;
        }


    }

    public function getTeacherId(Request $request){
        $nama = $request->q;
        $data_teacher = DB::connection('mysql2')->table('users')->where('nama_lengkap', 'LIKE', '%'. $nama. '%')->get();
        foreach($data_teacher as $d){
            $tmp = [
                "value" => $d->id,
                "text" => $d->nama_lengkap
            ];
            $data[] = $tmp;
        }
        return $data;
    }
}
