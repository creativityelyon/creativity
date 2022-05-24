@extends('layouts.app')
@section('title')
Creativity
@endsection
@section('css')

@endsection
@section('content')

<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Creativity Edit</h3>
  </div>
  <div class="section-body">
    <a href='{{url("rubrick/creativity")}}' class="btn btn-info mb-3 mt-2">Back</a>


    <form class="row" action="{{ url('/creativity/update') }}" method="post">

      @csrf
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div style="width: 100%;">
                <div class="row">
                  <div class="col-12"><h4> Name :  {{$d->nama}} </h4></div>
                </div>
                <div class="row">
                  <div class="col-12"><h4> Class :  {{$d->kelas}} </h4></div>
                </div>
                <hr>
                @if($d->nama_proyek_performing_art)
                <div class="row">
                  <div class="col-12">
                    <h5>Performing Art : <?php 
                        $dt =DB::connection('mysql')->table('project_tipe') ->where('id',$performing_art->master_project_tipe)->first();

                        echo $dt->nama;
                      
                      ?></h5>
                  
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"> 
                    <h5>Project Name : {{$d->nama_proyek_performing_art}} </h5>   
                   @if($performing_art->nilai_1 != null)
                    <div class="form-group row" id="aspect1">
                      <div class="col-sm-6">Idea Generation</div>
                      <div class="col-sm-3">
                          <input type="number" id="input1" name="nilai_pa_1" min="1" max="2" class="form-control" value="{{$performing_art->nilai_1}}">
                      </div>
                    </div>
                    @endif
                    @if($performing_art->nilai_2 != null)
                    <div class="form-group row" id="aspect2">
                      <div class="col-sm-6">Idea Design and Refinement</div>
                      <div class="col-sm-3">
                          <input type="number" id="input2" name="nilai_pa_2" min="1" max="2" class="form-control" value="{{$performing_art->nilai_2}}">
                      </div>
                    </div>
                    @endif
                    @if($performing_art->nilai_3 != null)
                    <div class="form-group row" id="aspect3">
                      <div class="col-sm-6">Openness and Courage to Explore</div>
                      <div class="col-sm-3">
                          <input type="number"  id="input3" name="nilai_pa_3" min="1" max="2" class="form-control" value="{{$performing_art->nilai_3}}">
                      </div>
                    </div>
                    @endif
                    @if($performing_art->nilai_4 != null)
                    <div class="form-group row" id="aspect4">
                      <div class="col-sm-6">Work Creatively with others</div>
                      <div class="col-sm-3">
                          <input type="number" id="input4"  name="nilai_pa_4" min="1" max="2" class="form-control" value="{{$performing_art->nilai_4}}">
                      </div>
                    </div>
                    @endif
                    @if($performing_art->nilai_5 != null)
                    <div class="form-group row" id="aspect5">
                      <div class="col-sm-6">Creative Production and Innovation</div>
                      <div class="col-sm-3">
                          <input type="number" id="input5" class="form-control" min="1" max="2" name="nilai_pa_5" value="{{$performing_art->nilai_5}}">
                      </div>
                    </div>
                    @endif
                    @if($performing_art->nilai_6 != null)
                    <div class="form-group row" id="aspect6">
                      <div class="col-sm-6">Reflection </div>
                      <div class="col-sm-3">
                          <input type="number"  id="input6" class="form-control" min="1" max="2" name="nilai_pa_6" value="{{$performing_art->nilai_6}}">
                      </div>
                    </div>
                    @endif
                  </div>

                  @if($d->nama_proyek_performing_art_2 != null)
                  <div class="col-sm-6"> 
                    <h5>Project Name : {{$d->nama_proyek_performing_art_2}} </h5>   
                    @if($performing_art_2->nilai_1 != null)
                    <div class="form-group row" id="aspect1">
                      <div class="col-sm-6">Idea Generation</div>
                      <div class="col-sm-3">
                          <input type="number" id="input1" name="nilai_pa2_1" min="1" max="2" class="form-control" value="{{$performing_art_2->nilai_1}}">
                      </div>
                    </div>
                    @endif
                    @if($performing_art_2->nilai_2 != null)
                    <div class="form-group row" id="aspect2">
                      <div class="col-sm-6">Idea Design and Refinement</div>
                      <div class="col-sm-3">
                          <input type="number" id="input2" name="nilai_pa2_2" min="1" max="2" class="form-control" value="{{$performing_art_2->nilai_2}}">
                      </div>
                    </div>
                    @endif
                    @if($performing_art_2->nilai_3 != null)
                    <div class="form-group row" id="aspect3">
                      <div class="col-sm-6">Openness and Courage to Explore</div>
                      <div class="col-sm-3">
                          <input type="number"  id="input3" name="nilai_pa2_3" min="1" max="2" class="form-control" value="{{$performing_art_2->nilai_3}}">
                      </div>
                    </div>
                    @endif
                    @if($performing_art_2->nilai_4 != null)
                    <div class="form-group row" id="aspect4">
                      <div class="col-sm-6">Work Creatively with others</div>
                      <div class="col-sm-3">
                          <input type="number" id="input4"  name="nilai_pa2_4" min="1" max="2" class="form-control" value="{{$performing_art_2->nilai_4}}">
                      </div>
                    </div>
                    @endif
                    @if($performing_art_2->nilai_5 != null)
                    <div class="form-group row" id="aspect5">
                      <div class="col-sm-6">Creative Production and Innovation</div>
                      <div class="col-sm-3">
                          <input type="number" id="input5" class="form-control" min="1" max="2" name="nilai_pa2_5" value="{{$performing_art_2->nilai_5}}">
                      </div>
                    </div>
                    @endif
                    @if($performing_art_2->nilai_6 != null)
                    <div class="form-group row" id="aspect6">
                      <div class="col-sm-6">Reflection </div>
                      <div class="col-sm-3">
                          <input type="number"  id="input6" class="form-control" min="1" max="2" name="nilai_pa2_6" value="{{$performing_art_2->nilai_6}}">
                      </div>
                    </div>
                    @endif
                  </div>
                  @endif

                </div>
                @endif

                @if($d->nama_proyek_container)
                <div class="row">
                  <div class="col-12">
                    <h5>Container : <?php 
                        $dt =DB::connection('mysql')->table('project_tipe') ->where('id',$container->master_project_tipe)->first();

                        echo $dt->nama;
                      
                      ?></h5>
                  
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6"> 
                    <h5>Project Name : {{$d->nama_proyek_container}} </h5>   
                   @if($container->nilai_1 != null)
                    <div class="form-group row" id="aspect1">
                      <div class="col-sm-6">Idea Generation</div>
                      <div class="col-sm-3">
                          <input type="number" id="input1" name="nilai_c_1" min="1" max="2" class="form-control" value="{{$container->nilai_1}}">
                      </div>
                    </div>
                    @endif
                    @if($container->nilai_2 != null)
                    <div class="form-group row" id="aspect2">
                      <div class="col-sm-6">Idea Design and Refinement</div>
                      <div class="col-sm-3">
                          <input type="number" id="input2" name="nilai_c_2" min="1" max="2" class="form-control" value="{{$container->nilai_2}}">
                      </div>
                    </div>
                    @endif
                    @if($container->nilai_3 != null)
                    <div class="form-group row" id="aspect3">
                      <div class="col-sm-6">Openness and Courage to Explore</div>
                      <div class="col-sm-3">
                          <input type="number"  id="input3" name="nilai_c_3" min="1" max="2" class="form-control" value="{{$container->nilai_3}}">
                      </div>
                    </div>
                    @endif
                    @if($container->nilai_4 != null)
                    <div class="form-group row" id="aspect4">
                      <div class="col-sm-6">Work Creatively with others</div>
                      <div class="col-sm-3">
                          <input type="number" id="input4"  name="nilai_c_4" min="1" max="2" class="form-control" value="{{$container->nilai_4}}">
                      </div>
                    </div>
                    @endif
                    @if($container->nilai_5 != null)
                    <div class="form-group row" id="aspect5">
                      <div class="col-sm-6">Creative Production and Innovation</div>
                      <div class="col-sm-3">
                          <input type="number" id="input5" class="form-control" min="1" max="2" name="nilai_c_5" value="{{$container->nilai_5}}">
                      </div>
                    </div>
                    @endif
                    @if($container->nilai_6 != null)
                    <div class="form-group row" id="aspect6">
                      <div class="col-sm-6">Reflection </div>
                      <div class="col-sm-3">
                          <input type="number"  id="input6" class="form-control" min="1" max="2" name="nilai_c_6" value="{{$container->nilai_6}}">
                      </div>
                    </div>
                    @endif
                  </div>

                  @if($d->nama_proyek_container_2 != null)
                  <div class="col-sm-6"> 
                    <h5>Project Name : {{$d->nama_proyek_container_2}} </h5>   
                    @if($container_2->nilai_1 != null)
                    <div class="form-group row" id="aspect1">
                      <div class="col-sm-6">Idea Generation</div>
                      <div class="col-sm-3">
                          <input type="number" id="input1" name="nilai_c2_1" min="1" max="2" class="form-control" value="{{$container_2->nilai_1}}">
                      </div>
                    </div>
                    @endif
                    @if($container_2->nilai_2 != null)
                    <div class="form-group row" id="aspect2">
                      <div class="col-sm-6">Idea Design and Refinement</div>
                      <div class="col-sm-3">
                          <input type="number" id="input2" name="nilai_c2_2" min="1" max="2" class="form-control" value="{{$container_2->nilai_2}}">
                      </div>
                    </div>
                    @endif
                    @if($container_2->nilai_3 != null)
                    <div class="form-group row" id="aspect3">
                      <div class="col-sm-6">Openness and Courage to Explore</div>
                      <div class="col-sm-3">
                          <input type="number"  id="input3" name="nilai_c2_3" min="1" max="2" class="form-control" value="{{$container_2->nilai_3}}">
                      </div>
                    </div>
                    @endif
                    @if($container_2->nilai_4 != null)
                    <div class="form-group row" id="aspect4">
                      <div class="col-sm-6">Work Creatively with others</div>
                      <div class="col-sm-3">
                          <input type="number" id="input4"  name="nilai_c2_4" min="1" max="2" class="form-control" value="{{$container_2->nilai_4}}">
                      </div>
                    </div>
                    @endif
                    @if($container_2->nilai_5 != null)
                    <div class="form-group row" id="aspect5">
                      <div class="col-sm-6">Creative Production and Innovation</div>
                      <div class="col-sm-3">
                          <input type="number" id="input5" class="form-control" min="1" max="2" name="nilai_c2_5" value="{{$container_2->nilai_5}}">
                      </div>
                    </div>
                    @endif
                    @if($container_2->nilai_6 != null)
                    <div class="form-group row" id="aspect6">
                      <div class="col-sm-6">Reflection </div>
                      <div class="col-sm-3">
                          <input type="number"  id="input6" class="form-control" min="1" max="2" name="nilai_c2_6" value="{{$container_2->nilai_6}}">
                      </div>
                    </div>
                    @endif
                  </div>
                  @endif

                </div>
                @endif

                <input type="hidden" name="performing_art_id" value=" <?php if($performing_art != null) echo $performing_art->id; else echo ""; ?>">
                <input type="hidden" name="performing_art_id_2" value="<?php if($performing_art_2 != null) echo $performing_art_2->id; else echo ""; ?>">
                <input type="hidden" name="container_id" value="<?php if($container != null) echo $container->id; else echo ""; ?>">
                <input type="hidden" name="container_2_id" value="<?php if($container_2 != null) echo $container_2->id; else echo ""; ?>">
                <input type="hidden" name="creativity_id" value="{{$d->id}}">
                <input type="hidden" name="creativity_id" value="{{$d->id}}">
                <input type="hidden" name="grade" value="{{$d->grade}}">
                <input type="hidden" name="gender" value="{{$d->gender}}">
                <input type="hidden" name="nama_lengkap" value="{{$d->nama}}">
                <input type="hidden" name="id_user" value="{{$d->user_id}}">
                <input type="hidden" name="fit_time_id" value="{{$d->fit_time_id}}">
            </div>
            <div class="form-group col-sm-12">
              <button type="submit" class="btn-lg btn-primary ">Save </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

@endsection

@section('scripts')
<script>
   $('input[type="number"]').change(function() {
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        if ($(this).val() > max)
        {
           $(this).val(max);
        }
        else if ($(this).val() < min)
        {
           $(this).val(min);
        }       
      }); 
</script>
@endsection
