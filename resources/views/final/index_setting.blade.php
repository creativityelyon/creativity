@extends('layouts.app')
@section('title')
Setting Print Final Report
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Setting</h3>

      </div>
    <div class="section-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <a href="{{ url('/corpus/settingPrinting/-1')}}" class="btn btn-lg btn-primary">Create</a>
              <div class="table-responsive">
                  <table class="table table-hover table-striped table-bordered table-condensed dtt col-12">
                    <thead>
                      <tr>
                         <th>Nama Kepala Sekolah</th>
                         <th>Tanda Tangan Kepala Sekolah</th>
                         <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @for($i=0; $i<count($data); $i++)
                            <tr>
                                <td>
                                    {{$data[$i]['nama_kepala_sekolah']}}
                                </td>
                                <td>
                                    <img src="../img/{{$data[$i]['tt_kepala_sekolah']}}" alt="" srcset="" height="180">
                                </td>
                                <td>
                                    <a href="{{url('/corpus/settingPrinting/'.$data[$i]['id'])}}" class="btn btn-sm btn-success"><i class="fas fa-pen"></i></a>
                                    <a href="{{url('/corpus/delete/'.$data[$i]['id'])}}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete" onclick="return confirm('Ingin menghapus data?');"><i class="fas fa-trash"></i></a>
                                  </td>
                            </tr>
                        @endfor
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>






      </div>
    </div>
  </section>

@endsection
