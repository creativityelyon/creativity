@extends('layouts.app')
@section('title')
Check Fit
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Create Fit</h3>

  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            @if(!empty($fit_id))
            @if(empty($data) || $deadline >= date('Y-m-d') )
           {{--   @if($count_input[0]->total < 2) --}}
            <form class="row" action="{{ url('/fit_staff')}}" method="post">
              @csrf

              <div class="form-group col-md-6" hidden>
                <label for="">Fit ID</label>
                <input type="text" class="form-control mb-2 mr-sm-2   @error('fit_id') is-invalid @enderror"
                name="fit_id" id="fit_id"
                value="{{ $fit_id }}" readonly maxlength="200">
                @error('fit_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="">Nomor Induk</label>
                <input type="text" class="form-control mb-2 mr-sm-2   @error('nomor_induk') is-invalid @enderror"
                name="nomor_induk" id="nomor_induk"
                value="{{ auth()->user()->nip }}" readonly maxlength="200">
                @error('nomor_induk')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="">Nama Lengkap</label>
                <input type="text" class="form-control mb-2 mr-sm-2   @error('nama') is-invalid @enderror"
                name="nama" id="nama"
                value="{{ auth()->user()->nama_lengkap }}" readonly maxlength="200">
                @error('nama')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="">Gender</label>
                <input type="text" class="form-control mb-2 mr-sm-2   @error('jenis_kelamin') is-invalid @enderror"
                name="jenis_kelamin" id="jenis_kelamin"
                value="{{ (auth()->user()->gender == 'WANITA/FEMALE') ? "Female" : "Male" }}" readonly maxlength="200">
                @error('jenis_kelamin')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="">Usia</label>
                @php
                $birthDate = date('d-m-Y',strtotime(Auth::user()->tanggal_lahir));
                $birthDate = explode("-", $birthDate);
                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));
                @endphp
                <input type="text" class="form-control mb-2 mr-sm-2   @error('usia') is-invalid @enderror"
                name="usia" id="usia"
                value="{{ $age }}" readonly maxlength="200">
                @error('usia')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="">Tinggi Badan (m)</label>
                <input type="number" min="0" class="form-control mb-2 mr-sm-2   @error('tinggi_badan') is-invalid @enderror"
                name="tinggi_badan" id="tinggi_badan" step="0.01"
                value="{{ old('tinggi_badan') }}" required placeholder="Contoh 1.86">
                @error('tinggi_badan')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="">Berat Badan</label>
                <input type="number" min="0" class="form-control mb-2 mr-sm-2   @error('berat_badan') is-invalid @enderror"
                name="berat_badan" id="berat_badan" step="0.1"
                value="{{ old('berat_badan') }}" maxlength="4">
                @error('berat_badan')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="">Lari Bolak-Balik / Shuttle Run </label> <br/>
                <input type="number" min="0" class="form-control mb-2 mr-sm-2  @error('test_1') is-invalid @enderror"
                name="test_1" id="test_1" step="0.1"
                value=""  maxlength="4">
                @error('test_1')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="">STORK STAND</label> <br/>
                <input type="number" min="0" class="form-control mb-2 mr-sm-2   @error('test_2') is-invalid @enderror"
                name="test_2" id="test_2"
                value="" maxlength="4">
                @error('test_2')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>


              <div class="form-group col-md-6">
                <label for="">PUSH UP</label>
                <input type="number" min="0" class="form-control mb-2 mr-sm-2   @error('test_3_1') is-invalid @enderror"
                name="test_3_1" id="test_3_1"
                maxlength="4">
                @error('test_3_1')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>


              <div class="form-group col-md-6">
                <label for="">Plank</label>
                <input type="number" min="0" class="form-control mb-2 mr-sm-2   @error('test_4_1') is-invalid @enderror"
                name="test_4_1" id="test_4_1"
                maxlength="4">
                @error('test_4_1')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="">SQUAD</label>
                <input type="number" min="0" class="form-control mb-2 mr-sm-2   @error('test_4_2') is-invalid @enderror"
                name="test_4_2" id="test_4_2"
                maxlength="4">
                @error('test_4_2')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>


              <div class="form-group col-sm-12">
                <button type="submit" class="btn-lg btn-primary ">Save </button>
              </div>
            </form>
            {{-- @endif --}}
            @endif
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
