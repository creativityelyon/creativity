@extends('layouts.app')
@section('title')
Report Daily Corpus
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
    <h3 class="page__heading">Report Harian Siswa/i Corpus</h3>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group col-md-6">
              <input type="text" name="date1" id="date1" value="{{ empty($date)  ? date('d-m-Y') : date('d-m-Y',strtotime($date)) }}" readonly class="form-control date">
            </div>
            <div class="form-group col-md-6">
              <a class="btn btn-md btn-primary btn-select" style="color:white;">Pilih Tanggal</a>
            </div>

            @section('scripts')
            <script>
            $('.btn-select').click(function(){
              var date1 = $('#date1').val();
              date1 = date1.split('-');
              window.location.href = "{{ url('report/daily/staff/corpus') }}/"+date1[2]+"-"+date1[1]+"-"+date1[0];
            });

            </script>
            @endsection
          </div>
        </div>
      </div>
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
                    <th>Nama Staff</th>
                    <th>Jabatan</th>
                    <th>Lokasi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $c)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ date('d/m/Y',strtotime($c->tgl)) }} </td>
                    <td class="text-left">{{ strtoupper($c->nama_lengkap) }}</td>
                    <td class="text-left">{{ strtoupper($c->jabatan) }}</td>
                    <td class="text-left">{{ strtoupper($c->lokasi) }}</td>
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
