@extends('layouts.app')
@section('title')
Show Daily Fit
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Daily Fit {{ date('d-m-Y',strtotime($d->tanggal))}}</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <a href="{{ url('/daily_fit/create')}}" class="btn btn-lg btn-success">Daily Workout {{ date('d-m-Y',strtotime($d->tanggal))}}</a>
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
