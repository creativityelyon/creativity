@extends('layouts.app')
@section('title')
Survey Student
@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Dashboard</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            @if(empty($data))
            <form class="" action="{{ url('/surveyStudent')}}" method="post">
              @csrf
              <div class="form-group col-sm-12">
                <h3>We are following the government guidelines to protect the public, as well as our employees,
                  from the COVID-19 pandemic. To this extent, all students entering the school must confirm
                  the following terms and conditions. Please submit your response before you go to school.</h3>
                </div>

                <div class="form-group col-sm-6">
                  <label class="col-form-label pt-0">I confirm that I am not presenting any of these COVID-19 symptoms.</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="q1" id="q1" checked value="1">
                    <label class="form-check-label" for="q1">
                      Yes
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="q1" id="q1no" value="0">
                    <label class="form-check-label" for="q1">
                      No
                    </label>
                  </div>
                  <div class="symptoms">
                    <select class="form-control form-control-sm q1_keterangan" name="q1_keterangan" id="q1_keterangan">
                      <option value="">Please Select One </option>
                      <option value="Fever">Fever (37,3 degree Celsius & above)</option>
                      <option value="Dry Cough">Dry cough</option>
                      <option value="Runny Nosa">Runny nose</option>
                      <option value="Sore Throat">Sore throat</option>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-6">
                  <label class="col-form-label pt-0">I confirm that I have not been in contact with a person who has been diagnosed with
                    COVID-19 within the past 14 days.</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="q2" id="q2" checked value="1">
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
                  </div>

                  <div class="form-group col-sm-6">
                    <label class="col-form-label pt-0">I verify that I have not travelled domestically and internationally by commercial
                      airline, bus or train or other public transportation within the past 14 days.</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="q3" id="q3" checked value="1">
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
                    </div>

                    <div class="form-group col-sm-12">
                      <label class="col-form-label pt-0"> Is your body temperature is normal today < 37.3'C ?</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" id="q4" checked value="1">
                        <label class="form-check-label" for="q4">
                          Yes
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" id="q4no" value="0" >
                        <label class="form-check-label" for="q4">
                          No
                        </label>
                      </div>

                      <div class="degree" hidden>
                        <input type="text" class="form-control mb-2 mr-sm-2" name="suhu_tubuh" id="suhu_tubuh" placeholder="Body Temperature" onkeypress="return isNumberKey(event)">
                      </div>

                    </div>


                    <div class="form-group">
                      <button type="submit" class="btn-lg btn-primary ">Save </button>
                    </div>
                  </form>
                  @else
                  @if($data->q1 == 1 && $data->q2 == 1 && $data->q3 == 1 && $data->q4 == 1)
                  <h3> Welcome to Elyon Christian School</h3>
                  @else
                  <h3>We are sorry. Access denied.</h3>
                  @endif
                  @endif


                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      @section('scripts')
      <script>


      $(document).ready(function(){
        $('#q1no').change(function() {
          if(this.checked) {
            // $('.symptoms').removeAttr('hidden','hidden')
            $('.q1_keterangan').attr('required','required');
          }else {
            // $('.symptoms').attr('hidden','true');
            $('.q1_keterangan').removeAttr('required','required');
          }
        });

        $('#q1').change(function() {
          if(this.checked) {
            // $('.symptoms').attr('hidden','true');
            $('.q1_keterangan').removeAttr('required','required');
          }else {
            // $('.symptoms').removeAttr('hidden','hidden');
            $('.q1_keterangan').attr('required','required');
          }
        });


        $('#q4no').change(function() {
          if(this.checked) {
            $('.degree').removeAttr('hidden','hidden')
            $('#suhu_tubuh').attr('required','required');
          }else {
            $('.degree').attr('hidden','true');
            $('#suhu_tubuh').removeAttr('required','required');
          }
        });

        $('#q4').change(function() {
          if(this.checked) {
            $('.degree').attr('hidden','true');
            $('#suhu_tubuh').removeAttr('required','required');
          }else {
            $('.degree').removeAttr('hidden','hidden');
            $('#suhu_tubuh').attr('required','required');
          }
        });


      });


      </script>
      @endsection

      @endsection
