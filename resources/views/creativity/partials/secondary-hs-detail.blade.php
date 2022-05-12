<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select name="kategori" id="subjects" class="form-control">
                    </select>
                    <br>
                    <input class="form-check-input" type="checkbox" id="add"  name="ceked"style="float: left">
                    <label class="form-check-label" for="">
                      Need more form?
                    </label>
                  </div>
                </div>
                <div class="row">
                  <div class="aspectForm">
                    <div id="form1">                  
                      <div class="form-group row">
                        <div class="col-sm-6">Nama Proyek</div>
                        <div class="col-sm-6">
                            <input type="text" id="namapro1" name="namapro[0]" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row" id="aspect11">
                        <div class="col-sm-6">Idea Generation</div>
                        <div class="col-sm-3">
                            <input type="number" id="input1" name="nilai_1[0]" class="form-control" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="1">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row" id="aspect21">
                        <div class="col-sm-6">Idea Design and Refinement</div>
                        <div class="col-sm-3">
                            <input type="number" id="input2" name="nilai_2[0]" class="form-control" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="2">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row" id="aspect31">
                        <div class="col-sm-6">Openness and Courage to Explore</div>
                        <div class="col-sm-3">
                            <input type="number"  id="input3" name="nilai_3[0]" class="form-control" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="3">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row" id="aspect41">
                        <div class="col-sm-6">Work Creatively with others</div>
                        <div class="col-sm-3">
                            <input type="number" id="input4"  name="nilai_4[0]" class="form-control" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="4">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row" id="aspect51">
                        <div class="col-sm-6">Creative Production and Innovation</div>
                        <div class="col-sm-3">
                            <input type="number" id="input5" class="form-control" name="nilai_5[0]" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="5">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row" id="aspect61">
                        <div class="col-sm-6">Reflection </div>
                        <div class="col-sm-3">
                            <input type="number"  id="input6" class="form-control" name="nilai_6[0]" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="6">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="aspectForm">
                    <div id="form2">                  
                      <div class="form-group row">
                        <div class="col-sm-6">Nama Proyek</div>
                        <div class="col-sm-6">
                            <input type="text" id="namapro2" name="namapro[1]" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row" id="aspect12">
                        <div class="col-sm-6">Idea Generation</div>
                        <div class="col-sm-3">
                            <input type="number" id="input7" name="nilai_1[1]" class="form-control" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="7">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row" id="aspect22">
                        <div class="col-sm-6">Idea Design and Refinement</div>
                        <div class="col-sm-3">
                            <input type="number" id="input8" name="nilai_2[1]" class="form-control" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="8">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row" id="aspect32">
                        <div class="col-sm-6">Openness and Courage to Explore</div>
                        <div class="col-sm-3">
                            <input type="number"  id="input9" name="nilai_3[1]" class="form-control" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="9">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row" id="aspect42">
                        <div class="col-sm-6">Work Creatively with others</div>
                        <div class="col-sm-3">
                            <input type="number" id="input10"  name="nilai_4[1]" class="form-control" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="10">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row" id="aspect52">
                        <div class="col-sm-6">Creative Production and Innovation</div>
                        <div class="col-sm-3">
                            <input type="number"  id="input11" class="form-control" name="nilai_5[1]" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="11">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row" id="aspect62">
                        <div class="col-sm-6">Reflection </div>
                        <div class="col-sm-3">
                            <input type="number"  id="input12" class="form-control" name="nilai_6[1]" value="">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="12">
                            <label class="form-check-label" for="gridCheck1">
                              Choose
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">Save changes</button>
                </div>
              </form>
        </div>
      
      </div>
    </div>
  </div>