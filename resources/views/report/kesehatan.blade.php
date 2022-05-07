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
    <h3 class="page__heading">Report Kesehatan Siswa/i</h3>
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
                      <th>Tgl</th>
                      <th>Nomor Induk</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Lokasi</th>
                      <th>Covid</th>
                      <th>Hipertensi</th>
                      <th>Diabet</th>
                      <th>Imuno</th>
                      <th>Jantung</th>
                      <th>Cancer</th>
                      <th>Imuno</th>
                      <th>Riwayat Lain</th>
                      <th>Live With Comorbid</th>
                      <th>Kendaraan</th>
                      <th>Is Vaksin</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $c)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{ date('d/m/Y',strtotime($c->tgl)) }} </td>
                      <td class="text-left">{{ strtoupper($c->no_induk_siswa_global) }}</td>
                      <td class="text-left">{{ strtoupper($c->nama) }}</td>
                      <td class="text-left">{{ strtoupper($c->kelas) }}</td>
                      <td class="text-left">{{ strtoupper($c->unit) }}</td>
                      <td>
                        @if($c->is_covid)
                        Yes
                        @else
                        No
                        @endif
                      </td>
                      <td>
                        @if($c->is_hipertensi)
                        Yes
                        @else
                        No
                        @endif
                      </td>
                      <td>
                        @if($c->is_diabet)
                        Yes
                        @else
                        No
                        @endif
                      </td>
                      <td>
                        @if($c->is_imuno)
                        Yes
                        @else
                        No
                        @endif
                      </td>
                      <td>
                        @if($c->is_jantung)
                        Yes
                        @else
                        No
                        @endif
                      </td>
                      <td>
                        @if($c->is_paru)
                        Yes
                        @else
                        No
                        @endif
                      </td>
                      <td>
                        @if($c->is_cancer)
                        Yes
                        @else
                        No
                        @endif
                      </td>

                      <td>
                        @if($c->q2)
                        Yes
                        @else
                        No
                        @endif
                      </td>
                      <td>{{ $c->q5 }}</td>
                      <td>{{ ($c->q3 == 1) ? 'Yes' : 'No' }}</td>
                      <td>{{ ($c->q4 == 1) ? 'Yes' : 'No' }}</td>
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
