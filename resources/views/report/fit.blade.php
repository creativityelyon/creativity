@extends('layouts.app')
@section('title')
Report Fit Test
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Report Fit Test</h3>

  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body row">
            <div class="col-md-6">
              <select class="form-control" name="lokasi" id="lokasi">
                <option value="">Select Lokasi</option>
                <option value="Darmo">Darmo</option>
                <option value="Sukomanunggal">Sukomanunggal</option>
                <option value="Kertajaya">Kertajaya</option>
                <option value="Sutorejo">Sutorejo</option>
              </select>
            </div>
            <div class="col-md-6">
              <a class="btn btn-warning btn-select btn-lg"> Select </a>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body row">
            <div class="col-md-6">
              <select class="form-control" name="gender" id="gender">
                <option value="">Select Gender</option>
                <option value="F">Female</option>
                <option value="M">Male</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body row">
            <div class="col-md-6">
              <select class="form-control" name="kelas" id="kelas">
                <option value="">Select Kelas</option>
                @foreach($class as $c)
                <option value="{{$c->id_kelas}}">{{ $c->kelas }} - {{ $c->lokasi}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>


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
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Lokasi</th>
                      <th>Gender</th>
                      <th>Usia</th>
                      <th>Tinggi Badan</th>
                      <th>Berat Badan</th>
                      <th>BMI</th>
                      <th>Category</th>
                      <th>Shutlerun</th>
                      <th>Nilai</th>
                      <th>Sit Up</th>
                      <th>Nilai</th>
                      <th>Vertical Jump</th>
                      <th>Nilai</th>
                      <th>Strock Stand (R)</th>
                      <th>Nilai</th>
                      <th>Strock Stand (L)</th>
                      <th>Nilai</th>
                      <th>TOTAL SCORE</th>
                      <th>CLASIFICATION</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($data))
                    @php $null=0; $obses = 0; $under=0; $normal=0; $over=0; $marover=0;  @endphp
                    @php $exce=0; $good=0; $satis=0; $needimp=0; $gakniat=0; @endphp

                    @foreach($data as $d)
                    @if($d->hasil == 4)
                    @php $exce = $exce+1; @endphp
                    @elseif($d->hasil == 3)
                    @php $good = $good+1; @endphp
                    @elseif($d->hasil == 2)
                    @php $satis = $satis+1; @endphp
                    @elseif($d->hasil == 1)
                    @php $needimp = $needimp+1; @endphp
                    @else
                    @php $gakniat = $gakniat+1; @endphp
                    @endif

                    @if($d->category == 'Obese')
                    @php $obses = $obses + 1; @endphp
                    @elseif($d->category == 'Overweight')
                    @php $over = $over + 1; @endphp
                    @elseif($d->category == 'Marginally overweight')
                    @php $marover = $marover + 1; @endphp
                    @elseif($d->category == 'Normal')
                    @php $normal = $normal + 1; @endphp
                    @elseif($d->category == 'Underweight')
                    @php $under = $under +1; @endphp
                    @else
                    @php $null = $null + 1; @endphp
                    @endif


                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $d->name }}</td>
                      <td>{{ $d->kls }}</td>
                      <td>{{ $d->lks }}</td>
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
                      <td>{{ (($d->test_3_1 > $d->test_3_2) ? $d->test_3_1 :
                        ($d->test_3_1 > $d->test_3_3) ? $d->test_3_1 :
                        ($d->test_3_2 > $d->test_3_3) ? $d->test_3_2 :
                        ($d->test_3_2 > $d->test_3_1) ? $d->test_3_2 : $d->test_3_3) }}</td>
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
                          <th>BMI</th>
                          <th>Data</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Underweight</td>
                          <td>{{ $under }}</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Normal</td>
                          <td>{{ $normal }}</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Marginally overweight</td>
                          <td>{{ $marover }}</td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Overweight</td>
                          <td>{{ $over}}</td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Obese</td>
                          <td>{{ $obses }}</td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>Tidak isi</td>
                          <td>{{ $null }}</td>
                        </tr>
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
                <div style="width: 100%;">
                  <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-condensed dtt">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>TKJI</th>
                          <th>Data</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Excelent</td>
                          <td>{{ $exce }}</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Good</td>
                          <td>{{ $good }}</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Satisfactory</td>
                          <td>{{ $satis }}</td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Need Improvement</td>
                          <td>{{ $needimp }}</td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Tidak isi</td>
                          <td>{{ $gakniat }}</td>
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
    <script>
    $('.btn-select').click(function(){

      var gender = $('#gender').val();
      var kelas = $('#kelas').val();
      var lokasi = $('#lokasi').val();
      if (gender == '') {
        gender = 'null';
      }
      if (kelas == '') {
        kelas = 'null';
      }
      if (lokasi == '') {
        lokasi = 'null';
      }
      window.location.href = "{{ url('report/test') }}/"+gender+"/"+kelas+"/"+lokasi;
    });
    </script>
    @endsection
