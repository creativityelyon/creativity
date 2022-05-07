@extends('layouts.app')
@section('title')
Survey Kesehatan
@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Survey</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row" action="{{ url('/surveyKesehatan')}}" method="post">
              @csrf
              <div class="form-group col-sm-12">
                <h1>DATA KESEHATAN SISWA/SISWI (Student 𝘏𝘌𝘈𝘓𝘛𝘏 𝘋𝘈𝘛𝘈)</h1>
              </div>
              <div class="form-group col-sm-12">
                <p>Untuk melengkapi data kesehatan siswa/siswi terkait dengan persiapan kebiasaan baru (new normal) mohon agar semua siswa/siswi mengisi angket berikut ini sesuai dengan kondisi yang sebenarnya.
                  Terima kasih.
                  (𝘛𝘰 𝘤𝘰𝘮𝘱𝘭𝘦𝘵𝘦 student 𝘩𝘦𝘢𝘭𝘵𝘩 𝘥𝘢𝘵𝘢 𝘧𝘰𝘳 𝘵𝘩𝘦 𝘱𝘳𝘦𝘱𝘢𝘳𝘢𝘵𝘪𝘰𝘯 𝘰𝘧 𝘵𝘩𝘦 𝘯𝘦𝘹𝘵 𝘯𝘦𝘸  𝘯𝘰𝘳𝘮𝘢𝘭, 𝘵𝘰 𝘢𝘭𝘭 student 𝘱𝘭𝘦𝘢𝘴𝘦 𝘧𝘪𝘭𝘭 𝘰𝘶𝘵 𝘵𝘩𝘦 𝘧𝘰𝘭𝘭𝘰𝘸𝘪𝘯𝘨 𝘲𝘶𝘦𝘴𝘵𝘪𝘰𝘯𝘯𝘢𝘪𝘳𝘦 𝘢𝘤𝘤𝘰𝘳𝘥𝘪𝘯𝘨 𝘵𝘰 𝘵𝘩𝘦 𝘢𝘤𝘵𝘶𝘢𝘭 𝘤𝘰𝘯𝘥𝘪𝘵𝘪𝘰𝘯𝘴. 𝘛𝘩𝘢𝘯𝘬 𝘺𝘰𝘶.)</p>
                </div>
                <div class="form-group col-sm-6">
                  <label class="col-form-label pt-0">Nama Lengkap (𝘍𝘶𝘭𝘭 𝘕𝘢𝘮𝘦) *</label>
                  <input type="text" class="form-control mb-2 mr-sm-2" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap"
                  value="{{ (Auth::user()->name) ? Auth::user()->name : ""}}" >
                  <input type="hidden" class="form-control mb-2 mr-sm-2" name="no_induk_siswa_global" id="no_induk_siswa_global"
                  value="{{ Auth::user()->no_induk_siswa_global }}" >
                </div>
                <div class="form-group col-sm-6">
                  <label class="col-form-label pt-0">Usia (𝘈𝘨𝘦) *</label>
                  @php
                  $birthDate = date('d-m-Y',strtotime(Auth::user()->tgl_lahir));
                  $birthDate = explode("-", $birthDate);
                  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                  ? ((date("Y") - $birthDate[2]) - 1)
                  : (date("Y") - $birthDate[2]));
                  @endphp
                  <input type="text" class="form-control mb-2 mr-sm-2" name="umur" id="umur"
                  value="{{ $age }}" onkeypress="return isNumberKey(event)">
                  <input type="hidden" class="form-control mb-2 mr-sm-2" name="kelas" id="kelas" placeholder="Nama Lengkap"
                  value="{{ Auth::user()->kelas }}" readonly>
                  <input type="hidden" class="form-control mb-2 mr-sm-2" name="grade" id="grade" placeholder="Nama Lengkap"
                  value="{{ Auth::user()->grade }}" readonly>
                  <input type="hidden" class="form-control mb-2 mr-sm-2" name="lokasi" id="lokasi" placeholder="Nama Lengkap"
                  value="{{ Auth::user()->lokasi }}" readonly>
                </div>

                <div class="form-group col-sm-12">
                  <label class="col-form-label pt-0">Apakah anda memiliki riwayat penyakit berikut ini (𝘋𝘰 𝘺𝘰𝘶 𝘩𝘢𝘷𝘦 𝘢 𝘩𝘪𝘴𝘵𝘰𝘳𝘺 𝘰𝘧 𝘵𝘩𝘦 𝘧𝘰𝘭𝘭𝘰𝘸𝘪𝘯𝘨 𝘥𝘪𝘴𝘦𝘢𝘴𝘦𝘴) *</label>
                  <div class="form-group">
                    <label class="col-sm-6 col-form-label">Covid - 19</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input yescovid" type="radio" id="is_covid" name="is_covid" value="1">
                      <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input nocovid" type="radio" id="is_covid" name="is_covid" value="0">
                      <label class="form-check-label" for="inlineCheckbox2">No</label>
                    </div>
                    @error('is_covid')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group col-sm-6 pcrdate" hidden>
                    <span>Apabila pernah, mohon dituliskan tanggal SWAB atau PCR pertama yg menyatakan positif.</span>
                    <input type="text" class="form-control mb-2 mr-sm-2 date pcr_date_covid" readonly name="pcr_date_covid" id="pcr_date_covid" placeholder="Tanggal PCR/SWAB Pertama">
                  </div>
                  <div class="form-group">
                    <label class="col-sm-6 col-form-label">Hipertensi (𝘩𝘺𝘱𝘦𝘳𝘵𝘦𝘯𝘴𝘪𝘰𝘯)</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_hipertensi" name="is_hipertensi" value="1">
                      <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_hipertensi" name="is_hipertensi" value="0">
                      <label class="form-check-label" for="inlineCheckbox2">No</label>
                    </div>
                    @error('is_hipertensi')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label class="col-sm-6 col-form-label">Diabetes Melitus (𝘋𝘪𝘢𝘣𝘦𝘵𝘪𝘤 𝘔𝘦𝘭𝘭𝘪𝘵𝘶𝘴)</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_diabet" name="is_diabet" value="1">
                      <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_diabet" name="is_diabet" value="0">
                      <label class="form-check-label" for="inlineCheckbox2">No</label>
                    </div>

                    @error('is_diabet')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label class="col-sm-6 col-form-label">Penyakit Imunologi (𝘐𝘮𝘮𝘶𝘯𝘰𝘭𝘰𝘨𝘪𝘤𝘢𝘭 𝘋𝘪𝘴𝘦𝘢𝘴𝘦)</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_imuno" name="is_imuno" value="1">
                      <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_imuno" name="is_imuno" value="0">
                      <label class="form-check-label" for="inlineCheckbox2">No</label>
                    </div>


                    @error('is_imuno')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label class="col-sm-6 col-form-label">Penyakit Jantung (𝘏𝘦𝘢𝘳𝘵 𝘥𝘪𝘴𝘦𝘢𝘴𝘦)</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_jantung" name="is_jantung" value="1">
                      <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_jantung" name="is_jantung" value="0">
                      <label class="form-check-label" for="inlineCheckbox2">No</label>
                    </div>
                    @error('is_jantung')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label class="col-sm-6 col-form-label">PPOK-Penyakit Paru Obstruktif Kronis (𝘊𝘩𝘳𝘰𝘯𝘪𝘤 𝘖𝘣𝘴𝘵𝘳𝘶𝘤𝘵𝘪𝘷𝘦 𝘗𝘶𝘭𝘮𝘰𝘯𝘢𝘳𝘺 𝘋𝘪𝘴𝘦𝘢𝘴𝘦)</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_paru" name="is_paru" value="1">
                      <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_paru" name="is_paru" value="0">
                      <label class="form-check-label" for="inlineCheckbox2">No</label>
                    </div>
                    @error('is_paru')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label class="col-sm-6 col-form-label">Kanker (𝘊𝘢𝘯𝘤𝘦𝘳)</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_cancer" name="is_cancer" value="1">
                      <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="is_cancer" name="is_cancer" value="0">
                      <label class="form-check-label" for="inlineCheckbox2">No</label>
                    </div>
                  </div>

                  @error('is_cancer')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                </div>

                <div class="form-group col-sm-6">
                  <label class="col-form-label pt-0">Apakah anda memiliki riwayat penyakit lain selain penyakit yang disebutkan di atas? (𝘋𝘰 𝘺𝘰𝘶 𝘩𝘢𝘷𝘦 𝘢 𝘩𝘪𝘴𝘵𝘰𝘳𝘺 𝘰𝘧 𝘰𝘵𝘩𝘦𝘳 𝘥𝘪𝘴𝘦𝘢𝘴𝘦𝘴 𝘣𝘦𝘴𝘪𝘥𝘦𝘴 𝘵𝘩𝘦 𝘥𝘪𝘴𝘦𝘢𝘴𝘦𝘴 𝘮𝘦𝘯𝘵𝘪𝘰𝘯𝘦𝘥 𝘢𝘣𝘰𝘷𝘦?) *</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="q2" id="q2" value="1">
                    <label class="form-check-label" for="q2">
                      Yes
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="q2" id="q2no" value="0">
                    <label class="form-check-label" for="q2">
                      No
                    </label>
                  </div>

                  @error('q2')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group history" hidden>
                  <input type="text" class="form-control mb-2 mr-sm-2" name="keterangan_riwayat" id="keterangan_riwayat" placeholder="Health History">

                </div>
                <div class="form-group col-sm-6">
                  <label class="col-form-label pt-0">Apakah anda tinggal serumah dengan anggota keluarga lain yang memiliki Komorbid tidak terkontrol (komorbid yang parah/perlu treatment khusus)? 𝘋𝘰 𝘺𝘰𝘶 𝘭𝘪𝘷𝘦 𝘸𝘪𝘵𝘩 𝘰𝘵𝘩𝘦𝘳 𝘧𝘢𝘮𝘪𝘭𝘺 𝘮𝘦𝘮𝘣𝘦𝘳𝘴 𝘸𝘩𝘰 𝘩𝘢𝘷𝘦 𝘶𝘯𝘤𝘰𝘯𝘵𝘳𝘰𝘭𝘭𝘦𝘥 𝘊𝘰𝘮𝘰𝘳𝘣𝘪𝘥 (𝘴𝘦𝘷𝘦𝘳𝘦 / 𝘯𝘦𝘦𝘥 𝘴𝘱𝘦𝘤𝘪𝘢𝘭 𝘵𝘳𝘦𝘢𝘵𝘮𝘦𝘯𝘵)? *</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="q3" id="q3" value="1">
                    <label class="form-check-label" for="q3">
                      Yes
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="q3" id="q3no" value="0" >
                    <label class="form-check-label" for="q3">
                      No
                    </label>
                  </div>

                  <div class="degree" hidden>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="q3_ket" id="q3_ket" placeholder="Sebutkan apa hubungannya (ayah / ibu / kakek / nenek / paman / bibi dll.)"><br/>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="q3_ket_ket" id="q3_ket_ket" placeholder="Tuliskan comorbidnya">

                  </div>

                  @error('q3')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group col-sm-6">
                  <label class="col-form-label pt-0"> Alat transportasi apa yang anda gunakan untuk berangkat - pulang kerja? (𝘞𝘩𝘢𝘵 𝘮𝘦𝘢𝘯𝘴 𝘰𝘧 𝘵𝘳𝘢𝘯𝘴𝘱𝘰𝘳𝘵𝘢𝘵𝘪𝘰𝘯 𝘥𝘰 𝘺𝘰𝘶 𝘶𝘴𝘦 𝘧𝘰𝘳 𝘤𝘰𝘮𝘮𝘶𝘵𝘪𝘯𝘨 𝘵𝘰 𝘸𝘰𝘳𝘬?) *</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="q5" id="q5" value="Kendaraan Umum">
                    <label class="form-check-label" for="q3">
                      Kendaraan Umum (𝘱𝘶𝘣𝘭𝘪𝘤 𝘵𝘳𝘢𝘯𝘴𝘱𝘰𝘳𝘵𝘢𝘵𝘪𝘰𝘯)
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="q5" value="Kendaraan Pribadi" >
                    <label class="form-check-label" for="q3">
                      Kendaraan Pribadi (𝘱𝘳𝘪𝘷𝘢𝘵𝘦 𝘷𝘦𝘩𝘪𝘤𝘭𝘦)
                    </label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="q5" value="Mobil Sekolah" >
                    <label class="form-check-label" for="q3">
                      Mobil Sekolah (𝘴𝘤𝘩𝘰𝘰𝘭 𝘤𝘢𝘳)
                    </label>
                  </div>

                  @error('q5')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group col-sm-12">
                  <label class="col-form-label pt-0"> Bagaimana status vaksin covid 19 anda? (𝘞𝘩𝘢𝘵 𝘪𝘴 𝘵𝘩𝘦 𝘴𝘵𝘢𝘵𝘶𝘴 𝘰𝘧 𝘺𝘰𝘶𝘳 𝘊𝘰𝘷𝘪𝘥 19 𝘷𝘢𝘤𝘤𝘪𝘯𝘦?) *</label>
                  <div class="form-check">
                    <input class="form-check-input q4" type="radio" name="q4" id="q4" value="2">
                    <label class="form-check-label" for="q4">
                      sudah vaksin (𝘢𝘭𝘳𝘦𝘢𝘥𝘺 𝘷𝘢𝘤𝘤𝘪𝘯𝘦𝘴) 2x Lengkap
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input q4" type="radio" name="q4" id="q4" value="1">
                    <label class="form-check-label" for="q4">
                      sudah vaksin (𝘢𝘭𝘳𝘦𝘢𝘥𝘺 𝘷𝘢𝘤𝘤𝘪𝘯𝘦𝘴) 1x
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input q4no" type="radio" name="q4" id="q4no" value="0" >
                    <label class="form-check-label" for="q4">
                      belum vaksin (𝘩𝘢𝘷𝘦𝘯'𝘵 𝘳𝘦𝘤𝘦𝘪𝘷𝘦𝘥 𝘵𝘩𝘦 𝘷𝘢𝘤𝘤𝘪𝘯𝘦)
                    </label>
                  </div>

                  @error('q4')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group col-md-6 vaksin" hidden>
                  <input type="text" class="form-control mb-2 mr-sm-2 ket_vaksin_1" name="ket_vaksin_1" id="ket_vaksin_1" placeholder="Tanggal dan Tempat Vaksin Pertama "><br/>
                  <input type="text" class="form-control mb-2 mr-sm-2 ket_vaksin_2" name="ket_vaksin_2" id="ket_vaksin_2" placeholder="Tanggal dan Tempat Vaksin Kedua">
                </div>


                <div class="form-group col-md-6 novaksin" hidden>
                  <span>Mengapa belum mendapatkan Vaksin Covid 19? </span>
                  <select class="form-control" name="why_not_vaksin" >
                    <option value="">Select option</option>
                    <option value="Siswa/i Masih Sakit">Siswa/i Masih Sakit</option>
                    <option value="Siswa/i Tidak Mendapatkan Persetujuan Orang Tua">Siswa/i Tidak Mendapatkan Persetujuan Orang Tua</option>
                    <option value="Siswa/i Tidak mendapatkan ijin dari dokter pribadi">Siswa/i Tidak mendapatkan ijin dari dokter pribadi</option>
                    <option value="Umur Siswa Belum Memenuhi Syarat">Umur Siswa Belum Memenuhi Syarat</option>
                    <option value="Posisi Masih Diluar Kota">Posisi Masih Diluar Kota</option>
                    <option value="Siswa memiliki Komorbid">Siswa memiliki Komorbid</option>
                    <option value="Belum Mendapatkan Kuota">Belum Mendapatkan Kuota</option>
                  </select>
                </div>

                <div class="form-group col-sm-12">
                  <label for=""><b>*</b> Required / Harus di isi</label>
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
  @section('scripts')
  <script>


  $(document).ready(function(){

    $('.q4').change(function(){
      if($(this).val() == 2) {
        $('.vaksin').removeAttr('hidden','hidden');
        $('.ket_vaksin_1').attr('required','required');
        $('.ket_vaksin_2').removeAttr('hidden','hidden');
        $('.ket_vaksin_2').attr('required','required');
        $('.novaksin').attr('hidden','true');
        $('.why_not_vaksin').removeAttr('required','required');

      }else if ($(this).val() == 1) {
        $('.vaksin').removeAttr('hidden','hidden');
        $('.ket_vaksin_1').attr('required','required');
        $('.ket_vaksin_2').removeAttr('required','required');
        $('.ket_vaksin_2').attr('hidden','true');

        $('.novaksin').attr('hidden','true');
        $('.why_not_vaksin').removeAttr('required','required');

      }
    });

    $('.q4no').change(function(){
      if($(this).val() == 0) {
        $('.vaksin').attr('hidden','true');
        $('.ket_vaksin_1').removeAttr('required','required');
        $('.ket_vaksin_2').removeAttr('required','required');

        $('.novaksin').removeAttr('hidden','hidden');
        $('.why_not_vaksin').attr('required','required');
      }
    });



    $('.yescovid').change(function(){
      if($(this).val() == 1) {
        $('.pcrdate').removeAttr('hidden','hidden');
        $('.pcr_date_covid').attr('required','required');
      }
    });

    $('.nocovid').change(function(){
      if($(this).val() == 0) {
        $('.pcrdate').attr('hidden','true');
        $('.pcr_date_covid').removeAttr('required','required');
      }
    });

    $('#q3no').change(function() {
      if(this.checked) {
        // $('.symptoms').removeAttr('hidden','hidden')

        $('.degree').attr('hidden','true');
        $('.q3_ket').removeAttr('required','required');
        $('.q3_ket_ket').removeAttr('required','required');
      }else {
        // $('.symptoms').attr('hidden','true');
        $('.degree').removeAttr('hidden','hidden');
        $('.q3_ket').attr('required','required');
        $('.q3_ket_ket').attr('required','required');
      }
    });

    $('#q3').change(function() {
      if(this.checked) {
        // $('.symptoms').attr('hidden','true');
        $('.degree').removeAttr('hidden','hidden')
        $('.q3_ket').attr('required','required');
        $('.q3_ket_ket').attr('required','required');
      }else {
        // $('.symptoms').removeAttr('hidden','hidden');
        $('.degree').attr('hidden','true');
        $('.q3_ket').removeAttr('required','required');
        $('.q3_ket_ket').removeAttr('required','required');
      }
    });







  });


  </script>
  @endsection
  @endsection
