<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Performing Art</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('rubrick/creativity/store_nilai')}}" method="post">
              @csrf
                <div class="form-group row">

                  <input type="hidden" name="old_data"  id="old_data_1" value="">
                  <input type="hidden" name="old_data_2"  id="old_data_2" value="">
                  <input type="hidden" name="id_user" id="id_user" value="">
                  <input type="hidden" name="nama" id="nama" value="">
                  <input type="hidden" name="gender" id="gender" value="">
                  <input type="hidden" name="tipe" id="tipe" value="">
                  <input type="hidden" name="kelas" id="kelas" value="">
                  <input type="hidden" name="grade" id="grade" value="">
                  <input type="hidden" name="fit_time_id" id="fit_time_id" value="">
                </div>
                <div class="row">
                  <div class="aspectForm">  
                      <h5>Penilaian untuk Proyek Pertama</h5>            
                      <div class="form-group row" id="aspect1">
                        <div class="col-sm-6">Idea Generation</div>
                        <div class="col-sm-3">
                            <input type="number" id="input1" name="nilai_1[0]" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row" id="aspect2">
                        <div class="col-sm-6">Idea Design and Refinement</div>
                        <div class="col-sm-3">
                            <input type="number" id="input2" name="nilai_2[0]" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row" id="aspect3">
                        <div class="col-sm-6">Openness and Courage to Explore</div>
                        <div class="col-sm-3">
                            <input type="number"  id="input3" name="nilai_3[0]" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row" id="aspect4">
                        <div class="col-sm-6">Work Creatively with others</div>
                        <div class="col-sm-3">
                            <input type="number" id="input4"  name="nilai_4[0]" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row" id="aspect5">
                        <div class="col-sm-6">Creative Production and Innovation</div>
                        <div class="col-sm-3">
                            <input type="number" id="input5" class="form-control" name="nilai_5[0]" value="">
                        </div>
                      </div>
                      <div class="form-group row" id="aspect6">
                        <div class="col-sm-6">Reflection </div>
                        <div class="col-sm-3">
                            <input type="number"  id="input6" class="form-control" name="nilai_6[0]" value="">
                        </div>
                      </div>
                  </div>
                  <div class="aspectForm">   
                    <h5>Penilaian untuk Proyek Kedua</h5>               
                    <div class="form-group row" id="aspect7">
                      <div class="col-sm-6">Idea Generation</div>
                      <div class="col-sm-3">
                          <input type="number" id="input7" name="nilai_1[1]" class="form-control" value="">
                      </div>
                    </div>
                    <div class="form-group row" id="aspect8">
                      <div class="col-sm-6">Idea Design and Refinement</div>
                      <div class="col-sm-3">
                          <input type="number" id="input8" name="nilai_2[1]" class="form-control" value="">
                      </div>
                    </div>
                    <div class="form-group row" id="aspect9">
                      <div class="col-sm-6">Openness and Courage to Explore</div>
                      <div class="col-sm-3">
                          <input type="number"  id="input9" name="nilai_3[1]" class="form-control" value="">
                      </div>
                    </div>
                    <div class="form-group row" id="aspect10">
                      <div class="col-sm-6">Work Creatively with others</div>
                      <div class="col-sm-3">
                          <input type="number" id="input10"  name="nilai_4[1]" class="form-control" value="">
                      </div>
                    </div>
                    <div class="form-group row" id="aspect11">
                      <div class="col-sm-6">Creative Production and Innovation</div>
                      <div class="col-sm-3">
                          <input type="number"  id="input11" class="form-control" name="nilai_5[1]" value="">
                      </div>
                    </div>
                    <div class="form-group row" id="aspect12">
                      <div class="col-sm-6">Reflection </div>
                      <div class="col-sm-3">
                          <input type="number"  id="input12" class="form-control" name="nilai_6[1]" value="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">Save changes</button> --}}
                </div>
              </form>
        </div>
      
      </div>
    </div>
  </div>