@extends('layouts.app')
@section('title')
Daily Fit
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Daily Fit</h3>

  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <a href="{{ url('/daily_fit/create')}}" class="btn btn-lg btn-success">Create Daily Workout</a>
        <div class="card">
          <div class="card-body">
            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed dtt">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <!-- <th>Detail</th> -->
                    </tr>
                  </thead>
                    <tbody>
                      @if(!empty($data))
                      @foreach($data as $d)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d-m-Y',strtotime($d->tgl)) }}</td>
                        <td>{{ $d->nama }}</td>
                        <!-- <td><a href="{{ url('/daily_fit/detail',$d->id) }}" class="btn btn-sm btn-primary"> Check</a></td> -->
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
