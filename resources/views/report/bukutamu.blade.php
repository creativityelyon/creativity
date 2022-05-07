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
    <h3 class="page__heading">Buku Tamu</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <div class="table-responsive ">
              <table class="table table-hover table-striped table-bordered table-condensed dtt">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tgl</th>
                    <th>Nama</th>
                    <th>KTp</th>
                    <th>Hp</th>
                    <th>Approval Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $c)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ date('d/m/Y',strtotime($c->tgl)) }} </td>
                    <td class="text-left">{{ strtoupper($c->nama) }}</td>
                    <td class="text-left">{{ strtoupper($c->ktp) }}</td>
                    <td class="text-left">{{ strtoupper($c->hp) }}</td>
                    <td>
                      @if($c->q1 == 1 && $c->q2 == 1 && $c->q3 == 1 && $c->q4 == 1)
                      APPROVAL
                      @else
                      REJECT
                      @endif
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
</section>
@endsection
