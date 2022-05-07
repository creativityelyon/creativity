@extends('layouts.app')
@section('title')
Create Schedule Fit
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Create Schedule Fit</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/fit_sch/store') }}" method="post">
              @csrf
              <div class="form-group col-sm-6">
                <label for="">Training</label>
                <select class="form-control select2" name="latihan_id" required>
                  <option value="">Select Jenis Latihan</option>
                  @foreach($latihan as $l)
                  <option value="{{ $l->id }}">{{ $l->jenis_latihan }} - {{ $l->keterangan }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-sm-6">
                <label for="">Time</label>
                <select class="form-control select2" name="fit_time_id" required>
                  <option value="">Select Waktu Training</option>
                  @foreach($time as $t)
                  <option value="{{ $t->id }}">{{ $t->keterangan }} - {{ date('d-m-Y',strtotime($t->start_date)) }} - {{ date('d-m-Y',strtotime($t->end_date)) }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-sm-6">
                <label for="">Start Date</label>
                <input type="text" name="start_date" value="" readonly class="form-control date" required>

              </div>
              <div class="form-group col-sm-6">
                <label for="">End Date</label>
                <input type="text" name="end_date" value="" readonly class="form-control date" required>
              </div>
              <div class="form-group col-sm-6">
                <label for="keterangan">Aktif</label>
                <input type="hidden" name="aktif" value="0">
                <input type="checkbox" name="aktif" value="1" >
              </div>

              <div class="form-group col-sm-6">
                <label for="keterangan">PGKG</label>
                <input type="hidden" name="is_tk" value="0">
                <input type="checkbox" name="is_tk" value="1" >
              </div>

              <div class="form-group col-sm-6">
                <label for="keterangan">Primary</label>
                <input type="hidden" name="is_sd" value="0">
                <input type="checkbox" name="is_sd" value="1" >
              </div>


              <div class="form-group col-sm-6">
                <label for="keterangan">Secondary</label>
                <input type="hidden" name="is_smp" value="0">
                <input type="checkbox" name="is_smp" value="1" >
              </div>

              <div class="form-group col-sm-6">
                <label for="keterangan">Highschool</label>
                <input type="hidden" name="is_sma" value="0">
                <input type="checkbox" name="is_sma" value="1" >
              </div>

              <div class="form-group col-sm-6">
                <label for="keterangan">Staff / teacher</label>
                <input type="hidden" name="is_staff" value="0">
                <input type="checkbox" name="is_staff" value="1" >
              </div>

              <div class="form-group col-sm-12">
                <button type="submit" name="button" class="btn btn-info btn-lg">Submit</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
