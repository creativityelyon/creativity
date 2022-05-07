@extends('layouts.auth_app')
@section('title')
Visitor Form
@endsection
@section('content')
<div class="card card-primary">
  <div class="card-header"><h4>Visitor Form</h4></div>

  <div class="card-body row">

    <form class="form" action="{{ url('/surveyVisitor')}}" method="post">
      @csrf
      <div class="form-group col-sm-12">
        <h3>We are following the government guidelines to protect the public, as well as our employees,
          from the COVID-19 pandemic.
          To this extent, all individuals (teachers and visitors) entering the school must confirm the
          following terms and conditions.</h3>
        </div>

        <div class="form-group col-sm-12">
          <label for="col-form-label pt-1">Name </label>
          <input type="text" class="form-control mb-2 mr-sm-2" name="nama" value="" maxlength=200 placeholder="Input Your Name Here" required>
        </div>
        <div class="form-group col-sm-12">
          <label for="col-form-label pt-1">Identity Card Number </label>
          <input type="text" class="form-control mb-2 mr-sm-2" name="ktp" value="" maxlength=100 required placeholder="Input Your Identity Number Here">
        </div>
        <div class="form-group col-sm-12">
          <label for="col-form-label pt-1">Phone </label>
          <input type="text" class="form-control mb-2 mr-sm-2" name="hp" value="" maxlength="50" required placeholder="Input Your Number" onkeypress="return isNumberKey(event)">
        </div>

        <div class="form-group col-sm-12">
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

        <div class="form-group col-sm-12">
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

          <div class="form-group col-sm-12">
            <label class="col-form-label pt-0">I verify that I have not travelled outside GERBANGKERTASUSILA within the past
              14 days.</label>
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


            <div class="form-group col-sm-12">
              <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>



      @endsection

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
            $('.q1_keterangan').attr('required','required';
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
