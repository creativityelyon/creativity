@extends('layouts.app')
@section('title')
Surat pernyataan
@endsection
@section('css')
<style>
#sig-canvas {
  border: 2px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
}
.clearfix {
  clear: both;
}
.stick {
  position:relative;
}
</style>
@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Surat Pernyataan</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/pernyataan')}}" method="post">
              @csrf
              <div class="form-group col-sm-12">
                <h1>SURAT PERNYATAAN</h1>
              </div>
              <div class="form-group col-sm-12">
                <span>Yang bertanda tangan di bawah ini</span>
              </br>
            </div>


            <div class="clearfix"></div>
            <hr>
            <div class="clearfix"></div>
            <div class="form-group col-sm-6">
              <label class="col-form-label pt-0">Nama Orang Tua (𝘍𝘶𝘭𝘭 𝘕𝘢𝘮𝘦) *</label>
              <input type="text" class="form-control mb-2 mr-sm-2   @error('parent_name') is-invalid @enderror"
              name="parent_name" id="parent_name"
              placeholder="Nama Lengkap Orang Tua"
              value="{{old('parent_name')}}" required maxlength="200">
              @error('parent_name')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group col-sm-6">
              <label class="col-form-label pt-0">Nik *</label>
              <input type="text" class="form-control mb-2 mr-sm-2" name="nik" id="nik" placeholder="NIK"
              value="{{old('nik')}}" required maxlength="200" >
              @error('nik')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group col-sm-6">
              <label class="col-form-label pt-0">Pekerjaan *</label>
              <input type="text" class="form-control mb-2 mr-sm-2" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan"
              value="{{old('pekerjaan')}}" required maxlength="200" >
              @error('pekerjaan')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group col-sm-6">
              <label class="col-form-label pt-0">Alamat *</label>
              <input type="text" class="form-control mb-2 mr-sm-2" name="alamat" id="alamat" placeholder="Alamat"
              value="{{old('alamat')}}" required maxlength="200" >
              @error('alamat')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group col-sm-12">
              <span>Bahwa Selaku orangtua/wali*) dari siswa</span>
            </div>

            <div class="form-group col-sm-6">
              <label class="col-form-label pt-0">Nama *</label>
              <input type="text" class="form-control mb-2 mr-sm-2" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa"
              value="{{ Auth::user()->name }}" required maxlength="200" >
              @error('nama_siswa')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="form-group col-sm-6">
              <label class="col-form-label pt-0">Kelas *</label>
              <input type="text" class="form-control mb-2 mr-sm-2" name="kelas" id="kelas" placeholder="Kelas"
              value="{{ Auth::user()->kelas }}" required maxlength="200" >
              @error('kelas')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group col-sm-6">
              <label class="col-form-label pt-0">Alamat *</label>
              <input type="text" class="form-control mb-2 mr-sm-2" name="alamat_siswa" id="alamat_siswa" placeholder="Alamat Siswa"
              value="{{old('alamat_siswa')}}" required maxlength="200" >
              @error('alamat_siswa')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group col-sm-6">
              <label class="col-form-label pt-0">Unit Sekolah *</label>
              <input type="text" class="form-control mb-2 mr-sm-2" name="unit_sekolah" id="unit_sekolah" placeholder="Unit Sekolah"
              value="{{ Auth::user()->lokasi }}" required maxlength="200" >
              @error('unit_sekolah')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group col-sm-12">
              <span> Menyatakan bahwa saya bersedia : </span>
              <ol>

                <li>Mematuhi ketentuan sekolah tentang standar perilaku siswa pada Proses Pembelajaran Tatap Muka Terbatas.</li>
                <li>Membimbing anak saya untuk mematuhi Protokol Kesehatan dalam pelaksanaan Proses Pembelajaran Tatap Muka Terbatas.</li>
                <li>Mengikuti proses belajar mengajar sesuai jadwal yang di tetapkan sekolah.</li>
                <li>Mengantar dan menjemput siswa sesuai jadwal yang ditetapkan.</li>
                <li>Menerima sanksi jika tidak mematuhi Standar Protokol yang telah ditetapkan sekolah.</li>
                <li>Memahami sepenuhnya akan konsekuensi yang dapat ditimbulkan atau terjadi akibat Pembelajaran Tatap Muka Terbatas. </li>
              </ol>
            </div>

            <div class="clearfix">
            </div>

            <div class="form-group col-sm-6">
              <label for=""> Surabaya, {{date('d-m-Y')}}</label>
            </div>




            <div class="form-group col-md-12">
              <img id="sig-image" src="" alt="Your signature will go here!"/>

              @error('sig-dataUrl')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="clearfix"></div>
            <!-- Content -->
            <div class="container stick">
              <div class="row">
                <div class="col-sm-6">
                  <h1>E-Signature</h1>
                  <p>Sign in the canvas below and save your signature as an image!</p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <canvas id="sig-canvas" width="auto" height="auto" required style="touch-action: none;">
                    Get a better browser, bro.
                  </canvas>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <button type="button" class="btn btn-primary" id="sig-submitBtn">Submit Signature</button>
                  <button type="button" class="btn btn-default" id="sig-clearBtn">Clear Signature</button>
                </div>
              </div>
              <br/>

              <br/>

            </div>

            <div class="row" hidden>
              <div class="col-md-12">
                <textarea name="sig-dataUrl" id="sig-dataUrl" class="form-control" rows="5"></textarea>
              </div>
            </div>


            <div class="form-group">
              <span><b>Catatan : </b></span> <br/>
              <ul>
                <li><b>Bersedia membimbing siswa/i tersebut di atas untuk mentaati dan mematuhi Protokol Kesehatan dalam
                pelaksanaan PTM Terbatas di
                @if(auth::user()->id_level <= 4 )
                PGKG SMA Elyon Christian Secondary School Surabaya.
                @elseif(auth::user()->id_level >= 5 && auth::user()->id_level <= 10)
                SD
                @elseif(auth::user()->id_level >= 11 && auth::user()->id_level <= 13)
                SMP Elyon Christian Secondary School Surabaya.
                @else

                SMA Elyon Christian Secondary School Surabaya.

                @endif

                </b></li>
                <li><b>Bersedia mematuhi dan mengikuti Peraturan serta Standar Protokol Kesehatan yang telah ditetapkan Elyon
                Christian Secondary School Surabaya.</b></li>
                <li><b>Siswa/i tersebut di atas bersedia mengikuti semua prosedur dalam rangkaian pelaksanaan PTM Terbatas sesuai
                dengan jadwal yang telah ditetapkan Elyon Christian Secondary School Surabaya.</b></li>
                <li><b>Bersedia dan sanggup mengantar jemput siswa/i tersebut di atas selama melaksanakan PTM terbatas di
                Elyon Christian Secondary School Surabaya.</b></li>
                <li><b>Tidak berkeberatan menerima sanksi jika tidak mengikuti Standar Protokol Kesehatan yang telah ditetapkan
                oleh Elyon Christian Secondary School Surabaya.</b></li>
                <li><b>Bersedia melakukan Swab Antigen sebelum dimulainya PTM Terbatas dan rutin setiap 2 minggu sekali dengan
                biaya mandiri.</b></li>
                <li><b>Memahami sepenuhnya akan konsekuensi yang dapat ditimbulkan atau terjadi akibat Pembelajaran Tatap Muka
                Terbatas. Kami selaku orangtua mengambil tanggung jawab penuh apabila terjadi kasus pada putra/putri kami.</b></li>
                <li><b>Kami memberi kesempatan Bapak/Ibu orangtua siswa untuk mengumpulkan Surat Pernyataan ini paling lambat
                3 hari sejak orangtua menerimanya (Rabu, 6 Oktober 2021 s/d 9 Oktober 2021).</b></li>
                <li><b>Apabila Bapak/Ibu mengizinkan anak untuk mengikuti PTM maka untuk selanjutnya mohon mengisi Surat Pernyataan.</b></li>
                <li><b>Orangtua siswa yang tidak mengumpulkan Surat Pernyataan sampai batas waktu yang ditetapkan, akan
                dikategorikan belum mengizinkan anaknya mengikuti PTM terbatas di semester 2 pada tahun ajaran 2021-2022</b></li>
              </ul>
            </div>

            <div class="form-group">

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
(function() {
  window.requestAnimFrame = (function(callback) {
    return window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.oRequestAnimationFrame ||
    window.msRequestAnimaitonFrame ||
    function(callback) {
      window.setTimeout(callback, 1000 / 60);
    };
  })();

  var canvas = document.getElementById("sig-canvas");
  var ctx = canvas.getContext("2d");
  ctx.strokeStyle = "#222222";
  ctx.lineWidth = 4;

  var drawing = false;
  var mousePos = {
    x: 0,
    y: 0
  };
  var lastPos = mousePos;

  canvas.addEventListener("mousedown", function(e) {
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);

  canvas.addEventListener("mouseup", function(e) {
    drawing = false;
  }, false);

  canvas.addEventListener("mousemove", function(e) {
    mousePos = getMousePos(canvas, e);
  }, false);

  // Add touch event support for mobile
  canvas.addEventListener("touchstart", function(e) {

  }, false);

  canvas.addEventListener("touchmove", function(e) {
    var touch = e.touches[0];
    var me = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchstart", function(e) {
    mousePos = getTouchPos(canvas, e);
    var touch = e.touches[0];
    var me = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchend", function(e) {
    var me = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(me);
  }, false);

  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    }
  }

  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: touchEvent.touches[0].clientX - rect.left,
      y: touchEvent.touches[0].clientY - rect.top
    }
  }

  function renderCanvas() {
    if (drawing) {
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      ctx.stroke();
      lastPos = mousePos;
    }
  }

  // Prevent scrolling when touching the canvas
  document.body.addEventListener("touchstart", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchend", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchmove", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);

  (function drawLoop() {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  function clearCanvas() {
    canvas.width = canvas.width;
  }

  // Set up the UI
  var sigText = document.getElementById("sig-dataUrl");
  var sigImage = document.getElementById("sig-image");
  var clearBtn = document.getElementById("sig-clearBtn");
  var submitBtn = document.getElementById("sig-submitBtn");
  clearBtn.addEventListener("click", function(e) {
    clearCanvas();
    sigText.innerHTML = "Data URL for your signature will go here!";
    sigImage.setAttribute("src", "");
  }, false);
  submitBtn.addEventListener("click", function(e) {
    var dataUrl = canvas.toDataURL();
    sigText.innerHTML = dataUrl;
    sigImage.setAttribute("src", dataUrl);
  }, false);

})();
</script>
@endsection
