@extends('layouts.appnomenu')
@section('title')
Pernyataan Survey Detail
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
  <div class="row">
    <div class="col-lg-12">
      <h3 class="text-center"><b>SURAT PERNYATAAN ORANG TUA / WALI MURID</b></h3><br/>
    </div>
    <br/>
    <div class="col-md-12">
      <p><b>Saya</b> yang bertanda tangan di bawah ini: <br/>
      Nama Lengkap : {{ $data->nama_parent }}<br/>
      NIK : {{ $data->nik}}<br/>
      Pekerjaan : {{ $data->pekerjaan}}<br/>
      Alamat : {{ $data->alamat }}<br/><br/>

      Bahwa selaku orang tua / wali *) dari siswa: <br/>
      Nama Lengkap : {{$data->nama}}
      NIK :  {{ $data->student->nik }}
      Alamat Domisili : {{$data->alamat_siswa}}
      Kelas : {{ $data->kelas }} - {{$data->unit}}
      </p>
    </div>

    <div class="col-lg-12">
        <p>Menyatakan : <b>SETUJU </b> <br/>
          siswa/i yang tersebut di atas mengikuti Pembelajaran Tatap Muka Terbatas yang
          diselenggarakan di SD Elyon Christian Primary School Surabaya sesuai dengan jadwal yang telah
          ditetapkan oleh pihak sekolah. <br/><br/>

          Demikian surat pernyataan ini saya buat dengan sebenarnya dan dengan penuh rasa tanggung
          jawab serta tanpa adanya paksaan dari pihak lain dan tidak akan menuntut pihak manapun di
          kemudian hari terkait dengan pernyataan dan tindakan yang ada dalam surat pernyataan ini.
        </p>
    </div>


<div class="col-lg-6">
<p>
  Surabaya - {{ date('d-m-Y',strtotime($data->tgl))}} <br/>
  Yang membuat pernyataan <br/>
  Orang tua / Wali Murid <br/><br/>

    <img id="sig-image" src="{{$data->signature_url}}" alt="Your signature will go here!"/><br/>
  ( {{$data->nama_parent}} )
</p>
</div>


<div class="form-group">
  <span><b>Catatan : </b></span> <br/>
  <ul>
    <li><b>Bersedia membimbing siswa/i tersebut di atas untuk mentaati dan mematuhi Protokol Kesehatan dalam
    pelaksanaan PTM Terbatas di
    @if($data->student->id_level <= 4 )
    PGKG SMA Elyon Christian Secondary School Surabaya.
    @elseif($data->student->id_level >= 5 && $data->student->id_level <= 10)
    SD
    @elseif($data->student->id_level >= 11 && $data->student->id_level <= 13)
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

</div>
</section>
@endsection
