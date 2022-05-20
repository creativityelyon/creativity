@extends('layouts.app')
@section('title')
Edit Project Tipe (Container / Performing Art)
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Edit Course Tipe (Container / Performing Art)</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/project_tipe/update') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$d->id}}"  class="form-control ">
              <div class="form-group col-sm-6">
                <label for="">Nama</label>
                <input type="text" name="nama" value="{{$d->nama}}"  class="form-control " required>
                @error('nama')
               <div class="invalid-feedback">
                 {{$message}}
               </div>
               @enderror
              </div>

              
              <div class="form-group col-sm-6">
                <label for="keterangan">Tipe </label>
                <select name="tipe" class="form-control">
                    <option value=1 @if($d->tipe == 1) selected @endif>Performing Art</option>
                    <option value=2  @if($d->tipe == 2) selected @endif>Container</option>
                </select>
              </div>
              <div class="form-group col-sm-12">
                <label for="keterangan">Teacher</label>
                <select class="form-control basicAutoComplete" type="text" name="teacher" autocomplete="off"></select>
              </div>

              <div class="form-group col-sm-12">
                <label for="keterangan">Description</label>
                <input type="text" class="form-control" name="description"  value="{{$d->description}}">
              </div>


              <div class="form-group col-sm-12">
                <label for="">Class</label>
                <hr>
                <?php 
                  $data_tmp = json_decode($d->class_range, true);
                
                ?>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" name="range_class[]" value="pgkg"  @if(in_array("pgkg",$data_tmp)) checked @endif>
                  <label class="form-check-label" for="exampleCheck1">PGKG</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" name="range_class[]" value="primary" @if(in_array("primary",$data_tmp)) checked @endif>
                  <label class="form-check-label" for="exampleCheck1">Primary</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" name="range_class[]" value="secondary" @if(in_array("secondary",$data_tmp)) checked @endif>
                  <label class="form-check-label" for="exampleCheck1">Secondary</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" name="range_class[]" value="highschool" @if(in_array("secondary",$data_tmp)) checked @endif>
                  <label class="form-check-label" for="exampleCheck1">HighSchool</label>
                </div>
              </div>
             

              <div class="form-group col-sm-12">
                <button type="submit" name="button" class="btn btn-info btn-lg">Submit</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@section('scripts')
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>
<script>

  <?php 
    if($data_teacher != null){
      ?>
      $('.basicAutoComplete').autoComplete('set', {value : "<?php if($data_teacher != null){ echo $data_teacher->id; } else { echo '';} ?>", text : "<?php if($data_teacher != null) {echo $data_teacher->nama_lengkap; } else {echo '';} ?>"})

  <?php
    
    }
  
  
  
  ?>

$('.basicAutoComplete').autoComplete({
      resolverSettings: {
        url: 'getTeacherId',
        method : 'get',
        
      }
  });

</script>

@endsection
@endsection
