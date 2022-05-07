@extends('layouts.app')
@section('title')
Report Pernyataan Survey
@endsection
@section('css')
<style>
#sig-canvas {
  border: 2px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
}
.clearfix {
  clear: both;
}
.stick {
  position:relative;
}
</style>
@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Report Pernyataan Survey</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed dtt">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tanggal</th>
                      <th>Nama user</th>
                      <th>Kelas</th>
                      <th>Lokasi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $d)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{ date('d-m-Y',strtotime($d->tgl)) }}</td>
                      <td>{{ $d->nama }}</td>
                      <td>{{ $d->kelas}}</td>
                      <td>{{ $d->unit }}</td>
                      <td>
                          <div class="btn-group">
                            <a href="{{ url('/report/pernyataan',$d->id)}}" class="btn btn-sm btn-primary">Show</a>
                          </div>
                      </td>
                    </tr>
                    @endforeach
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
