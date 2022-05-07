@extends('layouts.app')
@section('title')
Check Fit
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Fit Time</h3>

  </div>
  <div class="section-body">

    <div class="row">

      <div class="col-lg-12">
        <a href="{{ url('/export/test/create')}}" class="btn btn-info btn-lg pull-right">Create Schedule</a>
        <div class="card">
          <div class="card-body">


          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')

@endsection
