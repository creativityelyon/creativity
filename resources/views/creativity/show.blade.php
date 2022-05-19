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
  {{-- <input type="hidden" name="zyx" value="{{$kelas->grade}}"> --}}
  <div class="section-body">
    <input type="hidden" name="tempPa" value='<?php echo $performing_art;?>' id="performing_art">
    <input type="hidden" name="tempContainer" value='<?php echo  $container;?>' id="container">
    <input type="hidden" name="tempPa2" value='<?php echo $performing_art2;?>' id="performing_art2">
    <input type="hidden" name="tempContainer2" value='<?php echo  $container2;?>' id="container2">
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
                    {{-- <select name="kategori" id="subjects1" class="form-control">
                      @foreach ($kategori_performing as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                      @endforeach
                    </select> --}}
                    <input class="form-check-input" type="checkbox" id="addFormPerforming" style="float: left">
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
      {{-- <div class="col-sm-12" id="container">
        <div class="card">
          <div class="card-body">
            <div style="width: 100%;">
              <div class="form-group row">
                <div class="col-sm-4">Course Container</div>
                <div class="col-sm-8">
                    <select name="kategori" id="subjects2" class="form-control">
                      @foreach ($kategori_container as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                      @endforeach
                    </select>
                    <br>
                    <input class="form-check-input" type="checkbox" id="addFormContainer" style="float: left">
                    <label class="form-check-label" for="">
                      Need more form?
                    </label>
                </div>
              </div>
              <div class="aspectRow2 row">
                <div class="aspectForm2">
                  <div id="form3">
                  <div class="form-group row">
                    <div class="col-sm-4">Nama Proyek</div>
                    <div class="col-sm-8">
                        <input type="text" id="namapro3" name="namapro[2]" class="form-control" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Idea Generation</div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="13">
                        <label class="form-check-label" for="gridCheck1">
                          Choose
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Idea Design and Refinement</div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="14">
                        <label class="form-check-label" for="gridCheck1">
                          Choose
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Openness and Courage to Explore</div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="15">
                        <label class="form-check-label" for="gridCheck1">
                          Choose
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Work Creatively with others</div>
                    
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="16">
                        <label class="form-check-label" for="gridCheck1">
                          Choose
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Creative Production and Innovation</div>
                    
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="17">
                        <label class="form-check-label" for="gridCheck1">
                          Choose
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Reflection </div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="18">
                        <label class="form-check-label" for="gridCheck1">
                          Choose
                        </label>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="aspectForm2">
                  <div id="form4">
                  <div class="form-group row">
                    <div class="col-sm-4">Nama Proyek</div>
                    <div class="col-sm-8">
                        <input type="text" id="namapro4" name="namapro[3]" class="form-control" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Idea Generation</div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="19">
                        <label class="form-check-label" for="gridCheck1">
                          Choose
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Idea Design and Refinement</div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="20">
                        <label class="form-check-label" for="gridCheck1">
                          Choose
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Openness and Courage to Explore</div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="21">
                        <label class="form-check-label" for="gridCheck1">
                          Choose
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Work Creatively with others</div>
                    
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="22">
                        <label class="form-check-label" for="gridCheck1">
                          Choose
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Creative Production and Innovation</div>
                    
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="23">
                        <label class="form-check-label" for="gridCheck1">
                          Choose
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">Reflection </div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="24">
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
      </div> --}}
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
                  
                      {{-- @if($kelas->grade == 'KGA' || $kelas->grade == 'KGB' || $kelas->grade == 'PGB')
                      <tr>
                        <th>#</th>
                        <th>Nama Murid</th>
                        <th>Kelas</th>
                        <th>Performing Art</th>
                      </tr>
                      @elseif($kelas->grade >= 1 && $kelas->grade <= 6)
                      <tr>
                        <th>#</th>
                        <th>Nama Murid</th>
                        <th>Kelas</th>
                        <th>Performing Art</th>
                      </tr>
                      @else
                      <tr>
                        <th>#</th>
                        <th>Nama Murid</th>
                        <th>Kelas</th> --}}
                        {{-- <th>Idea Generation</th>
                        <th>Idea Design and Refinement</th>
                        <th>Openness and Courage to Explore</th>
                        <th>Work Creatively with others</th>
                        <th>Creative Production and Innovation</th>
                        <th>Reflection</th> --}}
                        {{-- <th>Performing Art</th>
                        <th>Container</th>
                      </tr>
  
                      @endif --}}
                    </thead>
                    <tbody>
                      @foreach($data as $d)
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

                        <input type="hidden" name="nama_proyek_performing_art[proyek_1][]" value="" class="namapropa1">
                        <input type="hidden" name="nama_proyek_performing_art[proyek_2][]" value="" class="namapropa2">
                        <input type="hidden" name="nama_proyek_container[proyek_1][]" value="" class="namaproc1">
                        <input type="hidden" name="nama_proyek_container[proyek_2][]" value="" class="namaproc2">

                        <?php 
                       

                          $data_temp_pa = \DB::connection('mysql')->table('temp_container')->where('id_user', $d->id)->where('fit_time_id', $fit_time)->where('tipe',1)->get();
                          $data_temp_co = \DB::connection('mysql')->table('temp_container')->where('id_user', $d->id)->where('fit_time_id', $fit_time)->where('tipe',2)->get();
                          $arrPa = [null,null];
                          $arrCo = [null,null];

                          $nilai_1_pa = [null, null];
                          $nilai_2_pa = [null, null];
                          $nilai_3_pa = [null, null];
                          $nilai_4_pa = [null, null];
                          $nilai_5_pa = [null, null];
                          $nilai_6_pa = [null, null];

                          $nilai_1_co = [null,null];
                          $nilai_2_co = [null,null];
                          $nilai_3_co = [null,null];
                          $nilai_4_co = [null,null];
                          $nilai_5_co = [null,null];
                          $nilai_6_co = [null,null];
                    
                          for($i=0;$i< count($data_temp_pa); $i++){
                            $arrPa[$i] = $data_temp_pa[$i]->id;
                            $nilai_1_pa[$i] = $data_temp_pa[$i]->nilai_1;
                            $nilai_2_pa[$i] = $data_temp_pa[$i]->nilai_2;
                            $nilai_3_pa[$i] = $data_temp_pa[$i]->nilai_3;
                            $nilai_4_pa[$i] = $data_temp_pa[$i]->nilai_4;
                            $nilai_5_pa[$i] = $data_temp_pa[$i]->nilai_5;
                            $nilai_6_pa[$i] = $data_temp_pa[$i]->nilai_6;
                          
                          }
                          for($i=0;$i< count($data_temp_co); $i++){
                            $arrCo[$i] = $data_temp_co[$i]->id;
                            $nilai_1_co[$i] = $data_temp_co[$i]->nilai_1;
                            $nilai_2_co[$i] = $data_temp_co[$i]->nilai_2;
                            $nilai_3_co[$i] = $data_temp_co[$i]->nilai_3;
                            $nilai_4_co[$i] = $data_temp_co[$i]->nilai_4;
                            $nilai_5_co[$i] = $data_temp_co[$i]->nilai_5;
                            $nilai_6_co[$i] = $data_temp_co[$i]->nilai_6;
                          }

                          $arrPa = array_merge($arrPa,$arrCo);

                         // dd($nilai_1_pa[0]);
                         
                        ?>

                            <input type="hidden" name="arroldPaCo[]" value="<?php echo json_encode($arrPa); ?>">
                    
                        <input type="hidden" name="nilai_1_pa[proyek_1][]" value="{{$nilai_1_pa[0]}}" class="nilai1" id="dmodal_1_pa_{{$d->id}}">
                        <input type="hidden" name="nilai_2_pa[proyek_1][]" value="{{$nilai_2_pa[0]}}" class="nilai2" id="dmodal_2_pa_{{$d->id}}">
                        <input type="hidden" name="nilai_3_pa[proyek_1][]" value="{{$nilai_3_pa[0]}}" class="nilai3" id="dmodal_3_pa_{{$d->id}}">
                        <input type="hidden" name="nilai_4_pa[proyek_1][]" value="{{$nilai_4_pa[0]}}" class="nilai4" id="dmodal_4_pa_{{$d->id}}">
                        <input type="hidden" name="nilai_5_pa[proyek_1][]" value="{{$nilai_5_pa[0]}}" class="nilai5" id="dmodal_5_pa_{{$d->id}}">
                        <input type="hidden" name="nilai_6_pa[proyek_1][]" value="{{$nilai_6_pa[0]}}" class="nilai6" id="dmodal_6_pa_{{$d->id}}">
                        <input type="hidden" name="nilai_1_pa[proyek_2][]" value="{{$nilai_1_pa[1]}}" class="nilai7" id="dmodal_7_pa_{{$d->id}}" proyek="1">
                        <input type="hidden" name="nilai_2_pa[proyek_2][]" value="{{$nilai_2_pa[1]}}" class="nilai8" id="dmodal_8_pa_{{$d->id}}" proyek="1">
                        <input type="hidden" name="nilai_3_pa[proyek_2][]" value="{{$nilai_3_pa[1]}}" class="nilai9" id="dmodal_9_pa_{{$d->id}}" proyek="1">
                        <input type="hidden" name="nilai_4_pa[proyek_2][]" value="{{$nilai_4_pa[1]}}" class="nilai10" id="dmodal_10_pa_{{$d->id}}" proyek ="1">
                        <input type="hidden" name="nilai_5_pa[proyek_2][]" value="{{$nilai_5_pa[1]}}" class="nilai11" id="dmodal_11_pa_{{$d->id}}" proyek="1">
                        <input type="hidden" name="nilai_6_pa[proyek_2][]" value="{{$nilai_6_pa[1]}}" class="nilai12" id="dmodal_12_pa_{{$d->id}}" proyek="1">


                        <input type="hidden" name="nilai_1_c[proyek_1][]" value="{{$nilai_1_co[0]}}" class="nilai13" id="dmodal_1_c_{{$d->id}}">
                        <input type="hidden" name="nilai_2_c[proyek_1][]" value="{{$nilai_2_co[0]}}" class="nilai14" id="dmodal_2_c_{{$d->id}}">
                        <input type="hidden" name="nilai_3_c[proyek_1][]" value="{{$nilai_3_co[0]}}" class="nilai15" id="dmodal_3_c_{{$d->id}}">
                        <input type="hidden" name="nilai_4_c[proyek_1][]" value="{{$nilai_4_co[0]}}" class="nilai16" id="dmodal_4_c_{{$d->id}}">
                        <input type="hidden" name="nilai_5_c[proyek_1][]" value="{{$nilai_5_co[0]}}" class="nilai17" id="dmodal_5_c_{{$d->id}}">
                        <input type="hidden" name="nilai_6_c[proyek_1][]" value="{{$nilai_6_co[0]}}" class="nilai18" id="dmodal_6_c_{{$d->id}}">
                        <input type="hidden" name="nilai_1_c[proyek_2][]" value="{{$nilai_1_co[1]}}" class="nilai19" id="dmodal_7_c_{{$d->id}}" proyek="2">
                        <input type="hidden" name="nilai_2_c[proyek_2][]" value="{{$nilai_2_co[1]}}" class="nilai20" id="dmodal_8_c_{{$d->id}}" proyek="2">
                        <input type="hidden" name="nilai_3_c[proyek_2][]" value="{{$nilai_3_co[1]}}" class="nilai21" id="dmodal_9_c_{{$d->id}}" proyek="2">
                        <input type="hidden" name="nilai_4_c[proyek_2][]" value="{{$nilai_4_co[1]}}" class="nilai22" id="dmodal_10_c_{{$d->id}}" proyek="2">
                        <input type="hidden" name="nilai_5_c[proyek_2][]" value="{{$nilai_5_co[1]}}" class="nilai23" id="dmodal_11_c_{{$d->id}}" proyek="2">
                        <input type="hidden" name="nilai_6_c[proyek_2][]" value="{{$nilai_6_co[1]}}" class="nilai24" id="dmodal_12_c_{{$d->id}}" proyek="2">

                        
                      

                       
                         
                        

                        <input type="hidden" name="double_proyek_c[]" value="" class="double_proyek_c">
                        <input type="hidden" name="double_proyek_pa[]" value="" class="double_proyek_pa">

                        <input type="hidden" name="kategori_pa[]" value="" class="kategori_pa">
                        <input type="hidden" name="kategori_c[]" value="" class="kategori_c">
                        <tr>
                          <td>{{ $loop->iteration }}
                          </td>
                          <td>{{ $d->name }}</td>
                          <td>{{ $d->kelas }}</td>
                          <td>
                            <button type="button" id="open{{$d->id}}" name="Performing Art" class="btn btn-primary" value="{{$d->id}}" data-toggle="modal" data-target="#exampleModal">
                              Nilai
                            </button>
                          </td>
                        </tr>
                      {{-- @if($kelas->grade == 'KGA' || $kelas->grade == 'KGB' || $kelas->grade == 'PGB')
                      <tr>
                        <td>{{ $loop->iteration }}
                        </td>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->kelas }}</td>
                        <td>
                          <button type="button" id="open{{$d->id}}" name="Performing Art" class="btn btn-primary" value="{{$d->id}}" data-toggle="modal" data-target="#exampleModal">
                            Performing Art
                          </button>
                        </td>
                      </tr>
  
                      @elseif($kelas->grade >= 1 && $kelas->grade <= 6)
                      <tr>
                        <td>{{ $loop->iteration }}
                        </td>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->kelas }}</td>
                        <td>
                          <button type="button" id="open{{$d->id}}" name="Performing Art" class="btn btn-primary" value="{{$d->id}}" data-toggle="modal" data-target="#exampleModal">
                            Performing Art
                          </button>
                        </td>
                      </tr>
                      @else
                      <tr>
                        <td>{{ $loop->iteration }}
                       
                        </td>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->kelas }}</td>
  
                        <td>
                            <button type="button" id="performing{{$d->id}}" name="Performing Art" class="btn btn-primary" value="{{$d->id}}" data-toggle="modal" data-target="#exampleModal">
                              Performing Art
                            </button>
                        </td>
                        <td>
                            <button type="button" id="container{{$d->id}}" name="Container" class="btn btn-primary" value="{{$d->id}}" data-toggle="modal" data-target="#exampleModal">
                              Container
                            </button>
                        </td>
                      </tr>
                      @endif --}}
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
