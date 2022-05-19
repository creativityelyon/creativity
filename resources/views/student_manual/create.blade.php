@extends('layouts.app')
@section('title')
Export Student
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Export Student</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form action="{{ url('/export/student/store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label for="attendance_file" class="col-sm-2 col-form-label">Add Student Course PA/ Container</label>
                <div class="col-sm-10">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input @error('attendance_file') is-invalid @enderror" id="customFile" name="attendance_file" required>
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                  @error('attendance_file')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="card-footer text-right">
                <!-- <button type="submit" class="btn btn-primary mb-2 ml-auto" >Upload</button> -->
                <input type="submit" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='uploading…'; " value="Upload">
              </form>

            </div>


          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@endsection
