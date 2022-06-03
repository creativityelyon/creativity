@extends('layouts.app')
@section('title')
Create Role
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    @if (isset($old_data))
    <h3 class="page__heading">Edit Role
      @php
          $guru = \DB::connection('mysql2')->table('users')->where('id', $old_data[0]['user_id'])->first();     
          echo $guru->nama_lengkap;
      @endphp
    </h3>
    @else
    <h3 class="page__heading">Create Role</h3>
    @endif
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/role/store') }}" method="post">
              @csrf
              <input type="hidden" name="teacher" value="@if(isset($old_data)) {{$old_data[0]['user_id']}} @else -1 @endif"/>
              {{-- <input type="hidden" name="teacher" value="@if(isset($old_data)) {{$old_data['user_id']}} @else -1 @endif"/> --}}
              @if (!isset($old_data))
              <div class="form-group col-sm-6">
                <label for="keterangan">Teacher</label>
                <select class="form-control basicAutoComplete" type="text" name="teacher" autocomplete="off"></select>
              </div> 
              @endif
              <div class="form-group col-sm-6">
                <label for="keterangan">Kelas</label>
                <select multiple="multiple" name="kelas[]" class="form-control" style="height: 100%">
                    <option value="" disabled>Select Class</option>
                    @if(isset($old_data))
                      @foreach($cls_kelas as $d )
                          @php
                              $flag = false;
                          @endphp
                          @for($i=0; $i<count($old_data); $i++)
                              <?php
                                  if($old_data[$i]['kelas_id'] == $d->id){
                                      $flag = true;
                                  }
                              ?>
                          @endfor
                          <option value="{{$d->id}}" @if($flag) selected @endif>{{$d->grade}} - {{$d->paralel}} - {{$d->lokasi}}</option>
                      @endforeach
                    @else
                      @foreach($cls_kelas as $d )
                        <option value="{{$d->id}}">{{$d->grade}} - {{$d->paralel}} - {{$d->lokasi}}</option>
                      @endforeach
                    @endif
                </select>
              </div>
          
              <div class="form-group col-sm-12 mt-5">
                <button type="submit" class="btn btn-info btn-lg">Submit</button>
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
  $('.basicAutoComplete').autoComplete({
      resolverSettings: {
        url: 'getTeacherId',
        method : 'get',
        
      }
  });

</script>

@endsection
@endsection
