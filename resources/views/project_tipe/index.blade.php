@extends('layouts.app')
@section('title')
Course Tipe (Container / Performing Art)
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Course Tipe (Container / Performing Art)</h3>

  </div>
  <div class="section-body">

    <div class="row">

      <div class="col-lg-12">
        <a href="{{ url('project_tipe/create')}}" class="btn btn-info btn-lg pull-right">Create New</a>
        <div class="card">
          <div class="card-body">

            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed dtt">
                    <?php $ctr = 1; ?>
                  <thead>
                    <tr>
                      <th>#</th>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Teacher</th>
                    <th>Description</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($data))
                    @foreach($data as $d)
                    <tr>
                        <td>{{$ctr}}</td>
                        
                      <td>{{$d->nama}}</td>
                      <td><?php
                      $ctr++; 
                        if($d->tipe == 1){
                            echo "Performing Art";
                         } else {
                            echo "Container";
                        }
                      ?></td>
                      <td><?php 
                        if($d->teacher_id != null){
                               $guru = \DB::connection('mysql2')->table('users')->where('id', $d->teacher_id)->first();
                        
                        echo $guru->nama_lengkap;
                        }
                      
                      ?></td>
                      <td>{{$d->description}}</td>
                      <td>
                        <div class="button">
                          <a href="{{ url('/project_tipe/edit',$d->id)}}" class="btn btn-sm btn-success">Edit</a>
                          <a href="{{ url('/project_tipe/delete',$d->id)}}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete" onclick="return confirm('Delete This Data ?');"><i class="fas fa-trash"></i></a>
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
