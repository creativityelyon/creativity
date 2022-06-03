<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Syskelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterRoleController extends Controller
{
    public function index(){
        $data = Role::distinct()->get(['user_id']);
        return view('role.index')->with('data',$data);
    }

    public function create($id = null){
        $cls_kelas = Syskelas::orderBy('lokasi', 'DESC')->orderBy('grade', 'asc')->where('tahun_ajaran','=','2021 - 2022')->get();
        if($id){
            $old_data = Role::where('user_id', $id)->get();
            return view('role.create')->with('cls_kelas', $cls_kelas)->with('old_data', $old_data);
        }
        return view('role.create')->with('cls_kelas', $cls_kelas);
    }

    public function store(Request $r){
        $input = $r->all();
        $teacher = $input['teacher'];
        $kelas = $input['kelas'];
        if($input['teacher'] == -1){
            for($i=0; $i<count($kelas); $i++){
                Role::create([
                    'user_id' => $teacher,
                    'kelas_id' => $kelas[$i]
                ]);
            }
            return redirect('/role')->with('success','Berhasil Menambahkan Data');
        }else{
            $d = Role::where('user_id', $teacher)->delete();
            for($i=0; $i<count($kelas); $i++){
                Role::create([
                    'user_id' => $teacher,
                    'kelas_id' => $kelas[$i]
                ]);
            }
            return redirect('/role')->with('success','Berhasil Mengubah Data');
        }
    }

    public function destroy($id)
    {
        $d = Role::where('user_id', $id)->delete();
        if (empty($d)) {
            return redirect('/role')->with('error','Data tidak ditemukan');
        }
        return redirect('role')->with('success','Berhasil Menghapus Data');
    }
}
