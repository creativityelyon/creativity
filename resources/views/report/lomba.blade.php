@extends('layouts.app')
@section('title')
Buku Tamu
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
    <h3 class="page__heading">Report Lomba</h3>
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
                      <th>Jenis Lomba</th>
                      <th>Kelas</th>
                      <th>Total </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $c)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      @if($c->lomba)
                        <td> {{ array_search($c->lomba, config('select.jenis_lomba')) }}</td>
                      @else
                        <td></td>
                      @endif

                      <td class="text-left">{{ $c->kelas_lomba  }}</td>
                      <td class="text-left">{{ $c->total }}</td>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <br/>
                <h3>DETAIL</h3>
                <div class="table-responsive">
                  <table class="table table-hover table-striped table-bordered table-condensed dtt">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Nama Siswa\i</th>
                        <th>Kelas</th>
                        <th>Jenis Lomba</th>
                        <th>Kelas Lomba</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data2 as $d)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> {{ date('d-m-Y',strtotime($d->tgl)) }}</td>
                        <td> {{ $d->nama }}</td>
                        <td> {{ $d->kelas }}</td>
                        @if($c->lomba)
                          <td> {{ array_search($c->lomba, config('select.jenis_lomba')) }}</td>
                        @endif
                        <td> {{ $d->kelas_lomba}}</td>
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
