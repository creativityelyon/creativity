@extends('layouts.app')
@section('title')
Create Fit Time
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Create Fit Time</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/fit_time/staff/store') }}" method="post">
              @csrf

              <div class="form-group col-sm-6">
                <label for="">Start Date</label>
                <input type="text" name="start_date" value="" readonly class="form-control @error('start_date') is-invalid @enderror date" required>
                @error('start_date')
               <div class="invalid-feedback">
                 {{$message}}
               </div>
               @enderror
              </div>

              <div class="form-group col-sm-6">
                <label for="">End Date</label>
                <input type="text" name="end_date" value="" readonly class="form-control date @error('end_date') is-invalid @enderror" required>
                @error('end_date')
               <div class="invalid-feedback">
                 {{$message}}
               </div>
               @enderror
              </div>

              <div class="form-group col-sm-6">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" value="" class="form-control">
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
@endsection
