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
            <form class="row" action="{{ url('/corpus/settingPrinting')}}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="@if(isset($data)) {{$data['id']}}  @else -1 @endif">
              <div class="form-group col-sm-12">
                <label for="">Nama Kepala Sekolah</label>
                <input type="text"class="form-control" name="nama_kepala_sekolah" id="" value="@if(isset($data)) {{$data['nama_kepala_sekolah']}}  @else -1 @endif" required>
              </div>

              <div class="col-md-6 mb-2">
                <label for="">Tanda Tangan</label>
                <br>
                <img id="preview-image-before-upload"
                    @if ( isset($data) &&  $data['tt_kepala_sekolah'] != "")
                        src="../../img/{{$data['tt_kepala_sekolah']}}"
                    @endif
                    src="https://djuragan.sgp1.digitaloceanspaces.com/djurkam/production/images/lodgings/5c53b6ccd8ae3.png"
                    alt="preview image" style="height: 300px; width: 400px; object-fit: cover;">

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="file" class="form-control" name="image_path" placeholder="Tanda Tangan" id="image" @if(!isset($data)) required @endif>
                    </div>
                </div>

                <div class = "col-md-12 mb-5">
                    <label for="">Cakupan Kelas</label>
                    <select class="form-control" style="height: 120%" multiple aria-label="multiple select example" name="class[]">
                        @if(isset($data_selected_class))
                            @foreach($class as $c)
                                @php
                                    $flag = false;
                                @endphp
                                @for($i=0; $i<count($data_selected_class); $i++)
                                    <?php

                                        if($data_selected_class[$i]['id_class'] == $c->id_kelas){
                                            $flag = true;
                                        }
                                    ?>
                                @endfor

                                <option value="{{$c->id_kelas}}"   @if($flag) selected @endif>{{ $c->kelas }} - {{ $c->lokasi}}</option>

                            @endforeach
                        @else


                            @foreach($class as $c)


                                <option value="{{$c->id_kelas}}">{{ $c->kelas }} - {{ $c->lokasi}}</option>

                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group col-sm-12 mt-5">
                    <button type="submit" class="btn-lg btn-primary ">Save </button>
                  </div>
            </form>
          </div>
        </div>
      </div>






    </div>
  </div>
</section>


@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $('#image').change(function(){

        var fileInput =
            document.getElementById('image');

        var filePath = fileInput.value;

        // var fileSize =
        // (fileInput.size / 1024).toFixed(2);
        // alert(fileSize);
        // if (fileSize > 4 || fileSize < 2) {
        // 	alert("File must be between the size of 2-4 MB");
        // 	fileInput.value = '';
        // 	return false;
        // }else{
            // Allowing file type
            var allowedExtensions =
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            }else{
                let reader = new FileReader();

                reader.onload = (e) => {

                $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        //}
        });
});
</script>
@endsection
