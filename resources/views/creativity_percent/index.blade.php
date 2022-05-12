@extends('layouts.app')
@section('title')
Creativity
@endsection
@section('css')
<style>
.cell {
  max-width: 200; /* tweak me please */
  white-space : wrap;
  overflow : hidden;
}

.expand-small-on-hover:hover {
  max-width : 200px;
  text-overflow: ellipsis;
}

.expand-maximum-on-hover:hover {
  max-width : initial;
}

</style>
@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Creativity Percent Student</h3>

  </div>
  <div class="section-body">

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group col-md-6">
              <select class="time select form-input" name="time" id="time">
                <option value="">Select Fit Time Period</option>
                @foreach($fit_time as $f )
                <option value="{{$f->id}}">{{$f->keterangan}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <a class="btn btn-md btn-primary btn-select" style="color:white;">Select Data</a>
            </div>

            @section('scripts')
            <script>
            $('.btn-select').click(function(){
              if ($('#time').val() == '' || $('#time').val() == 'null' || $('#time').val() == 'undefined') {
                $('#time').focus();
              }else if ($('#kelas').val() == '' || $('#kelas').val() == 'null' || $('#kelas').val() == 'undefined') {
                $('#kelas').focus();
              }else {
                window.location.href = "{{ url('rubrick/creativity-percent') }}/"+$('#time').val();
              }
            });

            </script>
            @endsection
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed dtt">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Kelas</th>
                      <th>Novice %/th>
                      <th>Emerging</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($data) && isset($data))
                    @foreach($data as $d)
                    
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$d->grade}} - {{$d->paralel}} - {{$d->lokasi}}</td>
                      <td>{{$d->rata_rata_novice}}</td>
                      <td>{{$d->rata_rata_emerging}}</td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')

@endsection
