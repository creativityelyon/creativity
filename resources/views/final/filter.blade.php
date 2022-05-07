@extends('layouts.app')
@section('title')
Final Report
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Final Report </h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div style="width: 100%;">
              <div class="table-responsive">
                <form action="{{url('final/submit')}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <table class="table table-hover table-striped table-bordered table-condensed dtt">
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Lokasi</th>
                        <th>BMI 1</th>
                        <th>BMI 2</th>
                        <th>TKJI 1</th>
                        <th>TKJI Score Last</th>
                        <th>Daily (%)</th>
                        <th>Effort</th>
                        <th>Total Score</th>
                      </tr>
                    </thead>
                    <tbody>


                      @if(!empty($data))
                      @foreach($data as $d)
                      <tr>
                        <td class="text-left text-center">
                          <div class="custom-control">
                            <input type="hidden" class="items" id="items-{{$d->id}}" name="item[]" value="0">
                            <input type="checkbox" class="form-check-input item" id="item-{{$d->id}}" name="item[]" value="{{$d->id}}" onclick="chkbox(this,{{$d->id}})">
                          </div>
                        </td>


                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->kelas }}</td>
                        <td>{{ $d->lokasi }}</td>
                        <td>{{ $d->category }} </td>
                        <td>{{ $d->category2 }} </td>
                        <td>{{ $d->indexTKJI }} </td>
                        <td>{{ $d->indexTKJI2 }} </td>
                        <td>{{ number_format((($d->total_daily/$day) * 100),1,',','.') }}</td>
                        <td>
                          {{ $d->effort }}
                        </td>
                        <td>{{ $d->total_score }}
                          <input type="hidden" name="fit_time_id[]" value="{{$d->fit_time_id}}">
                          <input type="hidden" name="fit_test_id_start[]" value="{{$d->id}}">
                          <input type="hidden" name="fit_test_id_end[]" value="{{$d->fit_test_id_2}}">
                          <input type="hidden" name="level_bmi[]" value="{{ $d->bmiscore2 }}">
                          <input type="hidden" name="level_tkji[]" value="{{ $d->indexTKJI2 }}">
                          <input type="hidden" name="daily_practice[]" value="{{ $d->total_daily }}">
                          <input type="hidden" name="effort[]" value="{{ $d->effort }}">
                          <input type="hidden" name="total_score[]" value="{{ $d->total_score }}">
                          @if($d->lokasi == 'Sutorejo')
                          <input type="hidden" name="user_id_sutorejo[]" value="{{ $d->user_id }}">
                          @else
                          <input type="hidden" name="user_id[]" value="{{ $d->user_id }}">
                          @endif
                          <input type="hidden" name="nik[]" value="{{ $d->nik }}">

                          <input type="hidden" name="nama[]" value="{{ $d->nama }}">
                          <input type="hidden" name="gender[]" value="{{ $d->jenis_kelamin }}">
                          <input type="hidden" name="kelas[]" value="{{ $d->kelas }}">
                          <input type="hidden" name="id_kelas[]" value="{{ $d->id_kelas }}">
                          <input type="hidden" name="id_level[]" value="{{ $d->id_level }}">
                          <input type="hidden" name="lokasi[]" value="{{ $d->lokasi }}">
                          <input type="hidden" name="homeroom[]" value="{{ $d->homeroom }}">
                        </td>
                      </tr>
                      @endforeach

                      @endif
                    </tbody>
                  </table>
                  <div class="row mt-3">
                    <div class="col-sm-12 text-center">
                      <input type="submit" name="" value="SUBMIT" class="btn btn-primary">
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@section('scripts')
<script>

  function chkbox(elem,id)
  {
    if($('#item-'+id).is(":checked")){
      $('#items-'+id).attr("disabled", "disabled");
    }else {
      $('#items-'+id).removeAttr("disabled", "disabled");
    }
  }

</script>
@endsection

@endsection
