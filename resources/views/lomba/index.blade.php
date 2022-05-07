@extends('layouts.app')
@section('title')
Registrasi Lomba
@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Registration competitions</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            @if(!empty($check))
            <h3> Thank you for your registration
            <ul>
              @foreach($check as $c)
              <li> {{ array_search($c->lomba, config('select.jenis_lomba')) }} - ({{ $c->kelas }})</li>
              @endforeach
            </ul>
            @else
            <form class="" action="{{ url('/lomba')}}" method="post">
              @csrf
              <div class="form-group col-sm-12">
                <h3>Welcome to Elyon Quest!</h3><br/>
                <h3>You are invited to join fun preparation classes and competitions with 20 million total rewards. We offer 7 competitions and you have to select 1 only. Remember, you have 2 classes to attend before the final round or the competition. Details will be informed after you are registered. Thank you!
                </div>
                <div class="row col-sm-12">
                  <div class="form-group col-sm-6">
                    <label class="col-form-label pt-0">Nama Lengkap (𝘍𝘶𝘭𝘭 𝘕𝘢𝘮𝘦) *</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" required
                    value="{{ (Auth::user()->name) ? Auth::user()->name : ""}}" >
                  </div>
                  <div class="form-group col-sm-6">
                    <label class="col-form-label pt-0">Kelass (Class) *</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="kelas" id="kelas" placeholder="Kelas" required
                    value="{{ (Auth::user()->kelas) ? Auth::user()->kelas : ""}}" >
                  </div>
                  <div class="form-group col-sm-6">
                    <label class="col-form-label pt-0">Kompetisi(Competition) *</label>
                    <select class="form-control form-control-sm lomba" name="lomba" id="lomba" required>
                      <option value="">Please Select One </option>
                      <option value="1">Subject & Competition</option>
                      <option value="2">Mandarin – Moon Cake Festival Speech</option>
                      <option value="3">Science</option>
                      <option value="4">Business – Dream Catcher</option>
                      <option value="5">Computer Science</option>
                      <option value="6">Art & Design – Super Hero character drawing</option>
                      <option value="7">Music- Sound of Music</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-6">
                    <label class="col-form-label pt-0">Pilih Kelas Preparasi (Preparation Class) *</label>
                    <select class="form-control form-control-sm kelas_lomba" name="kelas_lomba" id="kelas_lomba" required>
                      <option value="">Please Select One </option>
                      <option value="A">A</option>
                      <option value="B">B</option>

                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-6">
                  <button type="submit" class="btn-lg btn-primary ">Save</buttosn>
                  </div>

                </form>

                @endif
                <br/>
                <hr>
                <br/>





                        </div>
                        <div class="col-md-12">
                          <h3>Subject & Competition:</h3>
                          <ol>
                            <li type="number">English – Teenreports</li>
                            <p>Learn and compete to be the best reporters.</p>
                            <ol type="A">
                              <li>	Preparation Class A : Saturday, Sept 18 at 08.00-09.00 & Sept 25 at 08.00-09.00
                                <br/>Final Round : Saturday, Oct 9 at 09.00-10.30
                              </li>
                              <li>
                                Preparation Class B : Saturday, Sept 18 at 10.00-11.00 & Sept 25 at 10.00-11.00
                                <br/>Final Round : Saturday, Oct 9 at 09.00-10.30
                              </li>
                            </ol type="A">
                            <li>Mandarin – Moon Cake Festival Speech</li>
                            Learn and compete to deliver Moon Cake Festival speech
                            <ol type="A">
                              <li>Preparation Class : Saturday, Sept 18 at 08.00-09.00 & Oct 2 at 08.00-09.00
                                <br/>Final Round : Saturday, Oct 9 at 09.00-10.30
                              </li>
                            </ol>
                            <li>Science</li>
                            <ol type="A">
                              <li>Preparation Class A : Saturday, Sept 18 at 08.00-09.00 & Sept 25 at 08.00-09.00
                                <br/>Final Round : Saturday, Oct 9 at 09.00-10.30

                              </li>
                              <li>Preparation Class B : Saturday, Sept 18 at 10.00-11.00 & Sept 25 at 10.00-11.00
                                <br/>Final Round : Saturday, Oct 9 at 09.00-10.30
                              </li>
                            </ol>

                            <li>Business – Dream Catcher</li>
                            Plan and present your business dream.
                            <ol type="A">
                              <li>Preparation Class A : Saturday, Sept 18 at 08.00-09.00 & Sept 25 at 08.00-09.00
                                <br/>Final Round : Saturday, Oct 9 at 09.00-10.30</li>
                                <li>Preparation Class B : Saturday, Sept 18 at 10.00-11.00 & Sept 25 at 10.00-11.00
                                  <br/>Final Round : Saturday, Oct 9 at 09.00-10.30
                                </li>
                              </ol>

                              <li>	Computer Science </li>
                              <ol type="A">
                                <li>
                                  Preparation Class A : Saturday, Sept 18 at 08.00-09.00 & Sept 25 at 08.00-09.00
                                  <br/>Final Round : Saturday, Oct 9 at 09.00-10.30
                                </li>

                                <li>
                                  Preparation Class B : Saturday, Sept 18 at 10.00-11.00 & Sept 25 at 10.00-11.00
                                  <br/>Final Round : Saturday, Oct 9 at 09.00-10.30
                                </li>
                              </ol>
                              <li>Art & Design – Super Hero character drawing</li>
                              Draw your super hero pandemic.

                              <ol type="A">
                                <li>Preparation Class A : Saturday, Sept 18 at 08.00-09.00 & Sept 25 at 08.00-09.00
                                  <br/>Final Round : Saturday, Oct 9 at 09.00-10.30</li>

                                  <li>Preparation Class B : Saturday, Sept 18 at 10.00-11.00 & Sept 25 at 10.00-11.00
                                    <br/>Final Round : Saturday, Oct 9 at 09.00-10.30</li>
                                  </ol>

                                  <li>Music- Sound of Music
                                    <br/>Cover your favorite song.
                                  </li>
                                  <ol type="A">
                                    <li>Preparation Class A : Saturday, Sept 18 at 08.00-09.00 & Sept 25 at 08.00-09.00
                                      <br/>Final Round : Saturday, Oct 9 at 09.00-10.30</li>

                                      <li>Preparation Class B : Saturday, Sept 18 at 10.00-11.00 & Sept 25 at 10.00-11.00
                                        <br/>Final Round : Saturday, Oct 9 at 09.00-10.30</li>
                                      </ol>
                                    </ol>
                                  </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              @endsection
