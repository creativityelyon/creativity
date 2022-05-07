@extends('layouts.auth_app')
@section('title')
Visitor Form
@endsection
@section('content')
<section class="section">
  <div class="card card-primary">
    <div class="card-header"><h4>Visitor Form</h4></div>

    <div class="card-body row">
      <h3> You Already Fill The Form Today </h3> </br> </br> 
      @if($data->q1 == 1 && $data->q2 == 1 && $data->q3 == 1 && $data->q4 == 1)
      <h3> Welcome to Elyon Christian School</h3>
      @else
      <h3>We are sorry. Access denied.</h3>
      @endif

    </div>
  </div>

</section>

@endsection
