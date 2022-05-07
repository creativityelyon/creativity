@extends('layouts.app')
@section('title')
Check Fit
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Fit Time</h3>

  </div>
  <div class="section-body">

    <div class="row">

      <div class="col-lg-12">
        <a href="{{ url('/fit_time/create')}}" class="btn btn-info btn-lg pull-right">Create Schedule</a>
        <div class="card">
          <div class="card-body">

            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed dtt">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Keterangan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($data))
                    @foreach($data as $d)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ date('d-m-Y',strtotime($d->start_date))}}</td>
                      <td>{{ date('d-m-Y',strtotime($d->end_date))}}</td>
                      <td>{{ $d->keterangan }}</td>
                      <td>
                        <div class="button">
                          <a href="{{ url('/fit_time/edit',$d->id)}}" class="btn btn-sm btn-success">Edit</a>
                          <a href="{{ url('/fit_time/delete',$d->id)}}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete" onclick="return confirm('Delete This Data ?');"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
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
