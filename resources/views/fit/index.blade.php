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
        @if(auth()->user()->id_level <= 4)
        <a href="{{ url('/fit/kg/create')}}" class="btn btn-info btn-lg pull-right">Create Test</a>
        @else
        <a href="{{ url('/fit/create')}}" class="btn btn-info btn-lg pull-right">Create Test</a>
        @endif

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
                      @if(auth()->user()->id_level <= 4)
                      <th>Bear Crowl</th>
                      @else
                      <th>Plank</th>
                      @endif
                      <th>Nilai</th>
                      @if(auth()->user()->id_level <= 4)
                      <th>Sit and Reach</th>
                      @else
                      <th>Standing Broad Jump</th>
                      @endif
                      <th>Nilai</th>
                      @if(auth()->user()->id_level <= 4)
                      <th>Strock Stand (R)</th>
                      <th>Nilai</th>
                      <th>Strock Stand (L)</th>
                      <th>Nilai</th>
                      @else
                      <th>Strock Stand</th>
                      <th>Nilai</th>
                      @endif
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
                        {{-- @if($d->test_3_1 > $d->test_3_2 && $d->test_3_1 > $d->test_3_3)
                        <td>{{ $d->test_3_1 }}</td>
                        @elseif($d->test_3_2 > $d->test_3_3 && $d->test_3_2 > $d->test_3_1)
                        <td>{{ $d->test_3_2 }}</td>
                        @else
                        <td>{{ $d->test_3_3 }}</td>
                        @endif --}}
                        <td>{{ $d->test_3_1}}</td>
                        <td>{{ $d->nilai_test_3 }}</td>
                        <td>{{ $d->test_4_1 }}</td>
                        <td>{{ $d->nilai_test_4 }}</td>
                        {{-- <td>{{ $d->test_4_2 }}</td>
                        <td>{{ $d->nilai_test_4_2 }}</td> --}}
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
