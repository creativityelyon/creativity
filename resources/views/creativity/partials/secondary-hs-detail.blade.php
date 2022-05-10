<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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

                  <input type="hidden" name="old_data"  id="old_data" value="">
                  <input type="hidden" name="id_user" id="id_user" value="">
                  <input type="hidden" name="nama" id="nama" value="">
                  <input type="hidden" name="gender" id="gender" value="">
                  <input type="hidden" name="tipe" id="tipe" value="">
                  <input type="hidden" name="kelas" id="kelas" value="">
                  <input type="hidden" name="grade" id="grade" value="">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select name="kategori" id="subjects" class="form-control">
                    </select>
                  </div>
                </div>
                <div class="form-group row" id="aspect1">
                  <div class="col-sm-6">Idea Generation</div>
                  <div class="col-sm-3">
                      <input type="number"  id="input1" name="nilai_1" class="form-control" value="">
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
                <div class="form-group row" id="aspect2">
                  <div class="col-sm-6">Idea Design and Refinement</div>
                  <div class="col-sm-3">
                      <input type="number" id="input2" name="nilai_2" class="form-control" value="">
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
                <div class="form-group row" id="aspect3">
                  <div class="col-sm-6">Openness and Courage to Explore</div>
                  <div class="col-sm-3">
                      <input type="number"  id="input3" name="nilai_3" class="form-control" value="">
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
                <div class="form-group row" id="aspect4">
                  <div class="col-sm-6">Work Creatively with others</div>
                  <div class="col-sm-3">
                      <input type="number" id="input4"  name="nilai_4" class="form-control" value="">
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
                <div class="form-group row" id="aspect5">
                  <div class="col-sm-6">Creative Production and Innovation</div>
                  <div class="col-sm-3">
                      <input type="number"  id="input5" class="form-control" name="nilai_5" value="">
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
                <div class="form-group row" id="aspect6">
                  <div class="col-sm-6">Reflection </div>
                  <div class="col-sm-3">
                      <input type="number"  id="input6" class="form-control"  nmae="nilai_6" value="">
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
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">Save changes</button>
                </div>
              </form>
        </div>
      
      </div>
    </div>
  </div>