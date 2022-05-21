@extends('layouts.app')
@section('title')
Creativity
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Creativity</h3>
  </div>
  <input type="hidden" name="zyx" value="{{$kelas}}">
  <input type="hidden" name="temp_data" value= '{{$temp_data}}' id="old_data">
  <input type="hidden" name="temp_data2" value= '{{$temp_data2}}' id="old_data2">
  <div class="section-body">
      <div class="col-sm-12" id="performing_art">
        <div class="card">
          <div class="card-body">
            <div style="width: 100%;">
              <div class="form-group row">
                <div class="col-sm-5"><h4>@if ($tipe->tipe == 1)
                  Performing Art
                @else
                    Container
                @endif</h4></div>
                <div class="col-sm-7 mt-5">
                    <input class="form-check-input" type="checkbox" id="addForm" style="float: left">
                    <label class="form-check-label" for="">
                      Need more form?
                    </label>
                </div>
              </div>
              <div class="aspectRow row">
                <div class="aspectForm">
                  <div id="form1">
                    <div class="form-group row">
                      <div class="col-sm-4">Nama Proyek</div>
                      <div class="col-sm-8">
                          <input type="text" id="namapro1" name="namapro[0]" class="form-control" value="">
                      </div>
                    </div>
                    <div class="form-group row" id="aspect11">
                      <div class="col-sm-8">Idea Generation</div>
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="1">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" id="aspect21">
                      <div class="col-sm-8">Idea Design and Refinement</div>
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="2">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" id="aspect31">
                      <div class="col-sm-8">Openness and Courage to Explore</div>
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="3">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" id="aspect41">
                      <div class="col-sm-8">Work Creatively with others</div>
                      
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="4">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" id="aspect51">
                      <div class="col-sm-8">Creative Production and Innovation</div>
                      
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="5">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" id="aspect61">
                      <div class="col-sm-8">Reflection </div>
                     
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="6">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="aspectForm">
                  <div id="form2">
                    <div class="form-group row">
                      <div class="col-sm-4">Nama Proyek</div>
                      <div class="col-sm-8">
                          <input type="text" id="namapro2" name="namapro[1]" class="form-control" value="">
                      </div>
                    </div>
                    <div class="form-group row" id="aspect12">
                      <div class="col-sm-8">Idea Generation</div>
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="7">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" id="aspect22">
                      <div class="col-sm-8">Idea Design and Refinement</div>
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="8">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" id="aspect32">
                      <div class="col-sm-8">Openness and Courage to Explore</div>
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="9">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" id="aspect42">
                      <div class="col-sm-8">Work Creatively with others</div>
                      
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="10">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" id="aspect52">
                      <div class="col-sm-8">Creative Production and Innovation</div>
                      
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="11">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" id="aspect62">
                      <div class="col-sm-8">Reflection </div>
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="12">
                          <label class="form-check-label" for="gridCheck1">
                            Choose
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <form class="row" action="{{ url('/creativity/store') }}" method="post">
        @csrf
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div style="width: 100%;">
                <div class="table-responsive">
                  <table class="table table-hover table-striped table-bordered table-condensed">
                    <thead>

                      <tr>
                        <th>#</th>
                        <th>Nama Murid</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                      </tr>
                  
                    </thead>
                    <tbody>
                      @foreach($data as $d)
                      <input type="hidden" name="kategori[]" value="{{$kategori}}" id="kategori{{$loop->iteration}}">
                        <input type="hidden" name="user_id[]" value="{{ $d->id}}">
                        <input type="hidden" name="fit_time_id[]" value="{{ $fit_time }}">
                        <input type="hidden" name="nama_lengkap[]" value="{{ $d->name}}">
                        <input type="hidden" name="kelas[]" value="{{ $d->kelas}}">
                        <input type="hidden" name="grade[]" value="{{ $d->grade}}">
                        <input type="hidden" name="lokasi[]" value="{{ $d->lokasi}}">
                        <input type="hidden" name="id_kelas[]" value="{{ $d->id_kelas}}">
                        <input type="hidden" name="id_level[]" value="{{ $d->id_level}}">
                        <input type="hidden" name="gender[]" value="{{ $d->gender}}">
                        <input type="hidden" name="no_induk_siswa_global[]" value="{{ $d->no_induk_siswa_global}}">
                        <?php 
                       

                          $olddata = \DB::connection('mysql')->table('temp_container')->where('id_user', $d->id)->where('fit_time_id', $fit_time)->where('tipe',$tipe->tipe)->get();
                          $arrID = [null,null];
                        

                          $nilai_1= [null, null];
                          $nilai_2 = [null, null];
                          $nilai_3 = [null, null];
                          $nilai_4 = [null, null];
                          $nilai_5 = [null, null];
                          $nilai_6 = [null, null];

                          
                    
                          for($i=0;$i< count($olddata); $i++){
                            $arrID[$i] = $olddata[$i]->id;
                            $nilai_1[$i] = $olddata[$i]->nilai_1;
                            $nilai_2[$i] = $olddata[$i]->nilai_2;
                            $nilai_3[$i] = $olddata[$i]->nilai_3;
                            $nilai_4[$i] = $olddata[$i]->nilai_4;
                            $nilai_5[$i] = $olddata[$i]->nilai_5;
                            $nilai_6[$i] = $olddata[$i]->nilai_6;
                          
                          }
                        
                       
                      ?>
                        <input type="hidden" name="arrold[]" value="<?php echo json_encode($arrID); ?>">
                        <input type="hidden" name="nama_proyek[proyek_1][]" value="" class="namapropa1">
                        <input type="hidden" name="nama_proyek[proyek_2][]" value="" class="namapropa2">                    
                        <input type="hidden" name="nilai_1[proyek_1][]" value="{{$nilai_1[0]}}" class="nilai1" id="dmodal_1_{{$d->id}}">
                        <input type="hidden" name="nilai_2[proyek_1][]"  value="{{$nilai_2[0]}}" class="nilai2" id="dmodal_2_{{$d->id}}">
                        <input type="hidden" name="nilai_3[proyek_1][]"  value="{{$nilai_3[0]}}" class="nilai3" id="dmodal_3_{{$d->id}}">
                        <input type="hidden" name="nilai_4[proyek_1][]"  value="{{$nilai_4[0]}}" class="nilai4" id="dmodal_4_{{$d->id}}">
                        <input type="hidden" name="nilai_5[proyek_1][]"  value="{{$nilai_5[0]}}" class="nilai5" id="dmodal_5_{{$d->id}}">
                        <input type="hidden" name="nilai_6[proyek_1][]"  value="{{$nilai_6[0]}}" class="nilai6" id="dmodal_6_{{$d->id}}">
                        <input type="hidden" name="nilai_1[proyek_2][]"  value="{{$nilai_1[1]}}" class="nilai7" id="dmodal_7_{{$d->id}}" proyek="1">
                        <input type="hidden" name="nilai_2[proyek_2][]"  value="{{$nilai_2[1]}}" class="nilai8" id="dmodal_8_{{$d->id}}" proyek="1">
                        <input type="hidden" name="nilai_3[proyek_2][]"  value="{{$nilai_3[1]}}" class="nilai9" id="dmodal_9_{{$d->id}}" proyek="1">
                        <input type="hidden" name="nilai_4[proyek_2][]"  value="{{$nilai_4[1]}}" class="nilai10" id="dmodal_10_{{$d->id}}" proyek ="1">
                        <input type="hidden" name="nilai_5[proyek_2][]"  value="{{$nilai_5[1]}}" class="nilai11" id="dmodal_11_{{$d->id}}" proyek="1">
                        <input type="hidden" name="nilai_6[proyek_2][]"  value="{{$nilai_6[1]}}" class="nilai12" id="dmodal_12_{{$d->id}}" proyek="1">


                      
                        <input type="hidden" name="double_project[]" class="double_project" value="0">
                        <input type="hidden" name="tipe_project[]" value="{{$tipe->tipe}}" id="tipeTmp{{$loop->iteration}}">
                        <tr>
                          <td>{{ $loop->iteration }}
                          </td>
                          <td>{{ $d->name }}</td>
                          <td>{{ $d->kelas }}</td>
                          <td>
                            <?php 
                              $kelas_tmp =\DB::connection('mysql')->table('syskelas')->where('kode_kelas', $d->id_kelas)->first();
                            ?>
                            <button type="button" id="open{{$d->id}}" name="Performing Art" class="btn btn-primary" value="{{$d->id}}" data-kelas="{{$kelas_tmp->id}}" data-toggle="modal" data-target="#exampleModal">
                              Nilai
                            </button>
                          </td>
                        </tr>
                      @endforeach                      
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-6">
                  <button type="submit" class="btn-lg btn-primary ">Rekap</button>
                </div>
                <div class="form-group col-sm-6">
                  <button type="submit" class="btn-lg btn-primary " style="float:right"    formaction="{{url('/rubrick/creativity/store_nilai')}}">Save</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
  </div>
</section>

@endsection
@include('creativity.partials.secondary-hs-detail')

@section('scripts')
<script src="{{ asset('js/modal.js') }}"></script>
@endsection
