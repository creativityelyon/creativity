@extends('layouts.app')
@section('title')
Role
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Role</h3>

  </div>
  <div class="section-body">

    <div class="row">

      <div class="col-lg-12">
        <a href="{{ url('role/setting_role')}}" class="btn btn-info btn-lg pull-right">Create New Role</a>
        <div class="card">
          <div class="card-body">

            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed dtt">
                    <?php $ctr = 1; ?>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Guru</th>
                      <th>Kelas</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($data))
                    @foreach($data as $d)
                    <tr>
                      <td>{{$ctr}}</td>
                      <td><?php 
                        if($d->user_id != null){
                          $guru = \DB::connection('mysql2')->table('users')->where('id', $d->user_id)->first();
                        
                        echo $guru->nama_lengkap;
                        } 
                      ?></td>
                      <td>
                        <?php 
                        $db = \DB::connection('mysql')->table('role')->where('user_id', $d->user_id)->where('deleted_at', null)->get();
                        if($db != null){
                          foreach ($db as $value) {
                            $kelas = \DB::connection('mysql')->table('syskelas')->where('id', $value->kelas_id)->first();
                            echo $kelas->grade ."-". $kelas->paralel ."-". $kelas->lokasi . "<br>";
                          }
                        } 
                      ?>
                      </td>
                      <td>
                        <div class="button">
                          <a href="{{ url('/setting_role',$d->user_id)}}" class="btn btn-sm btn-success">Edit</a>
                          <a href="{{ url('/role/delete',$d->user_id)}}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete" onclick="return confirm('Delete This Data ?');"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
                      <?php $ctr += 1; ?>
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
