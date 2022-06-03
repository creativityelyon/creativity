@extends('layouts.app')
@section('title')
Creativity
@endsection
@section('css')
<style>

.cell {
  max-width: 200;
  white-space : wrap;
  overflow : hidden;
}

.expand-small-on-hover:hover {
  max-width : 200px;
  text-overflow: ellipsis;
}

.expand-maximum-on-hover:hover {
  max-width : initial;
} 



</style>
@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Creativity</h3>

  </div>
  <div class="section-body">

    <div class="row">
      <div class="col-lg-12">

        @if(Auth::user()->admin_level == 1 )
        <div class="card">
          <div class="card-body">
            <h4>Rekap</h4>
            <div class="form-group col-md-6">
              <form action="{{url('/creativity/store')}}" method="POST">
                @csrf
                <select class="kelas select form-input" name="kelas" id = "rekap_kelas">
                  <option value="">Select Class</option>
                  @foreach($cls_kelas as $d )
                  <option value="{{$d->id}}">{{$d->grade}} - {{$d->paralel}} - {{$d->lokasi}}</option>
                  @endforeach
                </select>

                <select class="time select form-input" name="time" id="rekap_time">
                  <option value="">Select Fit Time Period</option>
                  @foreach($fit_time as $f )
                  <option value="{{$f->id}}">{{$f->keterangan}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <button type="submit" style="display:none" class="btn btn-md btn-primary btn-select" style="color:white;" id="rekap">Rekap </button>
              </div>
              
              <div id="yang_belum" style="color: red; display:none">
              
            
              </div>



            
            </form>
          </div>
        </div>
         @endif


        <div class="card">
          <div class="card-body">
            <h4> Insert data</h4>
            <div class="form-group col-md-6">
              {{-- <select class="kelas select form-input" name="kelas" id="kelas">
                <option value="">Select Class</option>
                @foreach($cls as $d )
                <option value="{{$d->id}}">{{$d->grade}} - {{$d->paralel}} - {{$d->lokasi}}</option>
                @endforeach
              </select> --}}

              <select class="kelas select form-input" name="kelas" id="kelas">
                <option value="">Select Course</option>
                @foreach($cls as $d)
                <option value="{{$d->id}}" tipe="{{$d->tipe}}">{{$d->nama}}  - {{$d->description}} </option>
                @endforeach
              </select>
              

              <select class="time select form-input" name="time" id="time">
                <option value="">Select Fit Time Period</option>
                @foreach($fit_time as $f )
                <option value="{{$f->id}}">{{$f->keterangan}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <a class="btn btn-md btn-primary btn-select" style="color:white;" id="btn-select">Select Data</a>
            </div>

         

            @section('scripts')
            <script>
            $('#btn-select').click(function(){
              alert()
              if ($('#time').val() == '' || $('#time').val() == 'null' || $('#time').val() == 'undefined') {
                $('#time').focus();
              }else if ($('#kelas').val() == '' || $('#kelas').val() == 'null' || $('#kelas').val() == 'undefined') {
                $('#kelas').focus();
              }else {
                window.location.href = "{{ url('rubrick/creativity') }}/"+$('#time').val()+"/"+$('#kelas').val()+"/"+$("#kelas").find(':selected').attr('tipe');
              }
            });


            function cekRekap(){
                var rekap_time = $('#rekap_time').val();
                var rekap_kelas = $('#rekap_kelas').val();
                $.ajax({ 
                  method : 'POST',
                  data : {
                    rekap_time : rekap_time,
                    rekap_kelas : rekap_kelas
                  },
                  url : '/creativity/cekRekap',
                  success: function(result) {
                    console.log(result)
                    if(result == true){
                      $('#rekap').show();
                      $('#yang_belum').hide();
                      $('#yang_belum').html('');
                    } else{
                      $('#rekap').hide();
                      $('#yang_belum').html(result);
                      $('#yang_belum').show();
                    }
                  }
                });
              }

              $('#rekap_time').on('change', function(){
                  cekRekap();
              });

              $('#rekap_kelas').on('change', function(){
                  cekRekap();
              })

            </script>
            @endsection
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form action="{{url('/rubrick/creativity/filter')}}" method="GET">
              @csrf
              <div class="form-group col-md-6">
                <select class="kelas select form-input" name="kelas">
                  <option value="">Select Class</option>
                  @foreach($cls_kelas as $d )
                  <option value="{{$d->id}}">{{$d->grade}} - {{$d->paralel}} - {{$d->lokasi}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <button type="submit" class="btn btn-md btn-primary btn-select" style="color:white;" onclick="filter()">Filter </button>
              </div>
            </form>

            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed dtt">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>#</th>
                      <th>Nama Murid</th>
                      <th>Kelas</th>
                      <th>Lokasi</th>
                      <th>Nama Project Container</th>
                      <th>Level Container</th>
                      <th>Description Container</th>
                      <th>Nama Project Performing Art</th>
                      <th>Level Performing Art</th>
                      <th>Description Performing Art</th>
                      <th>Nama Project Container 2</th>
                      <th>Level Container 2</th>
                      <th>Description Container 2</th>
                      <th>Nama Project Performing Art 2</th>
                      <th>Level Performing Art 2</th>
                      <th>Description Performing Art</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($data))
                    @foreach($data as $d)
                    <tr>
                      <td>
                        <a href="{{ url('/creativity/edit',$d->id)}}" class="btn btn-danger btn-sm btn-info" ><i class="fas fa-pen"></i></a>

                        <a href="{{ url('/creativity/delete',$d->id)}}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete" onclick="return confirm('Delete This Data ?');"><i class="fas fa-trash"></i></a>
                      </td>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $d->nama }}</td>
                      <td>{{ $d->kelas }}</td>
                      <td>{{ $d->lokasi }}</td>

                      <td>{{$d->nama_proyek_container}}</td>
                      <td><?php 
                      if($d->level_container != null)
                        if($d->level_container < 1.5) echo "Novice"; else  if ($d->level_container >= 1.5)echo "Emerging";
                      ?></td>
                      <td class="cell">{{ $d->description_container }} </td>
                      <td>{{$d->nama_proyek_performing_art}}</td>
                      <td><?php 
                      if($d->level_performing_art != null)
                        if($d->level_performing_art < 1.5) echo "Novice"; else if($d->level_performing_art >= 1.5) echo "Emerging";
                      ?></td>
                       <td class="cell">{{ $d->description_performing_art }} </td>

                      <td>{{$d->nama_proyek_container_2}}</td>
                      <td><?php 
                        if($d->level_container_2 != null)
                        if($d->level_container_2 <1.5) echo "Novice"; else  if ($d->level_container_2 >= 1.5)echo "Emerging";
                      ?></td>
                      <td class="cell">{{ $d->description_container_2 }} </td>
                      <td>{{$d->nama_proyek_performing_art_2}}</td>
                      <td><?php 
                        if ($d->level_performing_art_2 != null)
                        if($d->level_performing_art_2 < 1.5) echo "Novice"; else if($d->level_performing_art_2 >= 1.5) echo "Emerging";
                      ?></td>
                       <td class="cell">{{ $d->description_performing_art_2 }} </td>
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

