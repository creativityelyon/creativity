@extends('layouts.app')
@section('title')
Check Fit
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Create Fit</h3>

  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/staff/final/report/filter')}}" method="post">
              @csrf
              <div class="form-group col-sm-12">
                <label for="">Time</label>
                <select class="form-control" name="fit_time_id" required>
                  <option value="">Select Waktu Training</option>
                  @foreach($time as $t)
                  <option value="{{ $t->id }}">{{ $t->keterangan }} - {{ date('d-m-Y',strtotime($t->start_date)) }} - {{ date('d-m-Y',strtotime($t->end_date)) }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-sm-6">
                <label for="keterangan"></label>

              </div>

              <div class="form-group col-sm-12">
                <button type="submit" name="button" class="btn btn-info btn-lg">Submit</button>
                <a href="{{ url('/staff/final/report')}}" class="btn btn-secondary btn-lg">Cancel</a>
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
$(document).ready(function(){

});
</script>
@endsection
