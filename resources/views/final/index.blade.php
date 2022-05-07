@extends('layouts.app')
@section('title')
Final Report
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Final Report </h3>
  </div>
  <div class="section-body">
    @php
    $total_nilai_1 = 0;
    $persentase_nilai_1 = 0;
    $total_nilai_1_1 = 0;
    $persentase_nilai_1_1 = 0;
    $total_nilai_2 = 0;
    $persentase_nilai_2 = 0;
    $total_nilai_2_1 = 0;
    $persentase_nilai_2_1 = 0;
    $total_nilai_3 = 0;
    $persentase_nilai_3 = 0;
    $total_nilai_3_1 = 0;
    $persentase_nilai_3_1 = 0;
    $total_nilai_4 = 0;
    $persentase_nilai_4 = 0;
    $total_nilai_4_1 = 0;
    $persentase_nilai_4_1 = 0;
    @endphp
    <div class="row">
      <div class="col-lg-12">
        <a href="{{ url('/final/report/generate')}}" class="btn btn-info btn-lg pull-right">Generate Final</a>
        <div class="card">
          <div class="card-body">

            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed dtt">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Lokasi</th>
                      <th>Score Sebelum</th>
                      <th>Score Sekarang</th>
                      <th>Category</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $count_siswa = 0; @endphp
                    @if(!empty($data))
                    @foreach($data as $d)
                    @php $count_siswa++; @endphp

                    @if($d->total_score <= 4)
                    @php
                    $total_nilai_1 = $total_nilai_1 + 1;

                    @endphp
                    @elseif($d->total_score >= 4.1 && $d->total_score <= 8)
                    @php
                    $total_nilai_2 = $total_nilai_2 + 1;

                    @endphp
                    @elseif($d->total_score >= 8.1 && $d->total_score <= 12)
                    @php
                    $total_nilai_3 = $total_nilai_3 + 1;

                    @endphp
                    @else
                    @php
                    $total_nilai_4 = $total_nilai_4 + 1;

                    @endphp
                    @endif

                    @if($d->score_sebelum <= 4)
                    @php
                    $total_nilai_1_1 = $total_nilai_1_1 + 1;
                    @endphp
                    @elseif($d->score_sebelum >= 4.1 && $d->score_sebelum <= 8)
                    @php
                    $total_nilai_2_1 = $total_nilai_2_1 + 1;

                    @endphp
                    @elseif($d->score_sebelum >= 8.1 && $d->score_sebelum <= 12)
                    @php
                    $total_nilai_3_1 = $total_nilai_3_1 + 1;

                    @endphp
                    @else
                    @php
                    $total_nilai_4_1 = $total_nilai_4_1 + 1;
                    @endphp
                    @endif


                    <tr @if($d->total_score == 4) style="background-color:#ffc30b"  @endif>
                      <td>
                        <a href="{{ url('/corpus/print',$d->id)}}" class="btn btn-sm btn-success"><i class="fas fa-print"></i></a>
                        <a href="{{ url('/corpus/delete',$d->id)}}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete" onclick="return confirm('Delete This Data ?');"><i class="fas fa-trash"></i></a>
                      </td>
                      <td>{{ $d->nama }}</td>
                      <td>{{ $d->kelas }}</td>
                      <td>{{ $d->lokasi }}</td>
                      <td>{{ $d->score_sebelum }}</td>
                      <td>{{ $d->total_score }}</td>
                      <td>{{ $d->creativity }}</td>
                      <td>{{ $d->desc_creativity }}</td>
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

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group col-md-6">
              <select class="kelas select form-input" name="kelas" id="kelas">
                <option value="">Select Class</option>
                @foreach($cls as $d )
                <option value="{{$d->id}}"
                  @if($kelas)
                  {{$kelas == $d->id ? 'selected' : ''}}
                  @endif>{{$d->grade}} - {{$d->paralel}} - {{$d->lokasi}}</option>
                  @endforeach
                </select>

                <select class="time select form-input" name="time" id="time">
                  <option value="">Select Fit Time Period</option>
                  @foreach($fit_time as $f )
                  <option value="{{$f->id}}"
                    @if($time)
                    {{$time == $f->id ? 'selected' : ''}}
                    @endif
                    >{{$f->keterangan}}</option>
                    @endforeach
                  </select>


                  <div style="width: 100%;">

                    <a class="btn btn-md btn-primary btn-select" style="color:white;">Select Data</a>

                    @section('scripts')
                    <script>
                    $('.btn-select').click(function(){
                      if ($('#time').val() == '' || $('#time').val() == 'null' || $('#time').val() == 'undefined') {
                        $('#time').focus();
                      }else if ($('#kelas').val() == '' || $('#kelas').val() == 'null' || $('#kelas').val() == 'undefined') {
                        $('#kelas').focus();
                      }else {
                        window.location.href = "{{ url('final/report/show') }}/"+$('#time').val()+"/"+$('#kelas').val();
                      }
                    });

                    </script>
                    @endsection
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-condensed dtt">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Jenis Nilai</th>
                          <th>Nilai 1</th>
                          <th>Persentase 1</th>
                          <th>Nilai 2</th>
                          <th>Persentase 2</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Need Improvement</td>
                          <td>{{ $total_nilai_1_1 }}</td>
                          <td>{{ ($count_siswa > 0) ?  $total_nilai_1_1 / $count_siswa * 100 : 0 }} %</td>
                          <td>{{ $total_nilai_1 }}</td>
                          <td>{{  ($count_siswa > 0) ?  $total_nilai_1 / $count_siswa * 100 : 0 }} %</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Satisfactory</td>
                          <td>{{ $total_nilai_2_1 }}</td>
                          <td>{{  ($count_siswa > 0) ?  $total_nilai_2_1 / $count_siswa * 100 : 0 }} %</td>
                          <td>{{ $total_nilai_2 }}</td>
                          <td>{{  ($count_siswa > 0) ?  $total_nilai_2 / $count_siswa * 100 : 0 }} %</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Good</td>
                          <td>{{ $total_nilai_3_1 }}</td>
                          <td>{{  ($count_siswa > 0) ?  $total_nilai_3_1 / $count_siswa * 100 : 0 }} %</td>
                          <td>{{ $total_nilai_3 }}</td>
                          <td>{{  ($count_siswa > 0) ?  $total_nilai_3 / $count_siswa * 100 : 0 }} %</td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Excellent</td>
                          <td>{{ $total_nilai_4_1 }}</td>
                          <td>{{ ($count_siswa > 0) ?  $total_nilai_4_1 / $count_siswa * 100 : 0 }} %</td>
                          <td>{{ $total_nilai_4 }}</td>
                          <td>{{ ($count_siswa > 0) ?  $total_nilai_4 / $count_siswa * 100 : 0 }} %</td>
                        </tr>
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
