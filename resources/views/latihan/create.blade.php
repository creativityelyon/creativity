@extends('layouts.app')
@section('title')
Create Fit Time
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Create Latihan</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/latihan/store') }}" method="post">
              @csrf

              <div class="form-group col-sm-6">
                <label for="keterangan">Jenis Latihan</label>
                <input type="text" name="jenis_latihan" value="" class="form-control">
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
