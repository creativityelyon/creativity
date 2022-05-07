@extends('layouts.app')
@section('title')
Creativity
@endsection
@section('css')

@endsection
@section('content')

<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Creativity</h3>
  </div>
  <div class="section-body">
    <form class="row" action="{{ url('/creativity/store') }}" method="post">

      @csrf
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">



            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed">
                  <thead>
                    @if($kelas->grade == 'KGA' || $kelas->grade == 'KGB' || $kelas->grade == 'PGB' || $kelas->grade == '1' || $kelas->grade == '2')
                    <tr>
                      <th>#</th>
                      <th>Nama Murid</th>
                      <th>Kelas</th>
                      <th>Idea Generation</th>
                      <th>Creative Production</th>
                    </tr>
                    @elseif($kelas->grade >= 3 && $kelas->grade <= 6)
                    <tr>
                      <th>#</th>
                      <th>Nama Murid</th>
                      <th>Kelas</th>
                      <th>Idea Generation</th>
                      <th>Openness and Courage to Explore</th>
                      <th>Work Creatively with others</th>
                      <th>Creative Production</th>
                    </tr>
                    @else
                    <tr>
                      <th>#</th>
                      <th>Nama Murid</th>
                      <th>Kelas</th>
                      {{-- <th>Idea Generation</th>
                      <th>Idea Design and Refinement</th>
                      <th>Openness and Courage to Explore</th>
                      <th>Work Creatively with others</th>
                      <th>Creative Production and Innovation</th>
                      <th>Reflection</th> --}}
                      <th>Performing Art</th>
                      <th>Container</th>
                    </tr>

                    @endif
                  </thead>
                  <tbody>
                    @foreach($data as $d)
                    @if($kelas->grade == 'KGA' || $kelas->grade == 'KGB' || $kelas->grade == 'PGB' || $kelas->grade == '1' || $kelas->grade == '2')
                    <tr>
                      <td>{{ $loop->iteration }}
                        <input type="hidden" name="user_id[]" value="{{ $d->id}}">
                        <input type="hidden" name="fit_time_id[]" value="{{ $fit_time }}">
                        <input type="hidden" name="nama_lengkap[]" value="{{ $d->name}}">
                        <input type="hidden" name="kelas[]" value="{{ $d->kelas}}">
                        <input type="hidden" name="grade[]" value="{{ $d->grade}}">
                        <input type="hidden" name="lokasi[]" value="{{ $d->lokasi}}">
                        <input type="hidden" name="id_kelas[]" value="{{ $d->id_kelas}}">
                        <input type="hidden" name="id_level[]" value="{{ $d->id_level}}">
                        <input type="hidden" name="gender[]" value="{{ $d->gender}}">
                        <input type="hidden" name="no_induk_siswa_global[]" value="{{ $d->no_induk_siswa_global}}">
                      </td>
                      <td>{{ $d->name }}</td>
                      <td>{{ $d->kelas }}</td>
                      <td><input type="text" class="form-control" id="creativity_1" name="creativity_1[]" value="2"></td>
                      <td><input type="text" class="form-control" id="creativity_2" name="creativity_2[]" value="2"></td>
                    </tr>

                    @elseif($kelas->grade >= 3 && $kelas->grade <= 6)
                    <tr>
                      <td>{{ $loop->iteration }}
                        <input type="hidden" name="user_id[]" value="{{ $d->id}}">
                        <input type="hidden" name="fit_time_id[]" value="{{ $fit_time }}">
                        <input type="hidden" name="nama_lengkap[]" value="{{ $d->name}}">
                        <input type="hidden" name="kelas[]" value="{{ $d->kelas}}">
                        <input type="hidden" name="grade[]" value="{{ $d->grade}}">
                        <input type="hidden" name="lokasi[]" value="{{ $d->lokasi}}">
                        <input type="hidden" name="id_kelas[]" value="{{ $d->id_kelas}}">
                        <input type="hidden" name="id_level[]" value="{{ $d->id_level}}">
                        <input type="hidden" name="gender[]" value="{{ $d->gender}}">
                        <input type="hidden" name="no_induk_siswa_global[]" value="{{ $d->no_induk_siswa_global}}">

                      </td>
                      <td>{{ $d->name }}</td>
                      <td>{{ $d->kelas }}</td>
                      <td><input type="text" class="form-control" id="creativity_1" name="creativity_1[]" value="2"></td>
                      <td><input type="text" class="form-control" id="creativity_2" name="creativity_2[]" value="2"></td>
                      <td><input type="text" class="form-control" id="creativity_3" name="creativity_3[]" value="2"></td>
                      <td><input type="text" class="form-control" id="creativity_4" name="creativity_4[]" value="2"></td>
                    </tr>
                    @else
                    <tr>
                      <td>{{ $loop->iteration }}
                        <input type="hidden" name="user_id[]" value="{{ $d->id}}">
                        <input type="hidden" name="fit_time_id[]" value="{{ $fit_time }}">
                        <input type="hidden" name="nama_lengkap[]" value="{{ $d->name}}">
                        <input type="hidden" name="kelas[]" value="{{ $d->kelas}}">
                        <input type="hidden" name="grade[]" value="{{ $d->grade}}">
                        <input type="hidden" name="lokasi[]" value="{{ $d->lokasi}}">
                        <input type="hidden" name="id_kelas[]" value="{{ $d->id_kelas}}">
                        <input type="hidden" name="id_level[]" value="{{ $d->id_level}}">
                        <input type="hidden" name="gender[]" value="{{ $d->gender}}">
                        <input type="hidden" name="no_induk_siswa_global[]" value="{{ $d->no_induk_siswa_global}}">
                      </td>
                      <td>{{ $d->name }}</td>
                      <td>{{ $d->kelas }}</td>
                      {{-- <td><input type="text" class="form-control" id="creativity_1" name="creativity_1[]" value="2"></td>
                      <td><input type="text" class="form-control" id="creativity_2" name="creativity_2[]" value="2"></td>
                      <td><input type="text" class="form-control" id="creativity_3" name="creativity_3[]" value="2"></td>
                      <td><input type="text" class="form-control" id="creativity_4" name="creativity_4[]" value="2"></td>
                      <td><input type="text" class="form-control" id="creativity_5" name="creativity_5[]" value="2"></td>
                      <td><input type="text" class="form-control" id="creativity_6" name="creativity_6[]" value="2"></td> --}}
                      <td>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                           Performing Art
                        </button>
                      </td>
                      <td>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                           Container
                        </button>
                      </td>
                    </tr>
                    @endif
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <button type="submit" class="btn-lg btn-primary ">Save </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Performing Art</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <form>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                  <select name="" id="" class="form-control">
                      <option value="">Art</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">Idea Generation</div>
                <div class="col-sm-3">
                    <input type="number" name="" id=""  class="form-control" value="" disabled>
                </div>
                <div class="col-sm-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                      Choose
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">Idea Design and Refinement</div>
                <div class="col-sm-3">
                    <input type="number" name="" id=""  class="form-control" value="" disabled>
                </div>
                <div class="col-sm-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                      Choose
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">Openness and Courage to Explore</div>
                <div class="col-sm-3">
                    <input type="number" name="" id=""  class="form-control" value="2">
                </div>
                <div class="col-sm-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                      Choose
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">Work Creatively with others</div>
                <div class="col-sm-3">
                    <input type="number" name="" id=""  class="form-control" value="2">
                </div>
                <div class="col-sm-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                      Choose
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">Creative Production and Innovation</div>
                <div class="col-sm-3">
                    <input type="number" name="" id=""  class="form-control" value="2">
                </div>
                <div class="col-sm-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                      Choose
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">Reflection </div>
                <div class="col-sm-3">
                    <input type="number" name="" id=""  class="form-control" value="2">
                </div>
                <div class="col-sm-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                      Choose
                    </label>
                  </div>
                </div>
              </div>

            </form>






      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




@endsection
