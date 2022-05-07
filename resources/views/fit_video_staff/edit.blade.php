@extends('layouts.app')
@section('title')
Video Workout Fit
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Create Video workout</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/fit_video/staff/update') }}" method="post">
              @csrf
              <div class="form-group col-sm-6">
                <label for="">Link Video</label>
                <input type="hidden" name="id" value="{{ $d->id }}">
                <input type="text" name="link" value="{{ $d->link }}" class="form-control @error('link') is-invalid @enderror" required>
                @error('link')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>

              <div class="form-group col-sm-6">
                <label for="">Time</label>
                <select class="form-control" name="fit_time_id" required>
                  <option value="">Select Waktu Training</option>
                  @foreach($time as $t)
                  @if($d->fit_time_id = $t->id)
                  <option value="{{ $t->id }}" selected>{{ $t->keterangan }} - {{ date('d-m-Y',strtotime($t->start_date)) }} - {{ date('d-m-Y',strtotime($t->end_date)) }}</option>
                  @else
                  <option value="{{ $t->id }}">{{ $t->keterangan }} - {{ date('d-m-Y',strtotime($t->start_date)) }} - {{ date('d-m-Y',strtotime($t->end_date)) }}</option>
                  @endif
                  @endforeach
                </select>
              </div>

              <div class="form-group col-sm-6">
                <label for="">Start Date</label>
                <input type="text" name="start_date" value="{{ date('d-m-Y',strtotime($d->start_date)) }}" readonly class="form-control @error('start_date') is-invalid @enderror date" required>
                @error('start_date')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
              <div class="form-group col-sm-6">
                <label for="">End Date</label>
                <input type="text" name="end_date" value="{{ date('d-m-Y',strtotime($d->end_date)) }}" readonly class="form-control date @error('end_date') is-invalid @enderror" required>
                @error('end_date')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>

              <div class="form-group col-sm-12">
                <button type="submit" name="button" class="btn btn-info btn-lg">Submit</button>
                <a href="{{ url('/fit_video')}}" class="btn btn-secondary btn-lg">Cancel</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
