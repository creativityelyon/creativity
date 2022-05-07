@extends('layouts.app')
@section('title')
Export Fit Time
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Export Fit Time</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/fit_time/store') }}" method="post">
              @csrf



            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
