@extends('layouts.app')
@section('title')
Create Daily Workout
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Create daily workout</h3>

  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <iframe width="100%" height="100%"
            src="{{$v->link}}"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media;
            gyroscope; picture-in-picture" allowfullscreen>
          </iframe>
        </div>
      </div>
    </div>

    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="form-group col-md-6">
            <h3>Tanggal Input Sebelum</h3>
            <label for="tanggal">Tanggal </label>
            <input type="text" name="date1" id="date1" value="{{ empty($date)  ? date('d-m-Y') : date('d-m-Y',strtotime($date)) }}" readonly class="form-control date">
          </div>
          <div class="col-md-6">
            <a class="btn btn-md btn-primary btn-select" style="color:white;">Pilih Tanggal</a>
          </div>

          @section('scripts')
          <script>
          $('.btn-select').click(function(){
            var date1 = $('#date1').val();
            date1 = date1.split('-');
            window.location.href = "{{ url('daily_fit/create') }}/"+date1[2]+"-"+date1[1]+"-"+date1[0];
          });

          </script>
          @endsection
        </div>
      </div>
    </div>


    <div class="col-lg-12">
      <div class="card">
        <div class="col-lg-12">
          <h4>Anda Harus Melakukan Sebanyak:
              @if($results == 4)
              3
              @elseif($results == 3)
              4
              @elseif($results == 2)
              5
              @else
              6
              @endif
             Kali / Minggu</h4>
             <h5>Anda Sudah Melakukan Sebanyak : {{$repeat}}</h5>
        </div>
        <div class="card-body">
          <form class="row" action="{{ url('/daily_fit/store')}}" method="post">
            @csrf
            <div class="form-group col-sm-12">
              <label for="tanggal">Tanggal</label>
              <input type="text" name="tanggal" id="tanggal" value="{{ empty($date)  ? date('d-m-Y') : date('d-m-Y',strtotime($date)) }}" readonly class="form-control">
              <input type="hidden" name="fit_test_id" value="{{ $fit_test_id }}">
              <input type="hidden" name="fit_time_id" value="{{ $fit_time_id }}">
              <input type="hidden" name="fit_video_id" value="{{ $v->id }}">
            </div>

            <div class="form-group col-sm-6">
              <label for="">Selesai </label>
              <input type="hidden" name="is_done" value="0">
              <input type="checkbox" name="is_done" value="1"> Yes

            </div>

            <div class="form-group col-sm-12">
              <button type="submit" class="btn-lg btn-primary ">Save </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@endsection


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
