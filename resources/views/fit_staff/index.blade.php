@extends('layouts.app')
@section('title')
Check Fit
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Check Fit</h3>

  </div>
  <div class="section-body">

    <div class="row">

      <div class="col-lg-12">
        @if(!empty($fit_id))
        <a href="{{ url('/fit_staff/create')}}" class="btn btn-info btn-lg pull-right">Create Test</a>
        @endif
        <div class="card">
          <div class="card-body">

            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed dtt">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Gender</th>
                      <th>Usia</th>
                      <th>Tinggi Badan</th>
                      <th>Berat Badan</th>
                      <th>BMI</th>
                      <th>Category</th>
                      <th>Shutlerun</th>
                      <th>Nilai</th>
                      <th>STORK STAND</th>
                      <th>Nilai</th>
                      <th>PUSH UP</th>
                      <th>Nilai</th>
                      <th>Plank</th>
                      <th>Nilai</th>
                      <th>SQUAD</th>
                      <th>Nilai</th>
                      <th>TOTAL SCORE</th>
                      <th>CLASIFICATION</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($data))
                    @foreach($data as $d)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $d->jenis_kelamin }}</td>
                      <td>{{ $d->usia }}</td>
                      <td>{{ $d->tinggi_badan }}</td>
                      <td>{{ $d->berat_badan }}</td>
                      <td>{{ $d->bmi}}</td>
                      <td>{{ $d->category }}</td>
                      <td>{{ $d->test_1 }}</td>
                      <td>{{ $d->nilai_test_1 }}</td>
                      <td>{{ $d->test_2 }}</td>
                      <td>{{ $d->nilai_test_2 }}</td>
                      <td>{{ $d->test_3_1  }}</td>
                        <td>{{ $d->nilai_test_3 }}</td>
                        <td>{{ $d->test_4_1 }}</td>
                        <td>{{ $d->nilai_test_4 }}</td>
                        <td>{{ $d->test_4_2 }}</td>
                        <td>{{ $d->nilai_test_4_2 }}</td>
                        <td>{{ $d->total_point }}</td>
                        <td>{{ $d->hasil }}</td>
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
