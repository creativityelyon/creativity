@extends('layouts.app')
@section('title')
Create Project Tipe (Container / Performing Art)
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Create Project Tipe (Container / Performing Art)</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/project_tipe/store') }}" method="post">
              @csrf

              <div class="form-group col-sm-6">
                <label for="">Nama</label>
                <input type="text" name="nama" value=""  class="form-control " required>
                @error('nama')
               <div class="invalid-feedback">
                 {{$message}}
               </div>
               @enderror
              </div>

              
              <div class="form-group col-sm-6">
                <label for="keterangan">Tipe </label>
                <select name="tipe" class="form-control">
                    <option value=1>Performing Art</option>
                    <option value=2>Container</option>
                </select>
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
