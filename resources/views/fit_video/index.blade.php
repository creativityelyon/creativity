@extends('layouts.app')
@section('title')
Fit Video
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Fit Video</h3>
  </div>
  <div class="section-body">

    <div class="row">

      <div class="col-lg-12">
        <a href="{{ url('/fit_video/create')}}" class="btn btn-info btn-lg pull-right">Create Video Workout</a>
        <div class="card">
          <div class="card-body">

            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed dtt">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>Link</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>PGKG</th>
                      <th>PRIMARY</th>
                      <th>SECONDARY</th>
                      <th>HIGHSCHOOL</th>
                      <th>STAFF</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($data))
                    @foreach($data as $d)
                    <tr>
                      <td>
                        <div class="button btn-group">
                          <a href="{{ url('/fit_video/edit',$d->id) }}" class="btn btn-success btn-sm">Edit</a>
                          <a href="{{ url('/fit_video/delete',$d->id)}}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete" onclick="return confirm('Delete This Data ?');"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
                      <td>{{ $d->link }}</td>
                      <td>{{ date('d-m-Y',strtotime($d->start_date))}}</td>
                      <td>{{ date('d-m-Y',strtotime($d->end_date))}}</td>
                      <td>{{ ($d->is_tk == 1) ? "AKTIF" : "NON-AKTIF"}} </td>
                      <td>{{ ($d->is_sd == 1) ? "AKTIF" : "NON-AKTIF"}} </td>
                      <td>{{ ($d->is_smp == 1) ? "AKTIF" : "NON-AKTIF"}} </td>
                      <td>{{ ($d->is_sma == 1) ? "AKTIF" : "NON-AKTIF"}} </td>
                      <td>{{ ($d->is_staff == 1) ? "AKTIF" : "NON-AKTIF"}} </td>

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
