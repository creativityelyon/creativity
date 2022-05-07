<?php

namespace App\Http\Controllers;
use App\Models\SurveyStudent;
use Illuminate\Http\Request;
use Auth;
use DB;

class VisitorController extends Controller
{
    public function index()
    {

      return view('visitor');
    }

    public function store(Request $r)
    {
      $input = $r->all();
      // dd($input['q1_keterangan']);


      $data = SurveyStudent::where('ktp','=',$input['ktp'])
      ->whereDate('tgl',date('Y-m-d'))
      ->orderBy('created_at','desc')
      ->first();

      if (empty($data)) {
        DB::beginTransaction();
        try {
          $s = new SurveyStudent();
          $s->tgl = date('Y-m-d H:i:s');
          $s->q1 = $input['q1'];
          $s->q1_keterangan = $input['q1_keterangan'];
          $s->q2 = $input['q2'];
          $s->q3 = $input['q3'];
          $s->q4 = $input['q4'];
          $s->suhu_tubuh = $input['suhu_tubuh'];
          $s->is_student = 0;
          $s->ktp = $input['ktp'];
          $s->nama =$input['nama'];
          $s->hp = $input['hp'];
          $s->save();

          DB::commit();

          if ($input['q1'] == 1 && $input['q2'] == 1 && $input['q3'] == 1 && $input['q4'] == 1) {
            $s->status = 1;
            DB::commit();
            return view('reply')->with('success','You Pass the qualification for today')->with('data',$s);
          }else {
            $s->status = 0;
            DB::commit();
            return view('reply')->with('error','Better take a rest for today')->with('data',$s);
          }
        } catch (\Exception $e) {
          return $e;
          DB::rollback();
        }
      }else {

        return view('reply')->with('data',$data);
      }


    }
}
