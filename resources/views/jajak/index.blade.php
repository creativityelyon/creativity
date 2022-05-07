@extends('layouts.app')
@section('title')
Jajak Pendapat
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
    <h3 class="page__heading">Jajak Pendapat Orang Tua</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/jajak')}}" method="post">
              @csrf
              <div class="form-group col-sm-12">
                <h1>JAJAK PENDAPAT ORANGTUA SISWA</h1>
              </div>
              <div class="form-group col-sm-12">
                <p>Sehubungan dengan surat edaran Kementerian Pendidikan dan Kebudayaan SKB 4 menteri pada tanggal
                  30 Maret 2021 yang mewajibkan sekolah menyiapkan Opsi Pembelajaran Tatap Muka PTM Terbatas,
                  maka Elyon Christian School / Pelita Jaya School mengambil langkah strategis untuk bersiap sesuai dengan
                  ketentuan pemerintah dan mengakomodasi harapan masyarakat serta mempertimbangkan situasi
                  kondisi sekolah pada saat ini.</p>

                </br>

                <p> Hal-hal yang telah kami kerjakan terkait dengan persiapan  PTM terbatas adalah sbb: </p>
                <ol>
                  <li>Melakukan verifikasi validasi kesiapan belajar yang hasilnya menyatakan sekolah sudah siap melaksanakan PTM.</li>
                  <li> Mendapatkan izin dari Dinas Pendidikan Kota/Propinsi dan Satuan Tugas Covid - 19 Pemerintah Kota Surabaya</li>
                  <li> Mendapatkan persetujuan dari Elyon Parent Association (Komite Sekolah)</li>
                  <li> Membuat Protokol Kesehatan sesuai standar yang ditetapkan</li>
                  <li> Membuat peraturan khusus selama masa PTM terbatas dan standar perilaku siswa</li>
                  <li> Menyiapkan Sarana Prasarana sesuai standar</li>
                  <li> Menyiapkan Guru dan Tenaga Kependidikan</li>
                  <ul>
                    <li> Guru dan Tenaga Kependidikan telah melakukan vaksinasi</li>
                    <li> Pendataan Kesehatan guru dan tenaga kependidikan (komorbid, hamil/tidak tervaksin)</li>
                    <li> Pemeriksaan medis sesuai kebutuhan. </li>
                  </ul>
                </ol>

              </br>
              <span>Berdasarkan beberapa pertimbangan berikut ini: </span>
              <ol>
                <li>Memerhatikan persiapan sekolah untuk memulai PTM terbatas di semester 2 tahun ajaran 2021-2022.</li>
                <li>Memelajari Surat Edaran dari Direktur Pelaksana mengenai rencana PTM terbatas.</li>
                <li>Memelajari peraturan kesiswaan khusus selama masa PTM terbatas.</li>
                <li>Mengevaluasi hasil pemeriksaan Kesehatan siswa dan keluarga siswa yang tinggal serumah</li>
                <li>Orangtua bersedia mengikuti proses tracing dan tracking yang dilakukan oleh petugas Satgas
                  Covid apabila terjadi kasus positif dan bersedia bekerjasama dengan Satgas Covid Kota, Dinas
                  Kesehatan atau Puskesmas untuk melakukan testing dan kunjungan rumah jika diperlukan.
                </li>
              </ol>
              <div class="col-sm-12">
                @if(Auth::user()->id_level >= 0  && Auth::user()->id_level <= 4 && Auth::user()->lokasi == 'Kertajaya' ))
                <iframe src="https://drive.google.com/file/d/1yxms9ktX5Kz-0hLMIMIdsEjFdpe_8H_7/preview" width="auto" height="auto"></iframe>
                @elseif(Auth::user()->id_level >= 0  && Auth::user()->id_level <= 4 && Auth::user()->lokasi == 'Sukomanunggal' ))
                <iframe src="https://drive.google.com/file/d/1ZQq0fb78CmKf60GkwysgxpCs5HSVK0K_/preview" width="auto" height="auto"></iframe>
                @elseif(Auth::user()->id_level >= 11 && Auth::user()->id_level <= 16 && Auth::user()->lokasi == 'Darmo')
                <iframe src="https://drive.google.com/file/d/1ZUv9To_crxTKEJh3Pjsb1VqLr4GPrTPy/preview" width="auto" height="auto"></iframe>
                @elseif(Auth::user()->id_level >= 5 && Auth::user()->id_level <= 10 && Auth::user()->lokasi == 'Sukomanunggal')
                <iframe src="{{ url('/video/suko-simulasi.mp4')}}" width="auto" height="auto"></iframe>
                @endif
              </div>
              <p>Maka dengan ini saya:</p>
            </div>
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
              <label class="col-form-label pt-0">Alamat *</label>
              <input type="text" class="form-control mb-2 mr-sm-2" name="alamat" id="alamat" placeholder="Alamat"
              value="{{old('alamat')}}" required maxlength="200" >
              @error('alamat')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror

            </div>
            <div class="form-group col-sm-6">
              <label class="col-form-label pt-0">Orang Tua Dari (𝘍𝘶𝘭𝘭 𝘕𝘢𝘮𝘦) *</label>
              <input type="text" class="form-control mb-2 mr-sm-2" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap"
              value="{{ (Auth::user()->name) ? Auth::user()->name : ""}}" >
              <input type="hidden" class="form-control mb-2 mr-sm-2" name="no_induk_siswa_global" id="no_induk_siswa_global"
              value="{{ Auth::user()->no_induk_siswa_global }}" >
            </div>

            <div class="form-group col-sm-6">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="is_ijin" name="is_ijin" value="1" {{old('is_ijin') == 1 ? 'checked':''}}>
                <label class="form-check-label" for="inlineCheckbox1">Mengijinkan anak saya mengikuti PTM terbatas di semester 2 pada tahun ajaran 2021 - 2022</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="is_ijin" name="is_ijin" value="0" {{old('is_ijin') == 0 ? 'checked':''}}>
                <label class="form-check-label" for="inlineCheckbox1">Mengijinkan anak saya mengikuti Pelajaran Jarak Jauh (PJJ) di semester 2 pada tahun ajaran 2021 - 2022</label>
              </div>

              @error('is_ijin')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group col-sm-12">
              <p> Demikianlah pernyataan saya, terima kasih atas perhatian dan upaya sekolah menyiapkan PTM
                terbatas. </p>
              </div>

              <div class="clearfix">
              </div>
              <div class="form-group col-sm-12">
                <ul>
                  @if(Auth::user()->id_level >= 0  && Auth::user()->id_level <= 4 && Auth::user()->lokasi == 'Kertajaya' )
                  <li><a href="{{ url('/pdf/new/KONSEP_PGKG_KIT.pdf')}}" target="_blank" class="btn btn-primary">KONSEP PGKG KIT</a></li>
                  @elseif(Auth::user()->id_level >= 0  && Auth::user()->id_level <= 4 && Auth::user()->lokasi == 'Sukomanunggal' )
                  <li><a href="{{ url('/pdf/new/KONSEP_PGKG_SUKO.pdf')}}" target="_blank" class="btn btn-primary">KONSEP PGKG SUKOMANUNGGAL</a></li>
                  @elseif(Auth::user()->id_level >= 14 && Auth::user()->id_level <= 16 && Auth::user()->lokasi == 'Darmo')
                  <li><a href="{{ url('/pdf/new/KONSEP_HS_DARMO.pdf')}}" target="_blank" class="btn btn-primary">KONSEP HIGHSCHOOL DARMO</a></li>
                  @elseif(Auth::user()->id_level >= 11 && Auth::user()->id_level <= 13 && Auth::user()->lokasi == 'Darmo')
                  <li><a href="{{ url('/pdf/new/KONSEP_SC_DARMO.pdf')}}" target="_blank" class="btn btn-primary">KONSEP SECONDARY DARMO</a></li>
                  @elseif(Auth::user()->id_level >= 5 && Auth::user()->id_level <= 10 && Auth::user()->lokasi == 'Sukomanunggal')
                  <li><a href="{{ url('/pdf/new/KONSEP_PRIM_SUKO.pdf')}}" target="_blank" class="btn btn-primary">KONSEP PRIMARY SUKOMANUNGGAL</a></li>
                  @endif


                  @if(Auth::user()->id_level >= 0  && Auth::user()->id_level <= 4 && Auth::user()->lokasi == 'Kertajaya' )
                  <li><a href="{{ url('/pdf/new/KETENTUAN_PGKG_KIT.pdf')}}" target="_blank" class="btn btn-primary">KETENTUAN PGKG KIT</a></li>
                  @elseif(Auth::user()->id_level >= 0  && Auth::user()->id_level <= 4 && Auth::user()->lokasi == 'Sukomanunggal' )
                  <li><a href="{{ url('/pdf/new/KETENTUAN_PGKG_SUKO.pdf')}}" target="_blank" class="btn btn-primary">KETENTUAN PGKG SUKOMANUNGGAL</a></li>
                  @elseif(Auth::user()->id_level >= 14 && Auth::user()->id_level <= 16 && Auth::user()->lokasi == 'Darmo')
                  <li><a href="{{ url('/pdf/new/KETENTUAN_HS_DARMO.pdf')}}" target="_blank" class="btn btn-primary">KETENTUAN  HIGHSCHOOL DARMO</a></li>
                  @elseif(Auth::user()->id_level >= 11 && Auth::user()->id_level <= 13 && Auth::user()->lokasi == 'Darmo')
                  <li><a href="{{ url('/pdf/new/KETENTUAN_SC_DARMO.pdf')}}" target="_blank" class="btn btn-primary">KETENTUAN SECONDARY </a></li>
                  @elseif(Auth::user()->id_level >= 5 && Auth::user()->id_level <= 10 && Auth::user()->lokasi == 'Sukomanunggal')
                  <li><a href="{{ url('/pdf/new/KETENTUAN_PRIM_SUKO.pdf')}}" target="_blank" class="btn btn-primary">KETENTUAN PRIMARY SUKOMANUNGGAL</a></li>
                  @endif


                </ul>
              </div>
              <div class="clearfix"></div>
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

                  <li><b>Kami memberi kesempatan Bapak/Ibu orangtua siswa untuk mengumpulkan jajak pendapat 3 hari sejak tanggal penyebaran (Rabu, 6 Oktober 2021 s/d 9 Oktober 2021).</b></li>
                  <li><b>Apabila Bapak/Ibu mengizinkan anak untuk mengikuti PTM maka untuk selanjutnya mohon mengisi Surat Pernyataan.</b></li>
                  <li><b>Bapak/Ibu orangtua siswa yang belum mengumpulkan sampai batas waktu yang ditetapkan, akan dikategorikan tidak mengizinkan anak mengikuti PTM terbatas pada semester 2 TA 2021/2022.</b></li>
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
